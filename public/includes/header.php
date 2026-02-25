<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
require_once __DIR__ . '/../../includes/security.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database Connection Check
// This header is often included in files that already have DB connection.
// Only connect if $link isn't set.
if (!isset($link)) {
  // Try to locate database.php relative to this file (public/includes/header.php)
  // 1. Root config (../../config/database.php)
  if (file_exists(__DIR__ . '/../../config/database.php')) {
    require_once __DIR__ . '/../../config/database.php';
  }
  // 2. Public config (../config/database.php)
  elseif (file_exists(__DIR__ . '/../config/database.php')) {
    require_once __DIR__ . '/../config/database.php';
  }
}

<style>
/* Fix for selective checkout checkboxes being hidden by global CSS */
input[type="checkbox"].cart-item-checkbox, 
.mini-cart-selection input[type="checkbox"] {
    -webkit-appearance: checkbox !important;
    -moz-appearance: checkbox !important;
    appearance: checkbox !important;
    width: 20px !important;
    height: 20px !important;
    cursor: pointer;
    vertical-align: middle;
    accent-color: #6ea622; /* Matches theme green */
    position: relative;
    z-index: 5;
    margin: 0;
}
.mini-cart-selection {
    display: flex;
    align-items: center;
    padding-right: 12px;
}
/* Enhanced Profile Dropdown */
.header-sign-in-up__group {
    position: relative;
    display: inline-block;
}
.header-sign-in-up__group .dropdown {
    position: relative;
}
.header-sign-in-up__group .dropdown-menu {
    display: none;
    position: absolute !important;
    top: 100% !important;
    right: 0 !important;
    left: auto !important;
    background: #ffffff !important;
    border: 1px solid #eaeaea !important;
    border-radius: 12px !important;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
    padding: 12px 0 !important;
    min-width: 200px !important;
    z-index: 99999 !important;
    margin-top: 10px !important;
    list-style: none !important;
}
.header-sign-in-up__group .dropdown-menu.show {
    display: block !important;
}
.header-sign-in-up__group .dropdown-item {
    display: block !important;
    padding: 10px 20px !important;
    font-weight: 500 !important;
    color: #444 !important;
    text-decoration: none !important;
    transition: all 0.2s ease !important;
    font-size: 14px !important;
    text-align: left !important;
}
.header-sign-in-up__group .dropdown-item:hover {
    background-color: #f8f9fa !important;
    color: #70AB22 !important;
    padding-left: 25px !important;
}
.header-sign-in-up__group .dropdown-divider {
    margin: 8px 0 !important;
    border-top: 1px solid #eee !important;
}
.header-sign-in-up__group .dropdown-toggle {
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
    cursor: pointer !important;
    padding: 5px 0 !important;
}
/* Caret icon */
.header-sign-in-up__group .dropdown-toggle::after {
    content: "";
    display: inline-block;
    margin-left: 5px;
    vertical-align: middle;
    border-top: 4px solid #666;
    border-right: 4px solid transparent;
    border-left: 4px solid transparent;
    transition: transform 0.2s ease;
}
.header-sign-in-up__group .dropdown-menu.show + .dropdown-toggle::after {
    transform: rotate(180deg);
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const profileToggle = document.getElementById('profileDropdown');
    const profileMenu = profileToggle ? profileToggle.nextElementSibling : null;

    if (profileToggle && profileMenu) {
        profileToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            profileMenu.classList.toggle('show');
        });

        // Close when clicking outside
        document.addEventListener('click', function(e) {
            if (!profileToggle.contains(e.target) && !profileMenu.contains(e.target)) {
                profileMenu.classList.remove('show');
            }
        });
    }
});
</script>

// Calculate Cart Items and Subtotal
$total_cart_items = 0;
$header_cart_subtotal = 0;
$header_cart_details = [];

if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && !empty($_SESSION['cart'])) {
  $total_cart_items = !empty($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;
?>
<?php
  $ids = array_keys($_SESSION['cart']);
  $placeholders = str_repeat('?,', count($ids) - 1) . '?';

  // Try to use $pdo if available, otherwise use $link (fallback)
  $db_conn = $pdo ?? $link ?? null;
  
  if ($db_conn) {
    $title_col = (isset($_SESSION['lang']) && $_SESSION['lang'] == 'ro') ? 'title_ro' : 'title_en';
    // Fallback if the specific columns don't exist yet (based on previous knowledge items)
    // Actually, let's use the helper if available or a safe guess
    $title_col = 'title_' . ($_SESSION['lang'] ?? 'en');
    
    foreach ($_SESSION['cart'] as $pid => $qty) {
      // $total_cart_items is already set via array_sum above, no need to add again
      
      $stmt = $db_conn->prepare("SELECT id, price, image, title_en, title_ro FROM products WHERE id = ?");
      $stmt->execute([$pid]);
      $product = $stmt->fetch();
      
      if ($product) {
        $product['qty'] = $qty;
        $product['line_total'] = $product['price'] * $qty;
        $header_cart_subtotal += $product['line_total'];
        $header_cart_details[] = $product;
      }
    }
  }
}
?>
<!DOCTYPE html>
<html class="js" lang="en">

<head>

  <!-- Thunder PageSpeed --->
  <!-- Thunder Critical CSS --->

  <style>
    .featured-banner__wrap {
      background: linear-gradient(90deg, #70ab22, #5b8a1d);
      border-radius: 12px;
      max-width: 1362px;
      margin-inline: auto;
      position: relative;
      overflow: hidden
    }

    .featured-banner__content {
      padding: 102px 15px;
      max-width: 570px;
      display: flex;
      flex-direction: column;
      gap: 20px;
      position: relative;
      z-index: 2
    }

    .featured-banner__content {
      padding: 54px 25px;
      gap: 18px;
      align-items: flex-start;
      max-width: 608px
    }

    .featured-banner__featured-img,
    .subscription-banner__featured-img {
      position: absolute;
      right: 5px;
      max-width: 378px;
      bottom: -1px
    }

    .featured-banner__featured-img {
      max-width: 418px;
      right: 36px
    }

    .featured-banner__parent {
      padding-inline: 15px
    }

    .eclipse-pattern {
      position: absolute
    }

    .eclipse-pattern.right {
      right: 15px;
      bottom: 48px
    }

    @media screen and (max-width:767px) {

      .eclipse-pattern.right,
      .featured-banner__featured-img,
      .subscription-banner__featured-img {
        display: none
      }

      .featured-banner__parent {
        padding-inline: 0
      }

      .featured-banner__wrap {
        border-radius: 0
      }
    }

    @media screen and (max-width:998px) {
      .weekly-specials__slide-text {
        font-size: 20px
      }
    }

    .nice-select {
      background-color: var(--white);
      border: solid 1px var(--border-color);
      display: block;
      font-family: inherit;
      font-size: 14px;
      font-weight: 400;
      line-height: 1;
      outline: 0;
      position: relative;
      text-align: left !important;
      padding: 10px 35px 10px 15px;
      width: 100%;
      background: url(https://maharajasupermarket.ro/cdn/shop/t/4/assets/arrow-chevron.svg) no-repeat;
      background-size: 7px;
      background-position: calc(100% - 15px) 50%
    }

    :root {
      --jdgm-primary-color: #6EA622;
      --jdgm-secondary-color: rgba(110, 166, 34, 0.1);
      --jdgm-star-color: #6EA622;
      --jdgm-paginate-color: #6EA622;
      --jdgm-border-radius: 0
    }

    *,
    :after,
    :before {
      box-sizing: border-box;
      text-decoration: inherit;
      vertical-align: inherit
    }

    * {
      font-family: var(--first-font)
    }

    html {
      outline: 0;
      scroll-behavior: smooth;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      -webkit-text-size-adjust: 100%;
      padding: 0 !important
    }

    body {
      color: var(--black);
      font: var(--common-text);
      margin: 0;
      padding: 0;
      height: 100%;
      width: 100%;
      overflow-x: hidden;
      background-color: var(--grey-400)
    }

    body,
    html {
      scrollbar-width: none
    }

    img,
    svg {
      max-width: 100%;
      display: block
    }

    .btn,
    a,
    button {
      text-decoration: none;
      outline: 0;
      box-shadow: none;
      color: inherit;
      display: inline-block;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none
    }

    .btn,
    a,
    button,
    input:not([type=checkbox]):not([type=radio]),
    select {
      text-decoration: none;
      -webkit-text-decoration-skip: objects;
      outline: 0;
      -webkit-box-shadow: none;
      -moz-box-shadow: none;
      -ms-box-shadow: none;
      -o-box-shadow: none;
      box-shadow: none;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none
    }

    input::-webkit-inner-spin-button,
    input::-webkit-outer-spin-button {
      margin: 0;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none
    }

    ::-webkit-input-placeholder {
      color: var(--theme-color)
    }

    :-ms-input-placeholder {
      color: var(--theme-color)
    }

    ::placeholder {
      color: var(--theme-color);
      font: var(--common-text)
    }

    header {
      display: block
    }

    * {
      margin: 0;
      padding: 0;
      font-size: 100%;
      list-style: none;
      vertical-align: baseline
    }

    li,
    p,
    ul {
      margin: 0;
      padding: 0;
      list-style: none;
      font: var(--common-text)
    }

    h1 {
      font: var(--h1)
    }

    h2 {
      font: var(--h2)
    }

    h3 {
      font: var(--h3)
    }

    h4 {
      font: var(--h4)
    }

    h5 {
      font: var(--h5)
    }

    h6 {
      font: var(--h6)
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      margin: 0
    }

    p:not(:last-of-type) {
      margin-bottom: 15px
    }

    .container {
      max-width: 1392px;
      width: 100%;
      margin: 0 auto;
      padding: 0 15px
    }

    .row {
      display: -webkit-box;
      display: -webkit-flex;
      display: -ms-flexbox;
      display: flex;
      -webkit-flex-wrap: wrap;
      -ms-flex-wrap: wrap;
      flex-wrap: wrap;
      margin-left: -15px;
      margin-right: -15px
    }

    .row [class*=col-] {
      padding: 0 15px
    }

    .d-flex {
      display: -webkit-box;
      display: -webkit-flex;
      display: -ms-flexbox;
      display: flex;
      -webkit-flex-wrap: wrap;
      -ms-flex-wrap: wrap;
      flex-wrap: wrap;
      box-sizing: border-box
    }

    .align-items-center {
      -ms-flex-align: center;
      align-items: center
    }

    .justify-content-between {
      -ms-flex-pack: justify;
      justify-content: space-between
    }

    .justify-content-end {
      -ms-flex-pack: end;
      justify-content: flex-end
    }

    .hidden,
    .visually-hidden,
    [hidden] {
      display: none !important
    }

    .mobile-only {
      display: block !important
    }

    .col-12 {
      flex: 0 0 auto;
      width: 100%
    }

    @media (min-width:768px) {
      .col-md-3 {
        flex: 0 0 auto;
        width: 25%
      }
    }

    .nice-select {
      background-color: var(--white);
      border: solid 1px var(--border-color);
      display: block;
      font-family: inherit;
      font-size: 14px;
      font-weight: 400;
      line-height: 1;
      outline: 0;
      position: relative;
      text-align: left !important;
      padding: 10px 35px 10px 15px;
      width: 100%;
      background: url(https://maharajasupermarket.ro/cdn/shop/t/6/assets/arrow-chevron.svg) no-repeat;
      background-size: 7px;
      background-position: calc(100% - 15px) 50%
    }

    .nice-select option {
      color: var(--black)
    }

    .btn {
      text-align: center;
      padding: 9px 12px;
      font-family: var(--first-font);
      color: var(--theme-color);
      background-color: transparent;
      box-shadow: none;
      outline: 0;
      border: 1px solid transparent;
      position: relative;
      border-radius: 8px;
      font-weight: 600;
      font-size: 16px;
      line-height: 1;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      -webkit-border-radius: 10px;
      -moz-border-radius: 10px;
      -ms-border-radius: 10px;
      -o-border-radius: 10px;
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      gap: 8px
    }

    .btn.btn--sm {
      font-size: 14px
    }

    .btn.btn--primary {
      background-color: var(--theme-color);
      color: var(--white);
      border-color: var(--theme-color)
    }

    .btn.btn--secondary {
      color: var(--theme-color);
      border-color: var(--theme-color)
    }

    .btn.btn--white {
      background: var(--white);
      border-color: var(--white)
    }

    .btn--lg {
      padding: 11px 20px
    }

    .form-control,
    input:not([type=checkbox]):not([type=radio]):not([type=submit]),
    select {
      position: relative;
      border: 1px solid var(--border-color);
      display: block;
      width: 100%;
      padding: 15px 20px;
      background: var(--white);
      font-size: 14px;
      line-height: 1;
      color: var(--black);
      -webkit-appearance: none;
      -moz-appearance: none;
      appearance: none;
      margin: 0;
      border-radius: 12px
    }

    input[type=checkbox] {
      border-radius: 4px
    }

    .padding-bottom {
      padding-bottom: 80px
    }

    .site-header {
      background: 0 0;
      width: 100%;
      position: relative
    }

    .site-header .top-header {
      display: flex;
      align-items: center;
      flex-wrap: wrap;
      padding: 15px 0;
      color: var(--black);
      gap: 36px
    }

    .site-header .header__top-navigation {
      display: flex;
      align-items: center;
      gap: 24px
    }

    .site-header .header__top-navigation li a {
      font-size: 16px;
      font-weight: 500;
      line-height: 1.2;
      color: var(--black)
    }

    .site-header .top-header .right-side-header {
      flex: 1;
      width: 100%;
      display: flex;
      justify-content: end;
      flex-wrap: wrap;
      align-items: center;
      gap: 16px
    }

    .site-header .logo-col {
      max-width: 216px;
      width: 100%;
      position: relative
    }

    .site-header .logo-col a {
      display: block
    }

    .site-header .search-form-wrapper {
      position: relative;
      max-width: 351px;
      width: 100%
    }

    .search-form-wrapper .form-inputs,
    .search-form-wrapper form {
      width: 100%;
      position: relative
    }

    .site-header .search-form-wrapper .form-inputs input {
      background: #f6f6f6;
      border-radius: 12px !important;
      padding: 0 40px 0 12px;
      height: 40px;
      border: none;
      color: var(--black);
      border-radius: 5px;
      -webkit-border-radius: 5px;
      -moz-border-radius: 5px;
      -ms-border-radius: 5px;
      -o-border-radius: 5px
    }

    .site-header .search-form-wrapper .form-inputs input:-ms-input-placeholder {
      color: #7a7a7a
    }

    .site-header .search-form-wrapper .form-inputs input::-webkit-input-placeholder {
      color: #7a7a7a
    }

    .search-form-wrapper .btn {
      position: absolute;
      top: 50%;
      right: 7px;
      width: 25px;
      padding: 0;
      height: calc(100% - 10px);
      -webkit-transform: translateY(-50%);
      -moz-transform: translateY(-50%);
      -ms-transform: translateY(-50%);
      -o-transform: translateY(-50%);
      transform: translateY(-50%);
      background: 0 0;
      border: none
    }

    .site-header .search-form-wrapper .form-select {
      position: absolute;
      left: auto;
      right: 0;
      top: 50%;
      padding: 0;
      -webkit-transform: translateY(-50%);
      -moz-transform: translateY(-50%);
      -ms-transform: translateY(-50%);
      -o-transform: translateY(-50%);
      transform: translateY(-50%);
      background: 0 0
    }

    .site-header .search-form-wrapper .form-select .nice-select {
      font-size: 14px;
      font-family: var(--first-font);
      font-weight: 400;
      color: var(--white);
      width: 130px;
      line-height: 17px;
      border-radius: 0 5px 5px 0;
      height: 40px;
      -webkit-border-radius: 0px 5px 5px 0px;
      -moz-border-radius: 0 5px 5px 0;
      -ms-border-radius: 0px 5px 5px 0px;
      -o-border-radius: 0 5px 5px 0;
      border: 0;
      border-left: 1px solid #284c4e;
      padding: 10px 25px 10px 15px
    }

    .site-header .nice-select:after {
      border-color: var(--white)
    }

    .header-style-one .menu-right li a:not(.link-btn) svg {
      width: 20px;
      height: 20px;
      margin: 0 auto
    }

    .header-style-one .menu-right li {
      display: flex;
      align-items: center;
      gap: 4px;
      padding-bottom: 2px;
      color: var(--theme-color-dark)
    }

    .header-style-one .menu-right li.cart-header a svg {
      height: 20px;
      width: 25px
    }

    .header-style-one .menu-right li a {
      display: block;
      text-align: center;
      text-transform: capitalize;
      font-weight: 600;
      position: relative;
      color: var(--theme-color)
    }

    .header-style-one .count {
      position: absolute;
      top: -4px;
      right: -4px;
      height: 15px;
      width: 15px;
      background: var(--second-color);
      color: var(--white);
      font-size: 10px;
      border-radius: 5px;
      display: flex;
      align-items: center;
      justify-content: center;
      line-height: 1;
      border: 1.36364px solid var(--second-color);
      -webkit-border-radius: 5px;
      -moz-border-radius: 5px;
      -ms-border-radius: 5px;
      -o-border-radius: 5px
    }

    .header-style-one .menu-right li.cart-header .count {
      top: -5px
    }

    .header-style-one .main-navigationbar .menu-items-col .main-nav>li {
      padding-bottom: 10px;
      padding-top: 10px
    }

    .header-style-one .main-navigationbar .menu-items-col .main-nav>li:not(:last-of-type) {
      margin-right: 7.3px
    }

    .header-style-one .main-navigationbar .menu-items-col .main-nav>li>a {
      color: var(--black);
      font-family: var(--first-font);
      font-weight: 500;
      font-size: 14px;
      display: flex;
      align-items: center;
      padding: .5rem;
      border-radius: 5px;
      position: relative;
      letter-spacing: -.03em;
      line-height: 1;
      -webkit-border-radius: 5px;
      -moz-border-radius: 5px;
      -ms-border-radius: 5px;
      -o-border-radius: 5px
    }

    .header-style-one .main-navigationbar .menu-items-col .main-nav>li>a.special-link {
      color: #ff9c00
    }

    .header-style-one .main-navigationbar .menu-items-col .main-nav>li.has-item>a {
      padding-right: 30px
    }

    .header-style-one .main-navigationbar .menu-items-col .main-nav>li.menu-lnk .menu-dropdown {
      position: absolute;
      top: 100%;
      background-color: var(--white);
      transform-origin: top;
      box-shadow: 0 10px 40px #0000000d;
      opacity: 0;
      visibility: hidden;
      min-width: 220px;
      z-index: 2;
      padding: 20px;
      -moz-transform: scaleY(0);
      -ms-transform: scaleY(0);
      -o-transform: scaleY(0);
      -webkit-transform: scaleY(0);
      transform: scaleY(0);
      border-radius: 8px
    }

    .header-style-one .main-navigationbar .menu-items-col .main-nav>li.menu-lnk .menu-dropdown.mega-menu {
      width: 100%;
      left: 0;
      right: 0;
      margin: 0 auto;
      padding: 0 15px;
      box-shadow: none;
      border: none;
      background-color: unset
    }

    .header-style-one .menu-dropdown ul>li:not(:last-of-type) {
      margin-bottom: 10px
    }

    .header-style-one .menu-dropdown ul>li.list-title span {
      font-weight: 700;
      font-size: 17px
    }

    .header-style-one .menu-dropdown ul>li a {
      border-bottom: 1px solid transparent
    }

    .header-style-one .main-navigationbar .menu-items-col .main-nav>li.has-item>a:after {
      border-bottom: 2px solid var(--black);
      border-right: 2px solid var(--black);
      content: "";
      display: block;
      height: 8px;
      width: 8px;
      margin-top: -5px;
      position: absolute;
      right: 10px;
      top: 50%;
      -webkit-transform-origin: 66% 66%;
      -ms-transform-origin: 66% 66%;
      transform-origin: 66% 66%;
      -webkit-transform: rotate(45deg);
      -ms-transform: rotate(45deg);
      transform: rotate(45deg)
    }

    .search-popup {
      position: fixed;
      background: #000000b3;
      height: 100%;
      width: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-wrap: wrap;
      z-index: 3;
      padding: 0 30px;
      left: 0;
      right: 0;
      top: 0;
      bottom: 0;
      opacity: 0;
      visibility: hidden
    }

    .search-popup .close-search {
      position: absolute;
      right: 50px;
      top: 50px;
      width: 30px;
      height: 30px
    }

    .search-popup .close-search svg {
      height: 100%;
      width: 100%
    }

    .search-popup .search-form-wrapper {
      max-width: 1000px;
      width: 100%
    }

    .search-popup .search-form-wrapper .form-inputs {
      width: 100%;
      position: relative
    }

    .site-header .search-popup .search-form-wrapper input {
      padding: 15px 160px 15px 40px;
      background: var(--white);
      color: var(--theme-color)
    }

    .search-popup .search-form-wrapper .form-select {
      position: absolute;
      left: auto;
      right: 0;
      top: 50%;
      padding: 0;
      border-radius: 0;
      -webkit-transform: translateY(-50%);
      -moz-transform: translateY(-50%);
      -ms-transform: translateY(-50%);
      -o-transform: translateY(-50%);
      transform: translateY(-50%)
    }

    .search-popup .search-form-wrapper .form-select .nice-select {
      border: 0;
      background-color: var(--theme-color);
      color: var(--white);
      width: 150px
    }

    .search-form-wrapper .btn svg {
      width: 16px;
      height: 16px;
      margin: 0 auto;
      fill: var(--white)
    }

    .search-popup .search-form-wrapper .btn svg path {
      fill: var(--theme-color)
    }

    .site-header .main-navigationbar .menu-items-col {
      display: block
    }

    .header-style-one .mobile-menu {
      display: inline-block;
      position: relative;
      width: 25px;
      height: 25px;
      margin-left: 15px
    }

    .header-style-one .mobile-menu .mobile-menu-button {
      width: 100%;
      height: 100%;
      position: absolute;
      top: 50%;
      padding: 0;
      text-align: center;
      left: 0;
      right: 0;
      margin: 0 auto;
      background: 0 0;
      border: none;
      -moz-transform: translate(0, -50%);
      -ms-transform: translate(0, -50%);
      -o-transform: translate(0, -50%);
      -webkit-transform: translate(0, -50%);
      transform: translateY(-50%)
    }

    .header-style-one .mobile-menu .mobile-menu-button div {
      width: 100%;
      height: 2px;
      margin: 5px 0;
      backface-visibility: hidden;
      background: var(--second-color)
    }

    .mobile-menu-wrapper {
      position: fixed;
      z-index: 4;
      background: var(--white);
      top: 0;
      height: 100%;
      -webkit-transform: translate(100%, 0);
      -moz-transform: translate(100%, 0);
      -ms-transform: translate(100%, 0);
      -o-transform: translate(100%, 0);
      transform: translate(100%);
      right: 0;
      max-width: 380px;
      width: 100%
    }

    .mobile-menu-wrapper .menu-close-icon {
      text-align: right;
      padding: 15px 20px;
      background: var(--theme-color)
    }

    .mobile-menu-wrapper .mobile-menu-bar>ul {
      height: calc(100vh - 48px);
      overflow: auto;
      padding: 10px 20px;
      background: #f9f9f9
    }

    .mobile-menu-wrapper .mobile-menu-bar>ul>li {
      margin-top: 12px
    }

    .mobile-menu-wrapper .mobile-menu-bar>ul>li a {
      font-size: 18px;
      color: var(--theme-color);
      letter-spacing: 1px;
      display: -webkit-box;
      display: -moz-box;
      display: -webkit-flex;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-align: center;
      -moz-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center
    }

    .mobile-menu-wrapper .mobile-menu-bar>ul>li .acnav-list {
      margin: 12px 0
    }

    .mobile-menu-wrapper .mobile-menu-bar>ul>li a svg {
      margin-left: auto;
      width: 14px
    }

    .mobile-menu-wrapper .mobile-menu-bar>ul>li a .close-menu-ioc {
      display: none
    }

    .mobile-menu-wrapper .mobile-menu-bar .has-children>ul>li>a.acnav-label {
      font-weight: 600
    }

    .mobile-menu-wrapper .mobile-menu-bar .has-children>ul>li>a {
      font-size: 14px
    }

    .mobile-menu-wrapper .menu-close-icon svg path {
      fill: var(--white)
    }

    .mobile-menu-wrapper .mobile-menu-bar .has-children>ul>li:not(:last-of-type) {
      margin-bottom: 12px
    }

    .acnav-list {
      display: none;
      padding: 0 0 10px
    }

    .main-navigationbar .container,
    .top-header-wrapper .container {
      background-color: var(--white);
      border-radius: 8px;
      max-width: 1362px
    }

    .main-navigationbar .container {
      margin-top: 4px;
      max-width: 1362px
    }

    .mega-menu-container.container {
      padding-block: 26px;
      box-shadow: 0 10px 40px #0000000d
    }

    .header__announcement-bar {
      padding-inline: 15px
    }

    .header__announcement-bar .container {
      padding-inline: 0;
      display: flex;
      padding-block: 12px;
      justify-content: space-between;
      align-items: center;
      max-width: 1362px
    }

    .shopify-localization-form select {
      font-size: 12px;
      display: inline-flex;
      max-width: 56px;
      padding: 8px 22px 8px 12px;
      background: var(--white) !important;
      border-radius: 8px;
      border: 1px solid #d1d1d1
    }

    .locale-selector__wrap {
      display: flex;
      position: relative
    }

    .locale-selector__wrap svg {
      position: absolute;
      right: 6px;
      top: 50%;
      transform: translateY(-50%)
    }

    .hot-line-num {
      display: flex;
      align-items: center;
      font-size: 14px;
      font-weight: 400;
      gap: 8px
    }

    .announcement-bar-mid-col {
      display: flex;
      align-items: center;
      gap: 10px;
      justify-content: center
    }

    @media screen and (max-width:767px) {

      .announcement-bar-mid-col,
      .hot-line-num,
      .site-header .header__top-navigation {
        display: none
      }
    }

    .header-sign-in-up__group {
      display: flex;
      align-items: center;
      gap: 12px
    }

    .header-info-end .menu-right {
      display: flex;
      gap: 12px
    }

    .cartDrawer {
      position: fixed;
      right: 0;
      top: 0;
      z-index: 5;
      background: var(--white);
      width: 410px;
      height: 100%;
      -moz-transform: translateX(100%);
      -o-transform: translateX(100%);
      -ms-transform: translateX(100%);
      -webkit-transform: translateX(100%);
      transform: translate(100%);
      display: flex;
      flex-direction: column
    }

    .cartDrawer .mini-cart-header {
      position: relative;
      text-align: center;
      padding: 17px 30px 16px;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: var(--theme-color);
      color: var(--white)
    }

    .cartDrawer .cart-tottl-itm {
      font-weight: 700;
      font-size: 14px;
      line-height: 17px;
      letter-spacing: .1em;
      text-transform: uppercase;
      display: block
    }

    .cart-header .closecart {
      position: fixed !important;
      right: 424px;
      top: 20px;
      width: 20px;
      height: 20px;
      z-index: 10;
      opacity: 0;
      visibility: hidden
    }

    .cartDrawer .mini-cart-has-item {
      overflow: hidden;
      flex: 1;
      display: flex;
      flex-direction: column
    }

    .cartDrawer .mini-cart-body {
      overflow-y: auto;
      padding: 30px;
      flex: 1
    }

    .webi-mini-cart-footer {
      padding: 30px;
      border-top: 1px solid var(--border-color)
    }

    .mini-cart-footer-total-row {
      font-weight: 700;
      font-size: 24px;
      line-height: 29px;
      display: flex;
      align-items: center;
      color: var(--black);
      margin: 0 -10px 20px
    }

    .product-card-image a {
      position: relative;
      display: block;
      padding-top: 66.2%;
      overflow: hidden
    }

    .acnav-list {
      display: none;
      padding: 12px 0
    }

    .mini-cart-footer-total-row div {
      padding: 0 10px
    }

    .mini-cart-footer-total-row .mini-total-price {
      font-size: 18px;
      color: var(--black)
    }

    .coupan-txt svg {
      width: 22px;
      height: 22px
    }

    .site-header .menu-right .coupan-txt svg {
      margin: 0
    }

    .site-header .menu-right .apply-coupan-btn a {
      display: flex;
      align-items: center;
      position: relative;
      padding: 10px 30px;
      color: var(--white);
      height: 100%;
      width: auto
    }

    .coupan_code {
      position: relative;
      margin-bottom: 15px;
      border: 1px solid var(--border-color);
      border-radius: 10px;
      display: flex;
      align-items: center;
      padding: 4px
    }

    .coupan-txt {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
      gap: 8px;
      color: var(--black)
    }

    .coupan-txt svg {
      color: var(--theme-color)
    }

    .coupan_code input {
      width: 100%;
      padding: 0 15px;
      border: none
    }

    .quickview-popup {
      display: none;
      position: fixed;
      top: 50%;
      left: 0;
      right: 0;
      max-width: 1100px;
      max-height: 100%;
      max-height: calc(100% - 100px);
      width: 95%;
      margin: 0 auto;
      text-align: center;
      background-color: var(--second-color);
      z-index: 4;
      -webkit-transform: translateY(-50%);
      -ms-transform: translateY(-50%);
      transform: translateY(-50%);
      overflow: auto
    }

    .quickview-close {
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      position: absolute;
      top: 0;
      right: 0;
      z-index: 3
    }

    .quickview_popup_data {
      padding: 30px 15px 15px
    }

    button {
      border: none;
      box-shadow: none
    }

    .search-form-wrapper form {
      position: relative
    }

    .search-popup .close-search {
      background: 0 0;
      border: none;
      padding: 0
    }

    .header-style-one .menu-right .cartDrawer {
      padding: 0
    }

    .cartDrawer .cart__empty-text,
    .cartDrawer .cart__warnings {
      display: none
    }

    .cartDrawer.is-empty .cart__empty-text,
    .cartDrawer.is-empty .cart__warnings {
      display: block;
      color: var(--black);
      margin: 15px 0 0
    }

    .cartDrawer.is-empty .cart__warnings {
      margin: 20% 0 0;
      text-align: center
    }

    .cartDrawer.is-empty .cart__warnings svg {
      margin: auto
    }

    .header-style-one .cartDrawer svg#icon-cart-emty,
    .header-style-one .menu-right .cartDrawer svg#icon-cart-emty {
      width: 55px;
      height: auto;
      fill: currentColor;
      margin: 0 auto 30px
    }

    .header-style-one .menu-right li a.closecart svg path {
      fill: var(--white) !important
    }

    .mobile-menu-wrapper .mobile-menu-bar>ul>li:not(.has-children) a svg {
      display: none
    }

    .product-form__error-message-wrapper {
      display: flex;
      color: #e90022;
      position: absolute;
      z-index: 1;
      background: #ff0;
      padding: 10px;
      font-size: 12px;
      line-height: 1;
      left: 0;
      right: 0;
      bottom: 0;
      border-radius: 10px
    }

    .search__button {
      position: absolute;
      top: 5px;
      left: auto;
      right: 5px;
      bottom: 5px;
      padding: 0 10px;
      -webkit-border-radius: 0px;
      -moz-border-radius: 0;
      -ms-border-radius: 0px;
      -o-border-radius: 0
    }

    .search__button svg {
      margin: 0;
      width: 20px;
      height: 20px
    }

    .mini-cart-header h4 {
      margin: 0;
      font-weight: 700;
      display: flex;
      align-items: center;
      gap: 8px
    }

    @media (min-width:768px) {
      .header-style-one .main-navigationbar .menu-items-col .main-nav {
        display: flex;
        align-items: center
      }

      .header-style-one .mobile-menu {
        display: none !important
      }

      .mobile-only {
        display: none !important
      }
    }

    @media screen and (max-width:1260px) {
      .header-style-one .main-navigationbar .menu-items-col .main-nav>li.menu-lnk .menu-dropdown {
        min-width: 140px
      }
    }

    @media screen and (max-width:1200px) {
      .search-form-wrapper .nice-select option {
        color: var(--white)
      }

      .site-header .right-side-header .search-form-wrapper {
        display: none
      }

      .cart-notification {
        z-index: 4 !important
      }

      .site-header .top-header .right-side-header {
        justify-content: flex-end;
        padding-left: 30px
      }

      .site-header .top-header {
        padding: 15px 0
      }

      .header-style-one .menu-right .mobile-only {
        display: block !important
      }

      body.home .header-style-one .mobile-menu {
        display: none !important
      }

      .header-style-one .mobile-menu {
        display: block !important
      }

      .site-header .main-navigationbar {
        display: none
      }
    }

    @media screen and (max-width:991px) {
      :root {
        --h1: normal normal 32px/1.2 var(--second-font);
        --h2: normal normal 26px/1.2 var(--second-font);
        --h3: normal normal 22px/1.2 var(--second-font);
        --h4: normal normal 20px/1.2 var(--second-font);
        --common-text: normal 400 14px/1.4 var(--first-font)
      }
    }

    @media screen and (max-width:767px) {
      .header-style-one .menu-right li:not(:last-of-type) {
        margin-right: 15px
      }

      .site-header .logo-col {
        max-width: 165px
      }

      .header-style-one .menu-right li.cart-header .count {
        top: -5px;
        right: -4px
      }

      .site-header .top-header {
        padding: 16px 0;
        gap: 4px
      }

      body.home .header-style-one .mobile-menu {
        display: block !important
      }

      .padding-bottom {
        padding-bottom: 40px
      }

      .cartDrawer .mini-cart-header {
        padding: 16px 20px 16px 50px
      }

      .cartDrawer {
        width: 100%
      }

      .cart-header .closecart {
        left: 15px;
        right: auto;
        top: 15px
      }

      .mini-cart-footer-total-row {
        font-size: 18px;
        line-height: 18px;
        margin: 0 -10px 12px
      }

      .search-popup .close-search {
        right: 30px;
        top: 30px;
        width: 20px;
        height: 20px
      }

      .cartDrawer .mini-cart-body,
      .webi-mini-cart-footer {
        padding: 15px
      }

      .search-popup {
        padding: 0 15px
      }

      .quickview_popup_data {
        padding: 30px 0 0
      }
    }

    @media screen and (max-width:575px) {
      .header-style-one .count {
        height: 12px;
        width: 12px
      }

      .search-popup .search-form-wrapper .form-select {
        display: none
      }

      .site-header .search-popup .search-form-wrapper input {
        padding: 15px 15px 15px 40px
      }

      .header-style-one .mobile-menu .mobile-menu-button div {
        margin: 4px 0
      }

      .header-style-one .menu-right li a:not(.link-btn) svg {
        width: 16px;
        height: 16px
      }

      .header-style-one .menu-right li:not(:last-of-type) {
        margin-right: 10px
      }
    }

    @media screen and (max-width:370px) {
      .site-header .logo-col {
        margin-right: 15px;
        max-width: 110px
      }
    }

    .sale-banner-slider__wrap {
      padding-top: 36px
    }

    .mini-cart__ctas {
      display: flex;
      flex-direction: column;
      gap: 12px
    }

    .mini-cart__ctas .btn {
      display: flex !important;
      justify-content: center !important
    }

    .mini-cart__ctas .btn svg {
      margin: unset !important;
      height: 24px !important;
      width: 24px !important
    }

    .mini-total-price .money {
      color: var(--black)
    }

    :root {
      --swiper-theme-color: #007aff
    }

    :host {
      position: relative;
      display: block;
      margin-left: auto;
      margin-right: auto;
      z-index: 1
    }

    .swiper-wrapper {
      position: relative;
      width: 100%;
      height: 100%;
      z-index: 1;
      display: flex;
      box-sizing: content-box
    }

    .swiper-wrapper {
      transform: translate3d(0, 0, 0)
    }

    .swiper-slide {
      flex-shrink: 0;
      width: 100%;
      height: 100%;
      position: relative;
      display: block
    }

    :root {
      --swiper-navigation-size: 44px
    }

    .predictive-search {
      display: none;
      position: relative;
      top: 100%;
      left: 0;
      z-index: 3;
      background: var(--white);
      border: 1px solid var(--border-color);
      float: left;
      width: 100%;
      padding: 15px 0;
      overflow-y: scroll;
      height: 300px !important;
      max-height: 300px !important;
      margin: 15px 0
    }

    predictive-search:not([loading]) .predictive-search__loading-state {
      display: none
    }

    predictive-search .spinner {
      width: 1.5rem;
      height: 1.5rem;
      line-height: 0
    }

    @media screen and (min-width:1201px) {
      .predictive-search {
        position: absolute
      }
    }

    @media screen and (max-width:767px) {
      .predictive-search--header {
        right: 0;
        left: 0;
        top: 100%;
        padding: 20px 0
      }

      .predictive-search {
        overflow-y: auto;
        -webkit-overflow-scrolling: touch
      }
    }

    :root {
      --first-font: "Baloo 2", sans-serif;
      --second-font: "Baloo 2", sans-serif;
      --third-font: "Baloo 2", sans-serif;
      --theme-color: #6ea622;
      --theme-color-light: #e4edd8;
      --theme-color-dark: #3b5914;
      --second-color: #70ab22;
      --border-color: #d5d5d5;
      --black: #000000;
      --white: #fff;
      --accent-1: #FFA820;
      --grey-400: #F5F5F4;
      --grey-500: #EFEFEF;
      --grey-600: #949494;
      --grey-700: #777171;
      --grey-800: #797676;
      --black-400: #5A5656;
      --h1: normal normal 51px/1.2 var(--second-font);
      --h2: normal 700 32px/1.43 var(--second-font);
      --h3: normal 700 24px/1.33 var(--second-font);
      --h4: normal normal 22px/1.2 var(--second-font);
      --h5: normal normal 20px/1.2 var(--second-font);
      --h6: normal normal 18px/1.2 var(--second-font);
      --common-text: normal 400 16px/1.54 var(--first-font)
    }

    :root {
      --jdgm-primary-color: #6EA622;
      --jdgm-secondary-color: rgba(110, 166, 34, 0.1);
      --jdgm-star-color: #6EA622;
      --jdgm-write-review-text-color: white;
      --jdgm-write-review-bg-color: #6EA622;
      --jdgm-paginate-color: #6EA622;
      --jdgm-border-radius: 0;
      --jdgm-reviewer-name-color: #6EA622
    }

    .jdgm-prev-badge__text {
      display: none !important
    }

    .jdgm-prev-badge__text {
      visibility: hidden
    }

    .jdgm-widget * {
      margin: 0;
      line-height: 1.4;
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      -webkit-overflow-scrolling: touch
    }

    .loading-overlay__spinner {
      display: flex;
      align-items: center;
      justify-content: center
    }

    .loading-overlay__spinner svg {
      animation: 1.4s linear infinite rotator;
      width: 18px;
      height: 18px;
      margin: 0 auto;
      fill: var(--theme-color)
    }

    @keyframes rotator {
      0% {
        transform: rotate(0)
      }

      to {
        transform: rotate(270deg)
      }
    }

    #cart-notification-button {
      margin: 0 0 15px;
      font-family: var(--first-font);
      font-size: 14px;
      font-weight: 600;
      line-height: 17px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-bottom: 1px solid var(--theme-color)
    }

    .cart-notification {
      background: var(--white);
      border-left: 1px solid var(--border-color);
      border-bottom: 1px solid var(--border-color);
      padding: 15px;
      position: fixed;
      right: 0;
      top: 0;
      transform: translateY(-100%);
      opacity: 0;
      visibility: hidden;
      z-index: 3;
      max-width: 380px
    }

    .cart-notification__header {
      gap: 15px;
      display: flex;
      position: relative;
      border-bottom: 1px solid var(--border-color);
      padding: 0 0 15px;
      margin: 0 0 15px
    }

    .cart-notification__heading {
      align-items: center;
      display: flex;
      flex-grow: 1;
      line-height: 1;
      gap: 10px;
      font-weight: 600
    }

    .cart-notification-product {
      align-items: center;
      display: flex;
      border-bottom: 1px solid var(--border-color);
      margin: 0 0 15px;
      padding: 0 0 15px
    }

    .cart-notification__links {
      float: left;
      width: 100%;
      text-align: center
    }

    .cart-notification__links .btn {
      width: 100%;
      margin: 0 0 15px
    }

    .cart-notification__close {
      background: 0 0
    }

    @media (max-width:767px) {
      .cart-notification {
        max-width: 300px;
        padding: 10px
      }

      .cart-notification-product,
      .cart-notification__header {
        padding: 0 0 10px;
        margin: 0 0 10px
      }

      .cart-notification__header svg {
        width: 20px;
        height: 20px
      }
    }

    .sale-banner-slider {
      overflow: hidden
    }

    .sale-banner__pagination {
      display: flex;
      justify-content: center;
      padding-top: 18px
    }

    .category-slider__container {
      overflow: hidden
    }

    .category-slider__header {
      display: flex;
      flex-wrap: nowrap;
      align-items: center;
      justify-content: space-between;
      gap: 8px;
      padding-bottom: 26px
    }

    .category-slider__slide {
      height: auto;
      border-radius: 8px;
      display: flex;
      align-items: start;
      padding: 12px;
      position: relative;
      min-height: 139px;
      justify-content: end;
      overflow: hidden
    }

    .category-slider__slide-text {
      font-size: 20px;
      font-weight: 700;
      color: var(--theme-color-dark);
      text-align: center;
      max-width: 122px
    }

    .category-slider__slide-img {
      position: absolute;
      left: -1px;
      bottom: -1px;
      width: 47%;
      height: 100%;
      background-position: left bottom;
      background-repeat: no-repeat;
      background-size: contain
    }

    .category-slider__navs {
      display: flex;
      align-items: center;
      gap: 6px
    }

    .category-slider__nav {
      width: 30px;
      height: 30px;
      display: flex;
      justify-content: center;
      align-items: center;
      border-radius: 8px;
      color: var(--theme-color-dark);
      background-color: var(--theme-color-light)
    }

    .weekly-specials__container {
      overflow: hidden
    }

    .weekly-specials__title {
      padding-bottom: 26px
    }

    .weekly-specials__slide {
      max-width: 444px;
      padding: 36px 18px 90px;
      border-radius: 12px;
      box-shadow: 8px 4px 12px #0000000d;
      display: flex;
      flex-direction: column;
      gap: 18px;
      position: relative;
      overflow: hidden;
      height: auto
    }

    .weekly-specials__slide-logo {
      width: 120px;
      height: 45px;
      background-size: contain;
      background-repeat: no-repeat;
      background-position: left
    }

    .weekly-specials__slide-featued-img {
      position: absolute;
      bottom: -1px;
      right: 15px;
      width: 40%
    }

    .weekly-specials__slide-text {
      max-width: 305px;
      line-height: 1.625;
      color: var(--white)
    }

    @media screen and (max-width:998px) {
      .weekly-specials__slide-text {
        font-size: 20px
      }

      .weekly-specials__slide-featued-img {
        right: -2px
      }
    }
  </style>


  <!-- End Thunder Critical CSS --->
  <!-- Thunder JS Deferral Removed due to corruption -->
  <!-- End Thunder PageSpeed--->


  <link rel="icon" href="maharaja_logo.png" type="image/png" sizes="48x48">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="theme-color" content="">
  <link rel="canonical" href="https://maharajasupermarket.ro/">
  <link rel="preconnect" href="https://cdn.shopify.com" crossorigin="">
  <meta name="theme-color" content="#6ea622">
  <link rel="icon" type="image/png"
    href="Maharaja Supermarket_48x48_logo_crop=center%26height=32%26v=1740132547%26width=32.png">
  <title>
    Online Indian grocery shopping in Romania - Maharaja Supermarket
  </title>


  <meta name="description"
    content="The best online Indian grocery store near you in Romania. Maharaja Supermarket is an online supermarket for all your daily needs. Online shopping for Indian products is now made easy with Maharaja Supermarket. We offer free delivery for purchases above 199 RON.">




  <meta property="og:site_name" content="Maharaja Supermarket">
  <meta property="og:url" content="https://maharajasupermarket.ro/">
  <meta property="og:title" content="Online Indian grocery shopping in Romania - Maharaja Supermarket">
  <meta property="og:type" content="website">
  <meta property="og:description"
    content="The best online Indian grocery store near you in Romania. Maharaja Supermarket is an online supermarket for all your daily needs. Online shopping for Indian products is now made easy with Maharaja Supermarket. We offer free delivery for purchases above 199 RON.">
  <meta property="og:image"
    content="maharajasupermarket.ro/cdn/shop/files/social_image2_d3907f77-8e0d-4109-8601-ea4565040c9e_v=1726583146.png">
  <meta property="og:image:secure_url"
    content="maharajasupermarket.ro/cdn/shop/files/social_image2_d3907f77-8e0d-4109-8601-ea4565040c9e_v=1726583146.png">
  <meta property="og:image:width" content="1920">
  <meta property="og:image:height" content="1080">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Online Indian grocery shopping in Romania - Maharaja Supermarket">
  <meta name="twitter:description"
    content="The best online Indian grocery store near you in Romania. Maharaja Supermarket is an online supermarket for all your daily needs. Online shopping for Indian products is now made easy with Maharaja Supermarket. We offer free delivery for purchases above 199 RON.">



  <link href="base_v=120674241634719282961742289478.css" rel="stylesheet" type="text/css" media="all">


  <!-- Preconnect to Google Fonts to improve loading time -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
  <link href="https://fonts.googleapis.com/css2?family=Baloo+2:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

  <link href="swiper.min_v=183955486192329526781742289479.css" rel="stylesheet" type="text/css" media="all">
  <link href="jquery.fancybox.min_v=19278034316635137701742289478.css" rel="stylesheet" type="text/css" media="all">
  <link href="custom_v=49670898626099045491747993760.css" rel="stylesheet" type="text/css" media="all">
  <link rel="stylesheet" href="component-predictive-search_v=165047982952875423701742289478.css" media="print"
    onload="this.media='all'"><!-- Load jQuery first, since other scripts might depend on it -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="jquery-cookie.min_v=72365755745404048181742289478.js" defer=""></script>
  <script src="slick.min_v=53086775176596072461742289479.js" defer=""></script>

  <!-- Load deferred scripts -->
  <script src="global_v=83446935447870679591742289478.js" defer=""></script>
  <script src="https://maharajasupermarket.ro/cdn/shopifycloud/storefront/assets/themes_support/api.jquery-7ab1a3a4.js"
    defer=""></script>
  <script src="countdown_v=1097705409581063121742289478.js" defer=""></script>
  <script src="cart-notification_v=21742545381121272691742289478.js" defer=""></script>
  <script src="swiper.min_v=146640479871518466531742289479.js" defer=""></script>

  <!-- Conditional script loading based on locale -->

  <script src="custom_v=171421164427531449841742289478.js" defer=""></script>


  <script>window.performance && window.performance.mark && window.performance.mark('shopify.content_for_header.start');</script>
  <meta name="facebook-domain-verification" content="oj0xj2os2kx72wk4lx67bh8dge0jhx">
  <meta id="shopify-digital-wallet" name="shopify-digital-wallet" content="/63657836700/digital_wallets/dialog">
  <link rel="alternate" hreflang="x-default" href="https://maharajasupermarket.ro/">
  <link rel="alternate" hreflang="ro" href="https://maharajasupermarket.ro/pl">
  <script async="async" src="https://maharajasupermarket.ro/checkouts/internal/preloads_locale=en-PL.js"></script>
  <script id="shopify-features"
    type="application/json">{"accessToken":"d7c85eaf958663b3789361bac4cf2e0f","betas":["rich-media-storefront-analytics"],"domain":"maharajasupermarket.ro","predictiveSearch":true,"shopId":63657836700,"locale":"en"}</script>
  <script>var Shopify = Shopify || {};
    Shopify.shop = "new-Maharaja Supermarket.myshopify.com";
    Shopify.locale = "en";
    Shopify.currency = { "active": "RON", "rate": "1.0" };
    Shopify.country = "RO";
    Shopify.theme = { "name": "Thunder Optimized new-Maharaja Supermarket\/main", "id": 141771800732, "schema_name": "style", "schema_version": "6.2.0", "theme_store_id": null, "role": "main" };
    Shopify.theme.handle = "null";
    Shopify.theme.style = { "id": null, "handle": null };
    Shopify.cdnHost = "maharajasupermarket.ro/cdn";
    Shopify.routes = Shopify.routes || {};
    Shopify.routes.root = "/";</script>
  <script type="module">!function (o) { (o.Shopify = o.Shopify || {}).modules = !0 }(window);</script>
  <script>!function (o) { function n() { var o = []; function n() { o.push(Array.prototype.slice.apply(arguments)) } return n.q = o, n } var t = o.Shopify = o.Shopify || {}; t.loadFeatures = n(), t.autoloadFeatures = n() }(window);</script>
  <script id="shop-js-analytics" type="application/json">{"pageType":"index"}</script>
  <script defer="defer" async="" type="module"
    src="https://maharajasupermarket.ro/cdn/shopifycloud/shop-js/modules/v2/client.init-shop-cart-sync_DtuiiIyl.en.esm.js"></script>
  <script defer="defer" async="" type="module"
    src="https://maharajasupermarket.ro/cdn/shopifycloud/shop-js/modules/v2/chunk.common_CUHEfi5Q.esm.js"></script>
  <script type="module">
    await import("//maharajasupermarket.ro/cdn/shopifycloud/shop-js/modules/v2/client.init-shop-cart-sync_DtuiiIyl.en.esm.js");
    await import("//maharajasupermarket.ro/cdn/shopifycloud/shop-js/modules/v2/chunk.common_CUHEfi5Q.esm.js");

    window.Shopify.SignInWithShop?.initShopCartSync?.({ "fedCMEnabled": true, "windoidEnabled": true });

  </script>
  <script
    id="__st">var __st = { "a": 63657836700, "offset": 3600, "reqid": "749581cf-7a87-4855-b171-ef805b7411b4-1767159292", "pageurl": "maharajasupermarket.ro\/", "u": "7831b3865bd0", "p": "home" };</script>
  <script>window.ShopifyPaypalV4VisibilityTracking = true;</script>
  <script
    id="captcha-bootstrap">!function () { 'use strict'; const t = 'contact', e = 'account', n = 'new_comment', o = [[t, t], ['blogs', n], ['comments', n], [t, 'customer']], c = [[e, 'customer_login'], [e, 'guest_login'], [e, 'recover_customer_password'], [e, 'create_customer']], r = t => t.map((([t, e]) => `form[action*='/${t}']:not([data-nocaptcha='true']) input[name='form_type'][value='${e}']`)).join(','), a = t => () => t ? [...document.querySelectorAll(t)].map((t => t.form)) : []; function s() { const t = [...o], e = r(t); return a(e) } const i = 'password', u = 'form_key', d = ['recaptcha-v3-token', 'g-recaptcha-response', 'h-captcha-response', i], f = () => { try { return window.sessionStorage } catch { return } }, m = '__shopify_v', _ = t => t.elements[u]; function p(t, e, n = !1) { try { const o = window.sessionStorage, c = JSON.parse(o.getItem(e)), { data: r } = function (t) { const { data: e, action: n } = t; return t[m] || n ? { data: e, action: n } : { data: t, action: n } }(c); for (const [e, n] of Object.entries(r)) t.elements[e] && (t.elements[e].value = n); n && o.removeItem(e) } catch (o) { console.error('form repopulation failed', { error: o }) } } const l = 'form_type', E = 'cptcha'; function T(t) { t.dataset[E] = !0 } const w = window, h = w.document, L = 'Shopify', v = 'ce_forms', y = 'captcha'; let A = !1; ((t, e) => { const n = (g = 'f06e6c50-85a8-45c8-87d0-21a2b65856fe', I = 'https://cdn.shopify.com/shopifycloud/storefront-forms-hcaptcha/ce_storefront_forms_captcha_hcaptcha.v1.5.2.iife.js', D = { infoText: 'Protected by hCaptcha', privacyText: 'Privacy', termsText: 'Terms' }, (t, e, n) => { const o = w[L][v], c = o.bindForm; if (c) return c(t, g, e, D).then(n); var r; o.q.push([[t, g, e, D], n]), r = I, A || (h.body.append(Object.assign(h.createElement('script'), { id: 'captcha-provider', async: !0, src: r })), A = !0) }); var g, I, D; w[L] = w[L] || {}, w[L][v] = w[L][v] || {}, w[L][v].q = [], w[L][y] = w[L][y] || {}, w[L][y].protect = function (t, e) { n(t, void 0, e), T(t) }, Object.freeze(w[L][y]), function (t, e, n, w, h, L) { const [v, y, A, g] = function (t, e, n) { const i = e ? o : [], u = t ? c : [], d = [...i, ...u], f = r(d), m = r(i), _ = r(d.filter((([t, e]) => n.includes(e)))); return [a(f), a(m), a(_), s()] }(w, h, L), I = t => { const e = t.target; return e instanceof HTMLFormElement ? e : e && e.form }, D = t => v().includes(t); t.addEventListener('submit', (t => { const e = I(t); if (!e) return; const n = D(e) && !e.dataset.hcaptchaBound && !e.dataset.recaptchaBound, o = _(e), c = g().includes(e) && (!o || !o.value); (n || c) && t.preventDefault(), c && !n && (function (t) { try { if (!f()) return; !function (t) { const e = f(); if (!e) return; const n = _(t); if (!n) return; const o = n.value; o && e.removeItem(o) }(t); const e = Array.from(Array(32), (() => Math.random().toString(36)[2])).join(''); !function (t, e) { _(t) || t.append(Object.assign(document.createElement('input'), { type: 'hidden', name: u })), t.elements[u].value = e }(t, e), function (t, e) { const n = f(); if (!n) return; const o = [...t.querySelectorAll(`input[type='${i}']`)].map((({ name: t }) => t)), c = [...d, ...o], r = {}; for (const [a, s] of new FormData(t).entries()) c.includes(a) || (r[a] = s); n.setItem(e, JSON.stringify({ [m]: 1, action: t.action, data: r })) }(t, e) } catch (e) { console.error('failed to persist form', e) } }(e), e.submit()) })); const S = (t, e) => { t && !t.dataset[E] && (n(t, e.some((e => e === t))), T(t)) }; for (const o of ['focusin', 'change']) t.addEventListener(o, (t => { const e = I(t); D(e) && S(e, y()) })); const B = e.get('form_key'), M = e.get(l), P = B && M; t.addEventListener('DOMContentLoaded', (() => { const t = y(); if (P) for (const e of t) e.elements[l].value === M && p(e, B);[...new Set([...A(), ...v().filter((t => 'true' === t.dataset.shopifyCaptcha))])].forEach((e => S(e, t))) })) }(h, new URLSearchParams(w.location.search), n, t, e, ['guest_login']) })(!0, !0) }();</script>
  <script data-source-attribution="shopify.loadfeatures" defer="defer"
    src="https://maharajasupermarket.ro/cdn/shopifycloud/storefront/assets/storefront/load_feature-a0a9edcb.js"
    crossorigin="anonymous"></script>
  <script>
    fetch('/sf_private_access_tokens' + location.search).catch(() => { });
  </script>
  <script data-source-attribution="shopify.dynamic_checkout.dynamic.init">var Shopify = Shopify || {}; Shopify.PaymentButton = Shopify.PaymentButton || { isStorefrontPortableWallets: !0, init: function () { window.Shopify.PaymentButton.init = function () { }; var t = document.createElement("script"); t.src = "https://maharajasupermarket.ro/cdn/shopifycloud/portable-wallets/latest/portable-wallets.en.js", t.type = "module", document.head.appendChild(t) } };
  </script>
  <script data-source-attribution="shopify.dynamic_checkout.buyer_consent">
    function portableWalletsHideBuyerConsent(e) { var t = document.getElementById("shopify-buyer-consent"), n = document.getElementById("shopify-subscription-policy-button"); t && n && (t.classList.add("hidden"), t.setAttribute("aria-hidden", "true"), n.removeEventListener("click", e)) } function portableWalletsShowBuyerConsent(e) { var t = document.getElementById("shopify-buyer-consent"), n = document.getElementById("shopify-subscription-policy-button"); t && n && (t.classList.remove("hidden"), t.removeAttribute("aria-hidden"), n.addEventListener("click", e)) } window.Shopify?.PaymentButton && (window.Shopify.PaymentButton.hideBuyerConsent = portableWalletsHideBuyerConsent, window.Shopify.PaymentButton.showBuyerConsent = portableWalletsShowBuyerConsent);
  </script>
  <script data-source-attribution="shopify.dynamic_checkout.cart.bootstrap">document.addEventListener("DOMContentLoaded", (function () { function t() { return document.querySelector("shopify-accelerated-checkout-cart, shopify-accelerated-checkout") } if (t()) Shopify.PaymentButton.init(); else { new MutationObserver((function (e, n) { t() && (Shopify.PaymentButton.init(), n.disconnect()) })).observe(document.body, { childList: !0, subtree: !0 }) } }));
  </script>
  <script id="scb4127" type="text/javascript" async="" src="storefront-banner.js"></script>
  <script id="sections-script" data-sections="header" defer="defer" src="scripts_12276.js"></script>
  <script>window.performance && window.performance.mark && window.performance.mark('shopify.content_for_header.end');</script>
  <style data-shopify="">
    :root {
      --first-font: "Baloo 2", sans-serif;
      --second-font: "Baloo 2", sans-serif;
      --third-font: "Baloo 2", sans-serif;
      --theme-color: #6ea622;
      --theme-color-light: #e4edd8;
      --theme-color-dark: #3b5914;
      --second-color: #70ab22;
      --border-color: #d5d5d5;
      --black: #000000;
      --white: #fff;
      --accent-1: #FFA820;
      --grey-400: #F5F5F4;
      --grey-500: #EFEFEF;
      --grey-600: #949494;
      --grey-700: #777171;
      --grey-800: #797676;
      --black-400: #5A5656;
      --h1: normal normal 51px/1.2 var(--second-font);
      --h2: normal 700 32px/1.43 var(--second-font);
      --h3: normal 700 24px/1.33 var(--second-font);
      --h4: normal normal 22px/1.2 var(--second-font);
      --h5: normal normal 20px/1.2 var(--second-font);
      --h6: normal normal 18px/1.2 var(--second-font);
      --common-text: normal 400 16px/1.54 var(--first-font);
    }
  </style>

  <script>
    document.documentElement.className = document.documentElement.className.replace('no-js', 'js');
    if (Shopify.designMode) {
      document.documentElement.classList.add('shopify-design-mode');
    }
  </script>
  <!-- BEGIN app block: shopify://apps/seolab-seo-optimizer/blocks/app_embed/faf700f6-3b71-45c3-86d4-83ea9f7d9216 -->

  <script type="application/ld+json">
    [
        
        
        
        
        
        
        
            
            {
                "@context": "http://www.schema.org",
                "@type": "WebSite",
                "url": "https://maharajasupermarket.ro",
                "potentialAction": {
                    "@type": "SearchAction",
                    "target": {
                        "@type": "EntryPoint",
                        "urlTemplate": "https://maharajasupermarket.ro/search?q={query}"
                    },
                    "query-input": "required name=query"
                }
            }
            
        
        
        
        
        
        
        
        
        
        
        
        
    ]
</script>



  <script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function (e) { var n = window.location.href; if (n.indexOf("#seotid") > -1) { var t = n.split("#seotid"); let p = new Headers; p.append("Content-Type", "application/json"); let o = new FormData; o.append("shop", "new-Maharaja Supermarket.myshopify.com"), o.append("tid", t[1]), o.append("type", "add_traffic"), fetch("/apps/seo-lab", { method: "POST", headers: { Accept: "application/json" }, body: o }).then(e => e.json()).then(e => { window.history.replaceState({}, '', t[0]) }) } else fetch(n, { method: "HEAD" }).then(e => { if (404 === e.status) { var t = n.split(window.location.origin); let p = new FormData; p.append("shop", "new-Maharaja Supermarket.myshopify.com"), p.append("url", t[1]), p.append("type", "unresolve_url_recieve"), fetch("/apps/seo-lab", { method: "POST", headers: { Accept: "application/json" }, body: p }).then(e => e.json()).then(e => { e.success && console.log("Added") }) } }) });
  </script>






  <!-- END app block --><!-- BEGIN app block: shopify://apps/judge-me-reviews/blocks/judgeme_core/61ccd3b1-a9f2-4160-9fe9-4fec8413e5d8 --><!-- Start of Judge.me Core -->






  <link rel="dns-prefetch" href="https://cdnwidget.judge.me">
  <link rel="dns-prefetch" href="https://cdn.judge.me">
  <link rel="dns-prefetch" href="https://cdn1.judge.me">
  <link rel="dns-prefetch" href="https://api.judge.me">

  <script data-cfasync="false"
    class="jdgm-settings-script">window.jdgmSettings = { "pagination": 5, "disable_web_reviews": false, "badge_no_review_text": "No reviews", "badge_n_reviews_text": "{{ n }} review/reviews", "hide_badge_preview_if_no_reviews": false, "badge_hide_text": true, "enforce_center_preview_badge": false, "widget_title": "Customer Reviews", "widget_open_form_text": "Write a review", "widget_close_form_text": "Cancel review", "widget_refresh_page_text": "Refresh page", "widget_summary_text": "Based on {{ number_of_reviews }} review/reviews", "widget_no_review_text": "Be the first to write a review", "widget_name_field_text": "Display name", "widget_verified_name_field_text": "Verified Name (public)", "widget_name_placeholder_text": "Display name", "widget_required_field_error_text": "This field is required.", "widget_email_field_text": "Email address", "widget_verified_email_field_text": "Verified Email (private, can not be edited)", "widget_email_placeholder_text": "Your email address", "widget_email_field_error_text": "Please enter a valid email address.", "widget_rating_field_text": "Rating", "widget_review_title_field_text": "Review Title", "widget_review_title_placeholder_text": "Give your review a title", "widget_review_body_field_text": "Review content", "widget_review_body_placeholder_text": "Start writing here...", "widget_pictures_field_text": "Picture/Video (optional)", "widget_submit_review_text": "Submit Review", "widget_submit_verified_review_text": "Submit Verified Review", "widget_submit_success_msg_with_auto_publish": "Thank you! Please refresh the page in a few moments to see your review. You can remove or edit your review by logging into \u003ca href='https://judge.me/login' target='_blank' rel='nofollow noopener'\u003eJudge.me\u003c/a\u003e", "widget_submit_success_msg_no_auto_publish": "Thank you! Your review will be published as soon as it is approved by the shop admin. You can remove or edit your review by logging into \u003ca href='https://judge.me/login' target='_blank' rel='nofollow noopener'\u003eJudge.me\u003c/a\u003e", "widget_show_default_reviews_out_of_total_text": "Showing {{ n_reviews_shown }} out of {{ n_reviews }} reviews.", "widget_show_all_link_text": "Show all", "widget_show_less_link_text": "Show less", "widget_author_said_text": "{{ reviewer_name }} said:", "widget_days_text": "{{ n }} days ago", "widget_weeks_text": "{{ n }} week/weeks ago", "widget_months_text": "{{ n }} month/months ago", "widget_years_text": "{{ n }} year/years ago", "widget_yesterday_text": "Yesterday", "widget_today_text": "Today", "widget_replied_text": "\u003e\u003e {{ shop_name }} replied:", "widget_read_more_text": "Read more", "widget_rating_filter_see_all_text": "See all reviews", "widget_sorting_most_recent_text": "Most Recent", "widget_sorting_highest_rating_text": "Highest Rating", "widget_sorting_lowest_rating_text": "Lowest Rating", "widget_sorting_with_pictures_text": "Only Pictures", "widget_sorting_most_helpful_text": "Most Helpful", "widget_open_question_form_text": "Ask a question", "widget_reviews_subtab_text": "Reviews", "widget_questions_subtab_text": "Questions", "widget_question_label_text": "Question", "widget_answer_label_text": "Answer", "widget_question_placeholder_text": "Write your question here", "widget_submit_question_text": "Submit Question", "widget_question_submit_success_text": "Thank you for your question! We will notify you once it gets answered.", "verified_badge_text": "Verified", "verified_badge_placement": "left-of-reviewer-name", "widget_hide_border": false, "widget_social_share": false, "all_reviews_include_out_of_store_products": true, "all_reviews_out_of_store_text": "(out of store)", "all_reviews_product_name_prefix_text": "about", "enable_review_pictures": true, "review_date_format": "dd/mm/yyyy", "widget_product_reviews_subtab_text": "Product Reviews", "widget_shop_reviews_subtab_text": "Shop Reviews", "widget_write_a_store_review_text": "Write a Store Review", "widget_other_languages_heading": "Reviews in Other Languages", "widget_translate_review_text": "Translate review to {{ language }}", "widget_translating_review_text": "Translating...", "widget_show_original_translation_text": "Show original ({{ language }})", "widget_translate_review_failed_text": "Review couldn't be translated.", "widget_translate_review_retry_text": "Retry", "widget_translate_review_try_again_later_text": "Try again later", "widget_sorting_pictures_first_text": "Pictures First", "floating_tab_button_name": "★ Reviews", "floating_tab_title": "Let customers speak for us", "floating_tab_url": "", "floating_tab_url_enabled": false, "all_reviews_text_badge_text": "Customers rate us {{ shop.metafields.judgeme.all_reviews_rating | round: 1 }}/5 based on {{ shop.metafields.judgeme.all_reviews_count }} reviews.", "all_reviews_text_badge_text_branded_style": "{{ shop.metafields.judgeme.all_reviews_rating | round: 1 }} out of 5 stars based on {{ shop.metafields.judgeme.all_reviews_count }} reviews", "all_reviews_text_badge_url": "", "all_reviews_text_style": "branded", "featured_carousel_title": "Let customers speak for us", "featured_carousel_count_text": "from {{ n }} reviews", "featured_carousel_url": "", "verified_count_badge_style": "branded", "verified_count_badge_url": "", "picture_reminder_submit_button": "Upload Pictures", "widget_sorting_videos_first_text": "Videos First", "widget_review_pending_text": "Pending", "remove_microdata_snippet": false, "preview_badge_no_question_text": "No questions", "preview_badge_n_question_text": "{{ number_of_questions }} question/questions", "widget_search_bar_placeholder": "Search reviews", "widget_sorting_verified_only_text": "Verified only", "featured_carousel_verified_badge_enable": true, "featured_carousel_more_reviews_button_text": "Read more reviews", "featured_carousel_view_product_button_text": "View product", "all_reviews_page_load_more_text": "Load More Reviews", "widget_advanced_speed_features": 5, "widget_public_name_text": "displayed publicly like", "default_reviewer_name_has_non_latin": true, "widget_reviewer_anonymous": "Anonymous", "medals_widget_title": "Judge.me Review Medals", "widget_invalid_yt_video_url_error_text": "Not a YouTube video URL", "widget_max_length_field_error_text": "Please enter no more than {0} characters.", "widget_verified_by_shop_text": "Verified by Shop", "widget_load_with_code_splitting": true, "widget_ugc_title": "Made by us, Shared by you", "widget_ugc_subtitle": "Tag us to see your picture featured in our page", "widget_ugc_primary_button_text": "Buy Now", "widget_ugc_secondary_button_text": "Load More", "widget_ugc_reviews_button_text": "View Reviews", "widget_primary_color": "#6EA622", "widget_summary_average_rating_text": "{{ average_rating }} out of 5", "widget_media_grid_title": "Customer photos \u0026 videos", "widget_media_grid_see_more_text": "See more", "widget_verified_by_judgeme_text": "Verified by Judge.me", "widget_verified_by_judgeme_text_in_store_medals": "Verified by Judge.me", "widget_media_field_exceed_quantity_message": "Sorry, we can only accept {{ max_media }} for one review.", "widget_media_field_exceed_limit_message": "{{ file_name }} is too large, please select a {{ media_type }} less than {{ size_limit }}MB.", "widget_review_submitted_text": "Review Submitted!", "widget_question_submitted_text": "Question Submitted!", "widget_close_form_text_question": "Cancel", "widget_write_your_answer_here_text": "Write your answer here", "widget_enabled_branded_link": true, "widget_show_collected_by_judgeme": true, "widget_collected_by_judgeme_text": "collected by Judge.me", "widget_load_more_text": "Load More", "widget_full_review_text": "Full Review", "widget_read_more_reviews_text": "Read More Reviews", "widget_read_questions_text": "Read Questions", "widget_questions_and_answers_text": "Questions \u0026 Answers", "widget_verified_by_text": "Verified by", "widget_verified_text": "Verified", "widget_number_of_reviews_text": "{{ number_of_reviews }} reviews", "widget_back_button_text": "Back", "widget_next_button_text": "Next", "widget_custom_forms_filter_button": "Filters", "how_reviews_are_collected": "How reviews are collected?", "widget_gdpr_statement": "How we use your data: We'll only contact you about the review you left, and only if necessary. By submitting your review, you agree to Judge.me's \u003ca href='https://judge.me/terms' target='_blank' rel='nofollow noopener'\u003eterms\u003c/a\u003e, \u003ca href='https://judge.me/privacy' target='_blank' rel='nofollow noopener'\u003eprivacy\u003c/a\u003e and \u003ca href='https://judge.me/content-policy' target='_blank' rel='nofollow noopener'\u003econtent\u003c/a\u003e policies.", "review_snippet_widget_round_border_style": true, "review_snippet_widget_card_color": "#FFFFFF", "review_snippet_widget_slider_arrows_background_color": "#FFFFFF", "review_snippet_widget_slider_arrows_color": "#000000", "review_snippet_widget_star_color": "#108474", "all_reviews_product_variant_label_text": "Variant: ", "widget_show_verified_branding": true, "review_content_screen_title_text": "How would you rate this product?", "review_content_introduction_text": "We would love it if you would share a bit about your experience.", "one_star_review_guidance_text": "Poor", "five_star_review_guidance_text": "Great", "customer_information_screen_title_text": "About you", "customer_information_introduction_text": "Please tell us more about you.", "custom_questions_screen_title_text": "Your experience in more detail", "custom_questions_introduction_text": "Here are a few questions to help us understand more about your experience.", "review_submitted_screen_title_text": "Thanks for your review!", "review_submitted_screen_thank_you_text": "We are processing it and it will appear on the store soon.", "review_submitted_screen_email_verification_text": "Please confirm your email by clicking the link we just sent you. This helps us keep reviews authentic.", "review_submitted_request_store_review_text": "Would you like to share your experience of shopping with us?", "review_submitted_review_other_products_text": "Would you like to review these products?", "reviewer_media_screen_title_picture_text": "Share a picture", "reviewer_media_introduction_picture_text": "Upload a photo to support your review.", "reviewer_media_screen_title_video_text": "Share a video", "reviewer_media_introduction_video_text": "Upload a video to support your review.", "reviewer_media_screen_title_picture_or_video_text": "Share a picture or video", "reviewer_media_introduction_picture_or_video_text": "Upload a photo or video to support your review.", "reviewer_media_youtube_url_text": "Paste your Youtube URL here", "advanced_settings_next_step_button_text": "Next", "advanced_settings_close_review_button_text": "Close", "write_review_flow_required_text": "Required", "write_review_flow_privacy_message_text": "We respect your privacy.", "write_review_flow_anonymous_text": "Post review as anonymous", "write_review_flow_visibility_text": "This won't be visible to other customers.", "write_review_flow_multiple_selection_help_text": "Select as many as you like", "write_review_flow_single_selection_help_text": "Select one option", "write_review_flow_required_field_error_text": "This field is required", "write_review_flow_invalid_email_error_text": "Please enter a valid email address", "write_review_flow_max_length_error_text": "Max. {{ max_length }} characters.", "write_review_flow_media_upload_text": "\u003cb\u003eClick to upload\u003c/b\u003e or drag and drop", "write_review_flow_gdpr_statement": "We'll only contact you about your review if necessary. By submitting your review, you agree to our \u003ca href='https://judge.me/terms' target='_blank' rel='nofollow noopener'\u003eterms and conditions\u003c/a\u003e and \u003ca href='https://judge.me/privacy' target='_blank' rel='nofollow noopener'\u003eprivacy policy\u003c/a\u003e.", "transparency_badges_collected_via_store_invite_text": "Review collected via store invitation", "transparency_badges_from_another_provider_text": "Review collected from another provider", "transparency_badges_collected_from_store_visitor_text": "Review collected from a store visitor", "transparency_badges_written_in_google_text": "Review written in Google", "transparency_badges_written_in_etsy_text": "Review written in Etsy", "transparency_badges_written_in_shop_app_text": "Review written in Shop App", "transparency_badges_earned_reward_text": "Review earned a reward for future purchase", "platform": "shopify", "branding_url": "https://app.judge.me/reviews", "branding_text": "Powered by Judge.me", "locale": "en", "reply_name": "Maharaja Supermarket", "widget_version": "3.0", "footer": true, "autopublish": true, "review_dates": true, "enable_custom_form": false, "shop_locale": "en", "enable_multi_locales_translations": false, "show_review_title_input": true, "review_verification_email_status": "always", "can_be_branded": true, "reply_name_text": "Maharaja Supermarket" };</script>
  <style class="jdgm-settings-style">
    .jdgm-xx {
      left: 0
    }

    :root {
      --jdgm-primary-color: #6EA622;
      --jdgm-secondary-color: rgba(110, 166, 34, 0.1);
      --jdgm-star-color: #6EA622;
      --jdgm-write-review-text-color: white;
      --jdgm-write-review-bg-color: #6EA622;
      --jdgm-paginate-color: #6EA622;
      --jdgm-border-radius: 0;
      --jdgm-reviewer-name-color: #6EA622
    }

    .jdgm-histogram__bar-content {
      background-color: #6EA622
    }

    .jdgm-rev[data-verified-buyer=true] .jdgm-rev__icon.jdgm-rev__icon:after,
    .jdgm-rev__buyer-badge.jdgm-rev__buyer-badge {
      color: white;
      background-color: #6EA622
    }

    .jdgm-review-widget--small .jdgm-gallery.jdgm-gallery .jdgm-gallery__thumbnail-link:nth-child(8) .jdgm-gallery__thumbnail-wrapper.jdgm-gallery__thumbnail-wrapper:before {
      content: "See more"
    }

    @media only screen and (min-width: 768px) {
      .jdgm-gallery.jdgm-gallery .jdgm-gallery__thumbnail-link:nth-child(8) .jdgm-gallery__thumbnail-wrapper.jdgm-gallery__thumbnail-wrapper:before {
        content: "See more"
      }
    }

    .jdgm-prev-badge__text {
      display: none !important
    }

    .jdgm-author-all-initials {
      display: none !important
    }

    .jdgm-author-last-initial {
      display: none !important
    }

    .jdgm-rev-widg__title {
      visibility: hidden
    }

    .jdgm-rev-widg__summary-text {
      visibility: hidden
    }

    .jdgm-prev-badge__text {
      visibility: hidden
    }

    .jdgm-rev__prod-link-prefix:before {
      content: 'about'
    }

    .jdgm-rev__variant-label:before {
      content: 'Variant: '
    }

    .jdgm-rev__out-of-store-text:before {
      content: '(out of store)'
    }

    @media only screen and (min-width: 768px) {

      .jdgm-rev__pics .jdgm-rev_all-rev-page-picture-separator,
      .jdgm-rev__pics .jdgm-rev__product-picture {
        display: none
      }
    }

    @media only screen and (max-width: 768px) {

      .jdgm-rev__pics .jdgm-rev_all-rev-page-picture-separator,
      .jdgm-rev__pics .jdgm-rev__product-picture {
        display: none
      }
    }

    .jdgm-preview-badge[data-template="product"] {
      display: none !important
    }

    .jdgm-preview-badge[data-template="collection"] {
      display: none !important
    }

    .jdgm-preview-badge[data-template="index"] {
      display: none !important
    }

    .jdgm-review-widget[data-from-snippet="true"] {
      display: none !important
    }

    .jdgm-verified-count-badget[data-from-snippet="true"] {
      display: none !important
    }

    .jdgm-carousel-wrapper[data-from-snippet="true"] {
      display: none !important
    }

    .jdgm-all-reviews-text[data-from-snippet="true"] {
      display: none !important
    }

    .jdgm-medals-section[data-from-snippet="true"] {
      display: none !important
    }

    .jdgm-ugc-media-wrapper[data-from-snippet="true"] {
      display: none !important
    }

    .jdgm-review-snippet-widget .jdgm-rev-snippet-widget__cards-container .jdgm-rev-snippet-card {
      border-radius: 8px;
      background: #fff
    }

    .jdgm-review-snippet-widget .jdgm-rev-snippet-widget__cards-container .jdgm-rev-snippet-card__rev-rating .jdgm-star {
      color: #108474
    }

    .jdgm-review-snippet-widget .jdgm-rev-snippet-widget__prev-btn,
    .jdgm-review-snippet-widget .jdgm-rev-snippet-widget__next-btn {
      border-radius: 50%;
      background: #fff
    }

    .jdgm-review-snippet-widget .jdgm-rev-snippet-widget__prev-btn>svg,
    .jdgm-review-snippet-widget .jdgm-rev-snippet-widget__next-btn>svg {
      fill: #000
    }

    .jdgm-full-rev-modal.rev-snippet-widget .jm-mfp-container .jm-mfp-content,
    .jdgm-full-rev-modal.rev-snippet-widget .jm-mfp-container .jdgm-full-rev__icon,
    .jdgm-full-rev-modal.rev-snippet-widget .jm-mfp-container .jdgm-full-rev__pic-img,
    .jdgm-full-rev-modal.rev-snippet-widget .jm-mfp-container .jdgm-full-rev__reply {
      border-radius: 8px
    }

    .jdgm-full-rev-modal.rev-snippet-widget .jm-mfp-container .jdgm-full-rev[data-verified-buyer="true"] .jdgm-full-rev__icon::after {
      border-radius: 8px
    }

    .jdgm-full-rev-modal.rev-snippet-widget .jm-mfp-container .jdgm-full-rev .jdgm-rev__buyer-badge {
      border-radius: calc(8px / 2)
    }

    .jdgm-full-rev-modal.rev-snippet-widget .jm-mfp-container .jdgm-full-rev .jdgm-full-rev__replier::before {
      content: 'Maharaja Supermarket'
    }

    .jdgm-full-rev-modal.rev-snippet-widget .jm-mfp-container .jdgm-full-rev .jdgm-full-rev__product-button {
      border-radius: calc(8px * 6)
    }
  </style>
  <style class="jdgm-settings-style"></style>




  <style class="jdgm-miracle-styles">
    @-webkit-keyframes jdgm-spin {
      0% {
        -webkit-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        transform: rotate(0deg)
      }

      100% {
        -webkit-transform: rotate(359deg);
        -ms-transform: rotate(359deg);
        transform: rotate(359deg)
      }
    }

    @keyframes jdgm-spin {
      0% {
        -webkit-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        transform: rotate(0deg)
      }

      100% {
        -webkit-transform: rotate(359deg);
        -ms-transform: rotate(359deg);
        transform: rotate(359deg)
      }
    }

    @font-face {
      font-family: 'JudgemeStar';
      src: url("data:application/x-font-woff;charset=utf-8;base64,d09GRgABAAAAAAScAA0AAAAABrAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABGRlRNAAAEgAAAABoAAAAcbyQ+3kdERUYAAARgAAAAHgAAACAAMwAGT1MvMgAAAZgAAABGAAAAVi+vS9xjbWFwAAAB8AAAAEAAAAFKwBMjvmdhc3AAAARYAAAACAAAAAj//wADZ2x5ZgAAAkAAAAEJAAABdH33LXtoZWFkAAABMAAAAC0AAAA2BroQKWhoZWEAAAFgAAAAHAAAACQD5QHQaG10eAAAAeAAAAAPAAAAFAYAAABsb2NhAAACMAAAAA4AAAAOAO4AeG1heHAAAAF8AAAAHAAAACAASgAvbmFtZQAAA0wAAADeAAABkorWfVZwb3N0AAAELAAAACkAAABEp3ubLXgBY2BkYADhPPP4OfH8Nl8ZuJkYQODS2fRrCPr/aSYGxq1ALgcDWBoAO60LkwAAAHgBY2BkYGDc+v80gx4TAwgASaAICmABAFB+Arl4AWNgZGBgYGPQYWBiAAIwyQgWc2AAAwAHVQB6eAFjYGRiYJzAwMrAwejDmMbAwOAOpb8ySDK0MDAwMbByMsCBAAMCBKS5pjA4PGB4wMR44P8BBj3GrQymQGFGkBwAjtgK/gAAeAFjYoAAEA1jAwAAZAAHAHgB3crBCcAwDEPRZydkih567CDdf4ZskmLwFBV8xBfCaC4BXkOUmx4sU0h2ngNb9V0vQCxaRKIAevT7fGWuBrEAAAAAAAAAAAA0AHgAugAAeAF9z79Kw1AUx/FzTm7un6QmJtwmQ5Bg1abgEGr/BAqlU6Gju+Cgg1MkQ/sA7Vj7BOnmO/gUvo2Lo14NqIO6/IazfD8HEODtmQCfoANwNsyp2/GJt3WKQrd1NLiYYWx2PBqOsmJMEOznPOTzfSCrhAtbbLdmeFLJV9eKd63WLrZcIcuaEVdssWCKM6pLCfTVOYbz/0pNSMSZKLIZpvh78sAUH6PlMrreTCabP9r+Z/puPZ2ur/RqpQHgh+MIegCnXeM4MRAPjYN//5tj4ZtTjkFqEdmeMShlEJ7tVAly2TAkx6R68Fl4E/aVvn8JqHFQ4JS1434gXKcuL31dDhzs3YbsEOAd/IU88gAAAHgBfY4xTgMxEEVfkk0AgRCioKFxQYd2ZRtpixxgRU2RfhU5q5VWseQ4JdfgAJyBlmNwAM7ABRhZQ0ORwp7nr+eZAa54YwYg9zm3ynPOeFRe8MCrciXOh/KSS76UV5L/iDmrLiS5AeU519wrL3jmSbkS5115yR2fyivJv9kx0ZMZ2RLZw27q87iNQi8EBo5FSPIMw3HqBboi5lKTGAGDp8FKXWP+t9TU01Lj5His1Ba6uM9dTEMwvrFmbf5GC/q2drW3ruXUhhsCiQOjznFlCzYhHUZp4xp76vsvQh89CQAAeAFjYGJABowM6IANLMrEyMTIzMjCXpyRWJBqZshWXJJYBKOMAFHFBucAAAAAAAAB//8AAngBY2BkYGDgA2IJBhBgAvKZGViBJAuYxwAABJsAOgAAeAFjYGBgZACCk535hiD60tn0azAaAEqpB6wAAA==") format("woff");
      font-weight: normal;
      font-style: normal
    }

    .jdgm-star {
      font-family: 'JudgemeStar';
      display: inline !important;
      text-decoration: none !important;
      padding: 0 4px 0 0 !important;
      margin: 0 !important;
      font-weight: bold;
      opacity: 1;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale
    }

    .jdgm-star:hover {
      opacity: 1
    }

    .jdgm-star:last-of-type {
      padding: 0 !important
    }

    .jdgm-star.jdgm--on:before {
      content: "\e000"
    }

    .jdgm-star.jdgm--off:before {
      content: "\e001"
    }

    .jdgm-star.jdgm--half:before {
      content: "\e002"
    }

    .jdgm-widget * {
      margin: 0;
      line-height: 1.4;
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      -webkit-overflow-scrolling: touch
    }

    .jdgm-hidden {
      display: none !important;
      visibility: hidden !important
    }

    .jdgm-temp-hidden {
      display: none
    }

    .jdgm-spinner {
      width: 40px;
      height: 40px;
      margin: auto;
      border-radius: 50%;
      border-top: 2px solid #eee;
      border-right: 2px solid #eee;
      border-bottom: 2px solid #eee;
      border-left: 2px solid #ccc;
      -webkit-animation: jdgm-spin 0.8s infinite linear;
      animation: jdgm-spin 0.8s infinite linear
    }

    .jdgm-prev-badge {
      display: block !important
    }
  </style>







  <script data-cfasync="false" class="jdgm-script">
    !function (e) {
      window.jdgm = window.jdgm || {}, jdgm.CDN_HOST = "https://cdnwidget.judge.me/", jdgm.CDN_HOST_ALT = "https://cdn2.judge.me/cdn/widget_frontend/", jdgm.API_HOST = "https://api.judge.me/", jdgm.CDN_BASE_URL = "https://cdn.shopify.com/extensions/019b6f19-d7c7-7ca1-89ad-a74ff61adfb5/judgeme-extensions-278/assets/",
        jdgm.docReady = function (d) {
          (e.attachEvent ? "complete" === e.readyState : "loading" !== e.readyState) ?
            setTimeout(d, 0) : e.addEventListener("DOMContentLoaded", d)
        }, jdgm.loadCSS = function (d, t, o, a) {
          !o && jdgm.loadCSS.requestedUrls.indexOf(d) >= 0 || (jdgm.loadCSS.requestedUrls.push(d),
            (a = e.createElement("link")).rel = "stylesheet", a.class = "jdgm-stylesheet", a.media = "nope!",
            a.href = d, a.onload = function () { this.media = "all", t && setTimeout(t) }, e.body.appendChild(a))
        },
        jdgm.loadCSS.requestedUrls = [], jdgm.loadJS = function (e, d) {
          var t = new XMLHttpRequest;
          t.onreadystatechange = function () { 4 === t.readyState && (Function(t.response)(), d && d(t.response)) },
            t.open("GET", e), t.onerror = function () { if (e.indexOf(jdgm.CDN_HOST) === 0 && jdgm.CDN_HOST_ALT !== jdgm.CDN_HOST) { var f = e.replace(jdgm.CDN_HOST, jdgm.CDN_HOST_ALT); jdgm.loadJS(f, d) } }, t.send()
        }, jdgm.docReady((function () {
          (window.jdgmLoadCSS || e.querySelectorAll(
            ".jdgm-widget, .jdgm-all-reviews-page").length > 0) && (jdgmSettings.widget_load_with_code_splitting ?
              parseFloat(jdgmSettings.widget_version) >= 3 ? jdgm.loadCSS(jdgm.CDN_HOST + "widget_v3/base.css") :
                jdgm.loadCSS(jdgm.CDN_HOST + "widget/base.css") : jdgm.loadCSS(jdgm.CDN_HOST + "shopify_v2.css"),
              jdgm.loadJS(jdgm.CDN_HOST + "loa" + "der.js"))
        }))
    }(document);
  </script>
  <noscript>
    <link rel="stylesheet" type="text/css" media="all" href="https://cdnwidget.judge.me/shopify_v2.css">
  </noscript>

  <!-- BEGIN app snippet: theme_fix_tags -->
  <script>
    (function () {
      var jdgmThemeFixes = null;
      if (!jdgmThemeFixes) return;
      var thisThemeFix = jdgmThemeFixes[Shopify.theme.id];
      if (!thisThemeFix) return;

      if (thisThemeFix.html) {
        document.addEventListener("DOMContentLoaded", function () {
          var htmlDiv = document.createElement('div');
          htmlDiv.classList.add('jdgm-theme-fix-html');
          htmlDiv.innerHTML = thisThemeFix.html;
          document.body.append(htmlDiv);
        });
      };

      if (thisThemeFix.css) {
        var styleTag = document.createElement('style');
        styleTag.classList.add('jdgm-theme-fix-style');
        styleTag.innerHTML = thisThemeFix.css;
        document.head.append(styleTag);
      };

      if (thisThemeFix.js) {
        var scriptTag = document.createElement('script');
        scriptTag.classList.add('jdgm-theme-fix-script');
        scriptTag.innerHTML = thisThemeFix.js;
        document.head.append(scriptTag);
      };
    })();
  </script>
  <!-- END app snippet -->
  <!-- End of Judge.me Core -->



  <!-- END app block -->
  <script src="cdn.shopify.com/extensions/019b6f19-d7c7-7ca1-89ad-a74ff61adfb5/judgeme-extensions-278/assets/loader.js"
    type="text/javascript" defer="defer"></script>
  <link href="https://monorail-edge.shopifysvc.com" rel="dns-prefetch">
  <script>(function () { if ("sendBeacon" in navigator && "performance" in window) { try { var session_token_from_headers = performance.getEntriesByType('navigation')[0].serverTiming.find(x => x.name == '_s').description; } catch { var session_token_from_headers = undefined; } var session_cookie_matches = document.cookie.match(/_shopify_s=([^;]*)/); var session_token_from_cookie = session_cookie_matches && session_cookie_matches.length === 2 ? session_cookie_matches[1] : ""; var session_token = session_token_from_headers || session_token_from_cookie || ""; function handle_abandonment_event(e) { var entries = performance.getEntries().filter(function (entry) { return /monorail-edge.shopifysvc.com/.test(entry.name); }); if (!window.abandonment_tracked && entries.length === 0) { window.abandonment_tracked = true; var currentMs = Date.now(); var navigation_start = performance.timing.navigationStart; var payload = { shop_id: 63657836700, url: window.location.href, navigation_start, duration: currentMs - navigation_start, session_token, page_type: "index" }; window.navigator.sendBeacon("https://monorail-edge.shopifysvc.com/v1/produce", JSON.stringify({ schema_id: "online_store_buyer_site_abandonment/1.1", payload: payload, metadata: { event_created_at_ms: currentMs, event_sent_at_ms: currentMs } })); } } window.addEventListener('pagehide', handle_abandonment_event); } }());</script>
  <script
    id="web-pixels-manager-setup">(function e(e, d, r, n, o) { if (void 0 === o && (o = {}), !Boolean(null === (a = null === (i = window.Shopify) || void 0 === i ? void 0 : i.analytics) || void 0 === a ? void 0 : a.replayQueue)) { var i, a; window.Shopify = window.Shopify || {}; var t = window.Shopify; t.analytics = t.analytics || {}; var s = t.analytics; s.replayQueue = [], s.publish = function (e, d, r) { return s.replayQueue.push([e, d, r]), !0 }; try { self.performance.mark("wpm:start") } catch (e) { } var l = function () { var e = { modern: /Edge?\/(1{2}[4-9]|1[2-9]\d|[2-9]\d{2}|\d{4,})\.\d+(\.\d+|)|Firefox\/(1{2}[4-9]|1[2-9]\d|[2-9]\d{2}|\d{4,})\.\d+(\.\d+|)|Chrom(ium|e)\/(9{2}|\d{3,})\.\d+(\.\d+|)|(Maci|X1{2}).+ Version\/(15\.\d+|(1[6-9]|[2-9]\d|\d{3,})\.\d+)([,.]\d+|)( \(\w+\)|)( Mobile\/\w+|) Safari\/|Chrome.+OPR\/(9{2}|\d{3,})\.\d+\.\d+|(CPU[ +]OS|iPhone[ +]OS|CPU[ +]iPhone|CPU IPhone OS|CPU iPad OS)[ +]+(15[._]\d+|(1[6-9]|[2-9]\d|\d{3,})[._]\d+)([._]\d+|)|Android:?[ /-](13[3-9]|1[4-9]\d|[2-9]\d{2}|\d{4,})(\.\d+|)(\.\d+|)|Android.+Firefox\/(13[5-9]|1[4-9]\d|[2-9]\d{2}|\d{4,})\.\d+(\.\d+|)|Android.+Chrom(ium|e)\/(13[3-9]|1[4-9]\d|[2-9]\d{2}|\d{4,})\.\d+(\.\d+|)|SamsungBrowser\/([2-9]\d|\d{3,})\.\d+/, legacy: /Edge?\/(1[6-9]|[2-9]\d|\d{3,})\.\d+(\.\d+|)|Firefox\/(5[4-9]|[6-9]\d|\d{3,})\.\d+(\.\d+|)|Chrom(ium|e)\/(5[1-9]|[6-9]\d|\d{3,})\.\d+(\.\d+|)([\d.]+$|.*Safari\/(?![\d.]+ Edge\/[\d.]+$))|(Maci|X1{2}).+ Version\/(10\.\d+|(1[1-9]|[2-9]\d|\d{3,})\.\d+)([,.]\d+|)( \(\w+\)|)( Mobile\/\w+|) Safari\/|Chrome.+OPR\/(3[89]|[4-9]\d|\d{3,})\.\d+\.\d+|(CPU[ +]OS|iPhone[ +]OS|CPU[ +]iPhone|CPU IPhone OS|CPU iPad OS)[ +]+(10[._]\d+|(1[1-9]|[2-9]\d|\d{3,})[._]\d+)([._]\d+|)|Android:?[ /-](13[3-9]|1[4-9]\d|[2-9]\d{2}|\d{4,})(\.\d+|)(\.\d+|)|Mobile Safari.+OPR\/([89]\d|\d{3,})\.\d+\.\d+|Android.+Firefox\/(13[5-9]|1[4-9]\d|[2-9]\d{2}|\d{4,})\.\d+(\.\d+|)|Android.+Chrom(ium|e)\/(13[3-9]|1[4-9]\d|[2-9]\d{2}|\d{4,})\.\d+(\.\d+|)|Android.+(UC? ?Browser|UCWEB|U3)[ /]?(15\.([5-9]|\d{2,})|(1[6-9]|[2-9]\d|\d{3,})\.\d+)\.\d+|SamsungBrowser\/(5\.\d+|([6-9]|\d{2,})\.\d+)|Android.+MQ{2}Browser\/(14(\.(9|\d{2,})|)|(1[5-9]|[2-9]\d|\d{3,})(\.\d+|))(\.\d+|)|K[Aa][Ii]OS\/(3\.\d+|([4-9]|\d{2,})\.\d+)(\.\d+|)/ }, d = e.modern, r = e.legacy, n = navigator.userAgent; return n.match(d) ? "modern" : n.match(r) ? "legacy" : "unknown" }(), u = "modern" === l ? "modern" : "legacy", c = (null != n ? n : { modern: "", legacy: "" })[u], f = function (e) { return [e.baseUrl, "/wpm", "/b", e.hashVersion, "modern" === e.buildTarget ? "m" : "l", ".js"].join("") }({ baseUrl: d, hashVersion: r, buildTarget: u }), m = function (e) { var d = e.version, r = e.bundleTarget, n = e.surface, o = e.pageUrl, i = e.monorailEndpoint; return { emit: function (e) { var a = e.status, t = e.errorMsg, s = (new Date).getTime(), l = JSON.stringify({ metadata: { event_sent_at_ms: s }, events: [{ schema_id: "web_pixels_manager_load/3.1", payload: { version: d, bundle_target: r, page_url: o, status: a, surface: n, error_msg: t }, metadata: { event_created_at_ms: s } }] }); if (!i) return console && console.warn && console.warn("[Web Pixels Manager] No Monorail endpoint provided, skipping logging."), !1; try { return self.navigator.sendBeacon.bind(self.navigator)(i, l) } catch (e) { } var u = new XMLHttpRequest; try { return u.open("POST", i, !0), u.setRequestHeader("Content-Type", "text/plain"), u.send(l), !0 } catch (e) { return console && console.warn && console.warn("[Web Pixels Manager] Got an unhandled error while logging to Monorail."), !1 } } } }({ version: r, bundleTarget: l, surface: e.surface, pageUrl: self.location.href, monorailEndpoint: e.monorailEndpoint }); try { o.browserTarget = l, function (e) { var d = e.src, r = e.async, n = void 0 === r || r, o = e.onload, i = e.onerror, a = e.sri, t = e.scriptDataAttributes, s = void 0 === t ? {} : t, l = document.createElement("script"), u = document.querySelector("head"), c = document.querySelector("body"); if (l.async = n, l.src = d, a && (l.integrity = a, l.crossOrigin = "anonymous"), s) for (var f in s) if (Object.prototype.hasOwnProperty.call(s, f)) try { l.dataset[f] = s[f] } catch (e) { } if (o && l.addEventListener("load", o), i && l.addEventListener("error", i), u) u.appendChild(l); else { if (!c) throw new Error("Did not find a head or body element to append the script"); c.appendChild(l) } }({ src: f, async: !0, onload: function () { if (!function () { var e, d; return Boolean(null === (d = null === (e = window.Shopify) || void 0 === e ? void 0 : e.analytics) || void 0 === d ? void 0 : d.initialized) }()) { var d = window.webPixelsManager.init(e) || void 0; if (d) { var r = window.Shopify.analytics; r.replayQueue.forEach((function (e) { var r = e[0], n = e[1], o = e[2]; d.publishCustomEvent(r, n, o) })), r.replayQueue = [], r.publish = d.publishCustomEvent, r.visitor = d.visitor, r.initialized = !0 } } }, onerror: function () { return m.emit({ status: "failed", errorMsg: "".concat(f, " has failed to load") }) }, sri: function (e) { var d = /^sha384-[A-Za-z0-9+/=]+$/; return "string" == typeof e && d.test(e) }(c) ? c : "", scriptDataAttributes: o }), m.emit({ status: "loading" }) } catch (e) { m.emit({ status: "failed", errorMsg: (null == e ? void 0 : e.message) || "Unknown error" }) } } })({ shopId: 63657836700, storefrontBaseUrl: "https://maharajasupermarket.ro", extensionsBaseUrl: "https://extensions.shopifycdn.com/cdn/shopifycloud/web-pixels-manager", monorailEndpoint: "https://monorail-edge.shopifysvc.com/unstable/produce_batch", surface: "storefront-renderer", enabledBetaFlags: ["2dca8a86", "a0d5f9d2"], webPixelsConfigList: [{ "id": "1055391900", "configuration": "{\"webPixelName\":\"Judge.me\"}", "eventPayloadVersion": "v1", "runtimeContext": "STRICT", "scriptVersion": "34ad157958823915625854214640f0bf", "type": "APP", "apiClientId": 683015, "privacyPurposes": ["ANALYTICS"], "dataSharingAdjustments": { "protectedCustomerApprovalScopes": ["read_customer_email", "read_customer_name", "read_customer_personal_data", "read_customer_phone"] } }, { "id": "617119900", "configuration": "{\"pixel_id\":\"422866954167895\",\"pixel_type\":\"facebook_pixel\"}", "eventPayloadVersion": "v1", "runtimeContext": "OPEN", "scriptVersion": "ca16bc87fe92b6042fbaa3acc2fbdaa6", "type": "APP", "apiClientId": 2329312, "privacyPurposes": ["ANALYTICS", "MARKETING", "SALE_OF_DATA"], "dataSharingAdjustments": { "protectedCustomerApprovalScopes": ["read_customer_address", "read_customer_email", "read_customer_name", "read_customer_personal_data", "read_customer_phone"] } }, { "id": "564789404", "configuration": "{\"config\":\"{\\\"google_tag_ids\\\":[\\\"G-QT89TM8J0K\\\",\\\"GT-K8GX9H7D\\\"],\\\"target_country\\\":\\\"ZZ\\\",\\\"gtag_events\\\":[{\\\"type\\\":\\\"search\\\",\\\"action_label\\\":\\\"G-QT89TM8J0K\\\"},{\\\"type\\\":\\\"begin_checkout\\\",\\\"action_label\\\":\\\"G-QT89TM8J0K\\\"},{\\\"type\\\":\\\"view_item\\\",\\\"action_label\\\":[\\\"G-QT89TM8J0K\\\",\\\"MC-0622R69ZJ6\\\"]},{\\\"type\\\":\\\"purchase\\\",\\\"action_label\\\":[\\\"G-QT89TM8J0K\\\",\\\"MC-0622R69ZJ6\\\",\\\"AW-10814656859\\\/AxWjCIurn_sDENui6qQo\\\"]},{\\\"type\\\":\\\"page_view\\\",\\\"action_label\\\":[\\\"G-QT89TM8J0K\\\",\\\"MC-0622R69ZJ6\\\"]},{\\\"type\\\":\\\"add_payment_info\\\",\\\"action_label\\\":\\\"G-QT89TM8J0K\\\"},{\\\"type\\\":\\\"add_to_cart\\\",\\\"action_label\\\":\\\"G-QT89TM8J0K\\\"}],\\\"enable_monitoring_mode\\\":false}\"}", "eventPayloadVersion": "v1", "runtimeContext": "OPEN", "scriptVersion": "b2a88bafab3e21179ed38636efcd8a93", "type": "APP", "apiClientId": 1780363, "privacyPurposes": [], "dataSharingAdjustments": { "protectedCustomerApprovalScopes": ["read_customer_address", "read_customer_email", "read_customer_name", "read_customer_personal_data", "read_customer_phone"] } }, { "id": "shopify-app-pixel", "configuration": "{}", "eventPayloadVersion": "v1", "runtimeContext": "STRICT", "scriptVersion": "0450", "apiClientId": "shopify-pixel", "type": "APP", "privacyPurposes": ["ANALYTICS", "MARKETING"] }, { "id": "shopify-custom-pixel", "eventPayloadVersion": "v1", "runtimeContext": "LAX", "scriptVersion": "0450", "apiClientId": "shopify-pixel", "type": "CUSTOM", "privacyPurposes": ["ANALYTICS", "MARKETING"] }], isMerchantRequest: false, initData: { "shop": { "name": "Maharaja Supermarket", "paymentSettings": { "currencyCode": "RON" }, "myshopifyDomain": "new-Maharaja Supermarket.myshopify.com", "countryCode": "PL", "storefrontUrl": "https:\/\/maharajasupermarket.ro" }, "customer": null, "cart": null, "checkout": null, "productVariants": [], "purchasingCompany": null }, }, "https://maharajasupermarket.ro/cdn", "da62cc92w68dfea28pcf9825a4m392e00d0", { "modern": "", "legacy": "" }, { "shopId": "63657836700", "storefrontBaseUrl": "https:\/\/maharajasupermarket.ro", "extensionBaseUrl": "https:\/\/extensions.shopifycdn.com\/cdn\/shopifycloud\/web-pixels-manager", "surface": "storefront-renderer", "enabledBetaFlags": "[\"2dca8a86\", \"a0d5f9d2\"]", "isMerchantRequest": "false", "hashVersion": "da62cc92w68dfea28pcf9825a4m392e00d0", "publish": "custom", "events": "[[\"page_viewed\",{}]]" });</script>
  <script async="" src="https://maharajasupermarket.ro/cdn/wpm/bda62cc92w68dfea28pcf9825a4m392e00d0m.js"
    data-shop-id="63657836700" data-storefront-base-url="https://maharajasupermarket.ro"
    data-extension-base-url="https://extensions.shopifycdn.com/cdn/shopifycloud/web-pixels-manager"
    data-surface="storefront-renderer" data-enabled-beta-flags="[" 2dca8a86",="" "a0d5f9d2" ]"=""
    data-is-merchant-request="false" data-hash-version="da62cc92w68dfea28pcf9825a4m392e00d0" data-publish="custom"
    data-events="[[" page_viewed",{}]]"="" data-browser-target="modern"></script>
  <script>
    window.ShopifyAnalytics = window.ShopifyAnalytics || {};
    window.ShopifyAnalytics.meta = window.ShopifyAnalytics.meta || {};
    window.ShopifyAnalytics.meta.currency = 'RON';
    var meta = { "page": { "pageType": "home", "requestId": "749581cf-7a87-4855-b171-ef805b7411b4-1767159292" } };
    for (var attr in meta) {
      window.ShopifyAnalytics.meta[attr] = meta[attr];
    }
  </script>
  <script class="analytics">
    (function () {
      var customDocumentWrite = function (content) {
        var jquery = null;

        if (window.jQuery) {
          jquery = window.jQuery;
        } else if (window.Checkout && window.Checkout.$) {
          jquery = window.Checkout.$;
        }

        if (jquery) {
          jquery('body').append(content);
        }
      };

      var hasLoggedConversion = function (token) {
        if (token) {
          return document.cookie.indexOf('loggedConversion=' + token) !== -1;
        }
        return false;
      }

      var setCookieIfConversion = function (token) {
        if (token) {
          var twoMonthsFromNow = new Date(Date.now());
          twoMonthsFromNow.setMonth(twoMonthsFromNow.getMonth() + 2);

          document.cookie = 'loggedConversion=' + token + '; expires=' + twoMonthsFromNow;
        }
      }

      var trekkie = window.ShopifyAnalytics.lib = window.trekkie = window.trekkie || [];
      if (trekkie.integrations) {
        return;
      }
      trekkie.methods = [
        'identify',
        'page',
        'ready',
        'track',
        'trackForm',
        'trackLink'
      ];
      trekkie.factory = function (method) {
        return function () {
          var args = Array.prototype.slice.call(arguments);
          args.unshift(method);
          trekkie.push(args);
          return trekkie;
        };
      };
      for (var i = 0; i < trekkie.methods.length; i++) {
        var key = trekkie.methods[i];
        trekkie[key] = trekkie.factory(key);
      }
      trekkie.load = function (config) {
        trekkie.config = config || {};
        trekkie.config.initialDocumentCookie = document.cookie;
        var first = document.getElementsByTagName('script')[0];
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.onerror = function (e) {
          var scriptFallback = document.createElement('script');
          scriptFallback.type = 'text/javascript';
          scriptFallback.onerror = function (error) {
            var Monorail = {
              produce: function produce(monorailDomain, schemaId, payload) {
                var currentMs = new Date().getTime();
                var event = {
                  schema_id: schemaId,
                  payload: payload,
                  metadata: {
                    event_created_at_ms: currentMs,
                    event_sent_at_ms: currentMs
                  }
                };
                return Monorail.sendRequest("https://" + monorailDomain + "/v1/produce", JSON.stringify(event));
              },
              sendRequest: function sendRequest(endpointUrl, payload) {
                // Try the sendBeacon API
                if (window && window.navigator && typeof window.navigator.sendBeacon === 'function' && typeof window.Blob === 'function' && !Monorail.isIos12()) {
                  var blobData = new window.Blob([payload], {
                    type: 'text/plain'
                  });

                  if (window.navigator.sendBeacon(endpointUrl, blobData)) {
                    return true;
                  } // sendBeacon was not successful

                } // XHR beacon

                var xhr = new XMLHttpRequest();

                try {
                  xhr.open('POST', endpointUrl);
                  xhr.setRequestHeader('Content-Type', 'text/plain');
                  xhr.send(payload);
                } catch (e) {
                  console.log(e);
                }

                return false;
              },
              isIos12: function isIos12() {
                return window.navigator.userAgent.lastIndexOf('iPhone; CPU iPhone OS 12_') !== -1 || window.navigator.userAgent.lastIndexOf('iPad; CPU OS 12_') !== -1;
              }
            };
            Monorail.produce('monorail-edge.shopifysvc.com',
              'trekkie_storefront_load_errors/1.1',
              {
                shop_id: 63657836700,
                theme_id: 141771800732,
                app_name: "storefront",
                context_url: window.location.href,
                source_url: "//maharajasupermarket.ro/cdn/s/trekkie.storefront.8f32c7f0b513e73f3235c26245676203e1209161.min.js"
              });

          };
          scriptFallback.async = true;
          scriptFallback.src = '//maharajasupermarket.ro/cdn/s/trekkie.storefront.8f32c7f0b513e73f3235c26245676203e1209161.min.js';
          first.parentNode.insertBefore(scriptFallback, first);
        };
        script.async = true;
        script.src = '//maharajasupermarket.ro/cdn/s/trekkie.storefront.8f32c7f0b513e73f3235c26245676203e1209161.min.js';
        first.parentNode.insertBefore(script, first);
      };
      trekkie.load(
        { "Trekkie": { "appName": "storefront", "development": false, "defaultAttributes": { "shopId": 63657836700, "isMerchantRequest": null, "themeId": 141771800732, "themeCityHash": "7339702991395869607", "contentLanguage": "en", "currency": "RON", "eventMetadataId": "774c516a-6a9f-40f9-907a-af3bc6f44ea8" }, "isServerSideCookieWritingEnabled": true, "monorailRegion": "shop_domain", "enabledBetaFlags": ["65f19447"] }, "Session Attribution": {}, "S2S": { "facebookCapiEnabled": true, "source": "trekkie-storefront-renderer", "apiClientId": 580111 } }
      );

      var loaded = false;
      trekkie.ready(function () {
        if (loaded) return;
        loaded = true;

        window.ShopifyAnalytics.lib = window.trekkie;

        var originalDocumentWrite = document.write;
        document.write = customDocumentWrite;
        try { window.ShopifyAnalytics.merchantGoogleAnalytics.call(this); } catch (error) { };
        document.write = originalDocumentWrite;

        window.ShopifyAnalytics.lib.page(null, { "pageType": "home", "requestId": "749581cf-7a87-4855-b171-ef805b7411b4-1767159292", "shopifyEmitted": true });

        var match = window.location.pathname.match(/checkouts\/(.+)\/(thank_you|post_purchase)/)
        var token = match ? match[1] : undefined;
        if (!hasLoggedConversion(token)) {
          setCookieIfConversion(token);

        }
      });


      var eventsListenerScript = document.createElement('script');
      eventsListenerScript.async = true;
      eventsListenerScript.src = "//maharajasupermarket.ro/cdn/shopifycloud/storefront/assets/shop_events_listener-3da45d37.js";
      document.getElementsByTagName('head')[0].appendChild(eventsListenerScript);

    })();</script>
  <script async=""
    src="https://maharajasupermarket.ro/cdn/shopifycloud/storefront/assets/shop_events_listener-3da45d37.js"></script>
  <script defer="" src="https://maharajasupermarket.ro/cdn/shopifycloud/perf-kit/shopify-perf-kit-2.1.2.min.js"
    data-application="storefront-renderer" data-shop-id="63657836700" data-render-region="gcp-europe-west1"
    data-page-type="index" data-theme-instance-id="141771800732" data-theme-name="style" data-theme-version="6.2.0"
    data-monorail-region="shop_domain" data-resource-timing-sampling-rate="10" data-shs="true" data-shs-beacon="true"
    data-shs-export-with-fetch="true" data-shs-logs-sample-rate="1"
    data-shs-beacon-endpoint="https://maharajasupermarket.ro/api/collect"></script>
  <script>window.ShopifyAnalytics = window.ShopifyAnalytics || {}; window.ShopifyAnalytics.performance = window.ShopifyAnalytics.performance || {}; (function () { const LONG_FRAME_THRESHOLD = 50; const longAnimationFrames = []; let activeRafId = null; function collectLongFrames() { let previousTime = null; function rafMonitor(now) { if (activeRafId === null) { return; } const delta = now - previousTime; if (delta > LONG_FRAME_THRESHOLD) { longAnimationFrames.push({ startTime: previousTime, endTime: now, }); } previousTime = now; activeRafId = requestAnimationFrame(rafMonitor); } previousTime = performance.now(); activeRafId = requestAnimationFrame(rafMonitor); } if (!PerformanceObserver.supportedEntryTypes.includes('long-animation-frame')) { collectLongFrames(); const timeoutId = setTimeout(() => { cancelAnimationFrame(activeRafId); }, 10_000); window.ShopifyAnalytics.performance.getLongAnimationFrames = function (stopCollection = false) { if (stopCollection) { clearTimeout(timeoutId); cancelAnimationFrame(activeRafId); } return longAnimationFrames; }; } })();</script>
</head>

<body class="index home  ">
  <div class="overlay cart-overlay"></div>
  <style>
    .ttloader {
      background-color: #ffffff;
      height: 100%;
      left: 0;
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 999999;
    }

    .rotating {
      background-image: url("maharajasupermarket.ro/cdn/shopifycloud/storefront/assets/no-image-2048-a2addb12.gif");
    }

    .rotating {
      background-position: center center;
      background-repeat: no-repeat;
      bottom: 0;
      height: auto;
      left: 0;
      margin: auto;
      position: absolute;
      right: 0;
      top: 0;
      width: 100%;
    }
  </style>

  <header id="shopify-section-header" class="shopify-section site-header header-style-one">
    <link rel="stylesheet" href="component-loading-overlay_v=94317942667143404611742289478.css" media="print"
      onload="this.media='all'">
    <link rel="stylesheet" href="component-cart-notification_v=16644045276302194741742289478.css" media="print"
      onload="this.media='all'">
    <noscript>
      <link
        href="//maharajasupermarket.ro/cdn/shop/t/7/assets/component-cart-notification.css?v=16644045276302194741742289478"
        rel="stylesheet" type="text/css" media="all" />
    </noscript>
    <script src="details-disclosure_v=118626640824924522881742289478.js" defer="defer"></script>
    <script src="details-modal_v=159713964493321545491742289478.js" defer="defer"></script>

    <div class="header__announcement-bar" style="display:none;">
        <div class="announcement-bar-mid-col">

          <a class="hot-line-num" href="tel:+40-536 503 097">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" class="icon icon--telephone   
">
              <path
                d="M2.51809 7.96152C1.88607 6.85945 1.58091 5.95957 1.3969 5.04739C1.12475 3.69831 1.74755 2.38046 2.77926 1.53957C3.21531 1.18417 3.71516 1.3056 3.97301 1.76819L4.55513 2.81253C5.01653 3.6403 5.24723 4.05418 5.20147 4.49298C5.15572 4.93178 4.84459 5.28916 4.22232 6.00393L2.51809 7.96152ZM2.51809 7.96152C3.79735 10.1921 5.8049 12.2008 8.03807 13.4815M8.03807 13.4815C9.14014 14.1135 10.04 14.4187 10.9522 14.6027C12.3013 14.8749 13.6191 14.2521 14.46 13.2203C14.8154 12.7843 14.694 12.2845 14.2314 12.0266L13.1871 11.4445C12.3593 10.9831 11.9454 10.7524 11.5066 10.7981C11.0678 10.8439 10.7104 11.155 9.99567 11.7773L8.03807 13.4815Z"
                stroke="#70AB22" stroke-width="1.5" stroke-linejoin="round"></path>
            </svg>


            <span>Contact : +40-536 503 097</span>
          </a>


          <span>|</span>
          <a class="hot-line-num" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 17 16" fill="none">
              <path
                d="M13.4998 11.6667C13.4998 12.5871 12.7536 13.3333 11.8332 13.3333C10.9127 13.3333 10.1665 12.5871 10.1665 11.6667C10.1665 10.7462 10.9127 10 11.8332 10C12.7536 10 13.4998 10.7462 13.4998 11.6667Z"
                stroke="#5B8A1D" stroke-width="1.5"></path>
              <path
                d="M6.83333 11.6667C6.83333 12.5871 6.08714 13.3333 5.16667 13.3333C4.24619 13.3333 3.5 12.5871 3.5 11.6667C3.5 10.7462 4.24619 10 5.16667 10C6.08714 10 6.83333 10.7462 6.83333 11.6667Z"
                stroke="#5B8A1D" stroke-width="1.5"></path>
              <path
                d="M10.1663 11.6667H6.83301M1.83301 2.66675H8.49967C9.44247 2.66675 9.91387 2.66675 10.2068 2.95964C10.4997 3.25253 10.4997 3.72394 10.4997 4.66675V10.3334M10.833 4.33341H12.0339C12.5871 4.33341 12.8636 4.33341 13.0929 4.46321C13.3221 4.59301 13.4644 4.83015 13.7489 5.30442L14.8813 7.19175C15.0229 7.42775 15.0937 7.54581 15.1301 7.67681C15.1663 7.80781 15.1663 7.94542 15.1663 8.22075V10.0001C15.1663 10.6231 15.1663 10.9347 15.0323 11.1667C14.9446 11.3187 14.8183 11.445 14.6663 11.5327C14.4343 11.6667 14.1227 11.6667 13.4997 11.6667M1.83301 8.66675V10.0001C1.83301 10.6231 1.83301 10.9347 1.96698 11.1667C2.05475 11.3187 2.18099 11.445 2.33301 11.5327C2.56506 11.6667 2.87659 11.6667 3.49967 11.6667"
                stroke="#5B8A1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
              <path d="M1.83301 4.66675H5.83301M1.83301 6.66675H4.49967" stroke="#5B8A1D" stroke-width="1.5"
                stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
            <span>Free Delivery from 199 RON</span>
          </a>

        </div>

      </div>
    </div>
    <div class="top-header-wrapper sticky_header" id="header-sticky">
      <div class="container">
        <div class="top-header">
          <div class="logo-col">
            <h1>
              <a href="/">
                <img src="/uploads/maharaja_logo.png" loading="eager" alt="Nav brand">
              </a>
            </h1>
          </div>
          <ul class="header__top-navigation">
            <li><a href="/shop.php?category=promotion">MEGA SALE!</a></li>
            <li><a href="/contact.php">Contact Us</a></li>
            <li><a href="/pages/faq">FAQ</a></li>
            <li><a href="/shop.php?category=shop-all">Shop All</a></li>

          </ul>
          <div class="right-side-header">
            <div class="search-form-wrapper" tabindex="-1"><predictive-search class="search-modal__form"
                data-loading-text="Loading...">
                <form action="/search" method="get" role="search" class="search search-modal__form">
                  <div class="field form-inputs">
                    <input class="search__input field__input form-control" id="Search-In-Modal-1" type="search" name="q"
                      value="" placeholder="Search Product..." role="combobox" aria-expanded="false"
                      aria-owns="predictive-search-results-list" aria-controls="predictive-search-results-list"
                      aria-haspopup="listbox" aria-autocomplete="list" autocorrect="off" autocomplete="off"
                      autocapitalize="off" spellcheck="false">
                    <input type="hidden" name="options[prefix]" value="last">
                    <button type="submit" class="search__button btn" id="btn-submit">

                      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <path d="M11.667 11.6667L14.667 14.6667" stroke="currentColor" stroke-width="1.5"
                          stroke-linecap="round" stroke-linejoin="round"></path>
                        <path
                          d="M13.333 7.33325C13.333 4.01955 10.6467 1.33325 7.33301 1.33325C4.0193 1.33325 1.33301 4.01955 1.33301 7.33325C1.33301 10.647 4.0193 13.3333 7.33301 13.3333C10.6467 13.3333 13.333 10.647 13.333 7.33325Z"
                          stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
                      </svg>

                    </button>
                  </div>

                  <div class="predictive-search predictive-search--header" tabindex="-1" data-predictive-search="">
                    <div class="predictive-search__loading-state">
                      <svg aria-hidden="true" focusable="false" role="presentation" class="spinner" viewBox="0 0 66 66"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle class="path" fill="none" stroke-width="6" cx="33" cy="33" r="30"></circle>
                      </svg>
                    </div>
                  </div>
                  <span class="predictive-search-status hidden" role="status" aria-hidden="true"></span>
                </form>
              </predictive-search></div>


            <div class="header-info-end">
              <ul class="menu-right d-flex align-items-center  justify-content-end">
                <li class="search-header mobile-only">
                  <a href="javascript:void(0)" class="header__icon--summary focus-inset modal__toggle"
                    aria-haspopup="dialog" aria-label="Search" title="search" id="header-search">

                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                      <path d="M11.667 11.6667L14.667 14.6667" stroke="currentColor" stroke-width="1.5"
                        stroke-linecap="round" stroke-linejoin="round"></path>
                      <path
                        d="M13.333 7.33325C13.333 4.01955 10.6467 1.33325 7.33301 1.33325C4.0193 1.33325 1.33301 4.01955 1.33301 7.33325C1.33301 10.647 4.0193 13.3333 7.33301 13.3333C10.6467 13.3333 13.333 10.647 13.333 7.33325Z"
                        stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"></path>
                    </svg>

                  </a>
                </li>

                <li class="lang-switcher-nav ms-2" style="list-style:none;">
                  <?php
                    $cur_lang = $_SESSION['lang'] ?? 'en';
                    $cur_url  = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']==='on' ? 'https' : 'http')
                              . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                  ?>
                  <div style="display:flex;align-items:center;gap:4px;font-size:13px;font-weight:700;">
                    <a href="/lang_switch.php?lang=en&back=<?php echo urlencode($cur_url); ?>"
                       style="padding:4px 9px;border-radius:6px;text-decoration:none;transition:all .2s;
                              <?php echo $cur_lang==='en' ? 'background:#6ea622;color:#fff;' : 'color:#555;'; ?>">EN</a>
                    <span style="color:#ccc;">|</span>
                    <a href="/lang_switch.php?lang=ro&back=<?php echo urlencode($cur_url); ?>"
                       style="padding:4px 9px;border-radius:6px;text-decoration:none;transition:all .2s;
                              <?php echo $cur_lang==='ro' ? 'background:#6ea622;color:#fff;' : 'color:#555;'; ?>">RO</a>
                  </div>
                </li>

                <li class="profile-header ms-3">
                  <div class="header-sign-in-up__group">
                    <?php if (isset($_SESSION['customer_id'])): ?>
                      <div class="dropdown">
                        <a class="dropdown-toggle" id="profileDropdown">
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-user">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                          </svg>
                          <span style="font-weight: 600; font-size: 15px;">Hi, <?php echo htmlspecialchars(explode(' ', $_SESSION['customer_name'] ?? '')[0]); ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                          <li><a class="dropdown-item" href="/account/profile.php">My Profile</a></li>
                          <li><a class="dropdown-item" href="/account/orders.php">My Orders</a></li>
                          <li><hr class="dropdown-divider"></li>
                          <li><a class="dropdown-item" href="/account/logout.php" style="color: #dc3545 !important;">Logout</a></li>
                        </ul>
                      </div>
                    <?php else: ?>
                      <div class="d-flex gap-2">
                        <a href="/account/login.php" class="btn btn--secondary btn--sm">Sign In</a>
                        <a href="/account/register.php" class="btn btn--primary btn--sm">Sign Up</a>
                      </div>
                    <?php endif; ?>
                  </div>
                </li>

                <li class="cart-header">
                  <a class="closecart">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                      <path
                        d="M20 1.17838L18.8216 0L10 8.82162L1.17838 0L0 1.17838L8.82162 10L0 18.8216L1.17838 20L10 11.1784L18.8216 20L20 18.8216L11.1784 10L20 1.17838Z"
                        fill="white"></path>
                    </svg>
                  </a>
                  <div class="main-cart" id="cart-icon-bubble">
                    <a href="javascript:;" class="hcart">

                      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path
                          d="M3.22708 14.1828L2.22412 8.19984C2.07247 7.29523 1.99665 6.84293 2.23945 6.54647C2.48226 6.25 2.92852 6.25 3.82104 6.25H16.1783C17.0708 6.25 17.5171 6.25 17.7599 6.54647C18.0027 6.84293 17.9268 7.29523 17.7753 8.19984L16.7723 14.1828C16.4398 16.1659 16.2736 17.1574 15.5949 17.7454C14.9163 18.3333 13.938 18.3333 11.9815 18.3333H8.01786C6.06131 18.3333 5.08303 18.3333 4.40438 17.7454C3.72573 17.1574 3.55952 16.1659 3.22708 14.1828Z"
                          stroke="currentColor" stroke-width="1.5"></path>
                        <path
                          d="M14.5837 6.25008C14.5837 3.71877 12.5317 1.66675 10.0003 1.66675C7.46902 1.66675 5.41699 3.71877 5.41699 6.25008"
                          stroke="currentColor" stroke-width="1.5"></path>
                      </svg>

                      <span class="count"><?php echo $total_cart_items; ?></span>
                    </a>
                    <webi-cart-items class="cartDrawer <?php echo ($total_cart_items == 0) ? 'is-empty' : ''; ?>">
                      <div class="mini-cart-header">
                        <h4>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20"
                            fill="none">
                            <path
                              d="M3.22708 14.1828L2.22412 8.19984C2.07247 7.29523 1.99665 6.84293 2.23945 6.54647C2.48226 6.25 2.92852 6.25 3.82104 6.25H16.1783C17.0708 6.25 17.5171 6.25 17.7599 6.54647C18.0027 6.84293 17.9268 7.29523 17.7753 8.19984L16.7723 14.1828C16.4398 16.1659 16.2736 17.1574 15.5949 17.7454C14.9163 18.3333 13.938 18.3333 11.9815 18.3333H8.01786C6.06131 18.3333 5.08303 18.3333 4.40438 17.7454C3.72573 17.1574 3.55952 16.1659 3.22708 14.1828Z"
                              stroke="currentColor" stroke-width="1.5"></path>
                            <path
                              d="M14.5837 6.25008C14.5837 3.71877 12.5317 1.66675 10.0003 1.66675C7.46902 1.66675 5.41699 3.71877 5.41699 6.25008"
                              stroke="currentColor" stroke-width="1.5"></path>
                          </svg>
                          <span>My Cart</span>
                        </h4>
                        <div class="cart-tottl-itm"><?php echo $total_cart_items; ?> Items</div>
                      </div>
                      <div class="cart__warnings">
                        <svg id="icon-cart-emty" widht="50" height="50" xmlns="http://www.w3.org/2000/svg"
                          viewBox="0 0 576 512">
                          <path
                            d="M263.4 103.4C269.7 97.18 279.8 97.18 286.1 103.4L320 137.4L353.9 103.4C360.2 97.18 370.3 97.18 376.6 103.4C382.8 109.7 382.8 119.8 376.6 126.1L342.6 160L376.6 193.9C382.8 200.2 382.8 210.3 376.6 216.6C370.3 222.8 360.2 222.8 353.9 216.6L320 182.6L286.1 216.6C279.8 222.8 269.7 222.8 263.4 216.6C257.2 210.3 257.2 200.2 263.4 193.9L297.4 160L263.4 126.1C257.2 119.8 257.2 109.7 263.4 103.4zM80 0C87.47 0 93.95 5.17 95.6 12.45L100 32H541.8C562.1 32 578.3 52.25 572.6 72.66L518.6 264.7C514.7 278.5 502.1 288 487.8 288H158.2L172.8 352H496C504.8 352 512 359.2 512 368C512 376.8 504.8 384 496 384H160C152.5 384 146.1 378.8 144.4 371.5L67.23 32H16C7.164 32 0 24.84 0 16C0 7.164 7.164 0 16 0H80zM107.3 64L150.1 256H487.8L541.8 64H107.3zM128 456C128 425.1 153.1 400 184 400C214.9 400 240 425.1 240 456C240 486.9 214.9 512 184 512C153.1 512 128 486.9 128 456zM184 480C197.3 480 208 469.3 208 456C208 442.7 197.3 432 184 432C170.7 432 160 442.7 160 456C160 469.3 170.7 480 184 480zM512 456C512 486.9 486.9 512 456 512C425.1 512 400 486.9 400 456C400 425.1 425.1 400 456 400C486.9 400 512 425.1 512 456zM456 432C442.7 432 432 442.7 432 456C432 469.3 442.7 480 456 480C469.3 480 480 469.3 480 456C480 442.7 469.3 432 456 432z">
                          </path>
                        </svg>
                        <h5 class="cart__empty-text">Your cart is empty</h5>
                      </div>
                      <div id="cart-body" class="mini-cart-has-item">
                        <form action="checkout.php" class="mini-cart-body" method="post" id="cart">
                          <div id="webi-main-cart-items" data-id="header">
                            <div class="js-contents">
                              <?php if (!empty($header_cart_details)): ?>
                                <ul class="mini-cart-list" style="padding: 0; margin: 0;">
                                    <?php foreach ($header_cart_details as $item): 
                                      $item_title = (isset($_SESSION['lang']) && $_SESSION['lang'] == 'ro') ? $item['title_ro'] : $item['title_en'];
                                      $item_img = !empty($item['image']) ? 'uploads/'.$item['image'] : 'https://placehold.co/50x50';
                                    ?>
                                      <li class="mini-cart-item d-flex align-items-center mb-3" style="gap: 15px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                                        <div class="mini-cart-selection">
                                          <input type="checkbox" name="selected_items[]" value="<?php echo $item['id']; ?>" checked 
                                                 class="mini-cart-item-checkbox" 
                                                 data-price="<?php echo $item['price']; ?>" 
                                                 data-qty="<?php echo $item['qty']; ?>">
                                        </div>
                                        <div class="mini-cart-img" style="width: 60px; height: 60px; flex-shrink: 0;">
                                        <img src="<?php echo htmlspecialchars($item_img); ?>" alt="<?php echo htmlspecialchars($item_title); ?>" style="width: 100%; height: 100%; object-fit: contain;">
                                      </div>
                                      <div class="mini-cart-info" style="flex-grow: 1;">
                                        <h6 style="font-size: 14px; margin: 0; font-weight: 600;"><?php echo htmlspecialchars($item_title); ?></h6>
                                        <div style="font-size: 13px; color: #666;">
                                          <?php echo $item['qty']; ?> x <?php echo format_currency($item['price']); ?>
                                        </div>
                                      </div>
                                    </li>
                                  <?php endforeach; ?>
                                </ul>
                              <?php endif; ?>
                            </div>
                          </div>
                          <p class="hidden" id="webi-cart-live-region-text" aria-live="polite" role="status"></p>
                          <p class="hidden" id="shopping-cart-line-item-status" aria-live="polite" aria-hidden="true"
                            role="status">Loading...</p>
                        </form>
                        <div class="webi-mini-cart-footer <?php echo ($total_cart_items == 0) ? 'is-empty' : ''; ?>" id="webi-main-cart-footer" data-id="header">
                          <div class="cart__blocks">
                            <div class="js-contents">
                              <div class="coupan-txt">
                                <svg version="1.1" id="svg1047" xml:space="preserve" width="682.66669"
                                  height="682.66669" viewBox="0 0 682.66669 682.66669"
                                  xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg">
                                  <defs id="defs1051">
                                    <clipPath clipPathUnits="userSpaceOnUse" id="clipPath1061">
                                      <path d="M 0,512 H 512 V 0 H 0 Z" id="path1059"></path>
                                    </clipPath>
                                  </defs>
                                  <g id="g1053" transform="matrix(1.3333333,0,0,-1.3333333,0,682.66667)">
                                    <g id="g1055">
                                      <g id="g1057" clip-path="url(#clipPath1061)">
                                        <g id="g1063" transform="translate(467,391)">
                                          <path
                                            d="M 0,0 C 16.568,0 30,-13.431 30,-30 V -90 H 15 c -24.853,0 -45,-20.147 -45,-45 0,-24.853 20.147,-45 45,-45 h 15 c 0,0 -33.137,0 0,0 v -60 c 0,-16.568 -13.432,-30 -30,-30 h -422 c -16.568,0 -30,13.432 -30,30 v 60 c 33.137,0 0,0 0,0 h 15 c 24.853,0 45,20.147 45,45 0,24.853 -20.147,45 -45,45 h -15 v 60 c 0,16.569 13.432,30 30,30 z"
                                            style="fill:none;stroke:#000000;stroke-width:30;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                            id="path1065"></path>
                                        </g>
                                        <g id="g1067" transform="translate(286,211)">
                                          <path
                                            d="M 0,0 C 0,-16.569 13.432,-30 30,-30 46.568,-30 60,-16.569 60,0 60,16.569 46.568,30 30,30 13.432,30 0,16.569 0,0 Z"
                                            style="fill:none;stroke:#000000;stroke-width:30;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                            id="path1069"></path>
                                        </g>
                                        <g id="g1071" transform="translate(166,301)">
                                          <path
                                            d="M 0,0 C 0,-16.569 13.432,-30 30,-30 46.568,-30 60,-16.569 60,0 60,16.569 46.568,30 30,30 13.432,30 0,16.569 0,0 Z"
                                            style="fill:none;stroke:#000000;stroke-width:30;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                            id="path1073"></path>
                                        </g>
                                        <g id="g1075" transform="translate(316,331)">
                                          <path d="M 0,0 -120,-150"
                                            style="fill:none;stroke:#000000;stroke-width:30;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:none;stroke-opacity:1"
                                            id="path1077"></path>
                                        </g>
                                      </g>
                                    </g>
                                  </g>

                                </svg>
                                <span>Add discount code</span>
                              </div>
                              <div class="coupan_code">
                                <input type="text" name="discount" placeholder="Promo Code" class="discount_coupan">
                                <div class="apply-coupan-btn">
                                  <a href="/checkout?discount=" class="apply btn btn--primary">Apply</a>
                                </div>
                              </div>
                              <div class="mini-cart-footer-total-row d-flex align-items-center justify-content-between">
                                <div class="mini-total-lbl">Subtotal :</div>
                                <div class="mini-total-price"><span class="money" id="mini-cart-subtotal-val"><?php echo format_currency($header_cart_subtotal); ?></span></div>
                              </div>
                            </div>

                            <div class="cart__ctas mini-cart__ctas">
                              <noscript>
                                <button type="submit" class="cart__update-button button button--secondary"
                                  form="cart">Update</button>
                              </noscript>
                              <button type="submit" id="checkout" class="btn btn--primary btn--arrow" name="checkout" form="cart">
                                Proceed to checkout

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                  fill="none">
                                  <path d="M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                  <path d="M15 17C15 17 20 13.3176 20 12C20 10.6824 15 7 15 7" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>

                              </button>
                              <a href="cart.php" class="btn btn--secondary btn--arrow">
                                View Cart

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                  fill="none">
                                  <path d="M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                  <path d="M15 17C15 17 20 13.3176 20 12C20 10.6824 15 7 15 7" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>

                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    <script>
                    (function() {
                        function updateMiniSubtotal() {
                            const container = document.querySelector('.cartDrawer');
                            if (!container) return;
                            
                            const subtotalVal = container.querySelector('#mini-cart-subtotal-val');
                            if (!subtotalVal) return;

                            const checkboxes = container.querySelectorAll('.mini-cart-item-checkbox');
                            let total = 0;
                            let checkedCount = 0;
                            
                            checkboxes.forEach(cb => {
                                if (cb.checked) {
                                    const price = parseFloat(cb.getAttribute('data-price')) || 0;
                                    const qty = parseInt(cb.getAttribute('data-qty')) || 0;
                                    total += price * qty;
                                    checkedCount++;
                                }
                            });
                            
                            subtotalVal.textContent = total.toFixed(2) + ' RON';
                            
                            const checkoutBtn = document.getElementById('checkout');
                            if (checkoutBtn) {
                                checkoutBtn.disabled = (checkedCount === 0);
                                checkoutBtn.style.opacity = (checkedCount === 0) ? '0.5' : '1';
                                checkoutBtn.style.cursor = (checkedCount === 0) ? 'not-allowed' : 'pointer';
                            }
                        }

                        document.addEventListener('change', function(e) {
                            if (e.target && e.target.classList.contains('mini-cart-item-checkbox')) {
                                updateMiniSubtotal();
                            }
                        });

                        const observer = new MutationObserver(function(mutations) {
                            observer.disconnect();
                            updateMiniSubtotal();
                            const cartBody = document.querySelector('.cartDrawer');
                            if (cartBody) {
                                observer.observe(cartBody, { childList: true, subtree: true });
                            }
                        });
                        
                        document.addEventListener('DOMContentLoaded', function() {
                            const cartBody = document.querySelector('.cartDrawer');
                            if (cartBody) {
                                observer.observe(cartBody, { childList: true, subtree: true });
                            }
                            updateMiniSubtotal();
                        });

                        document.addEventListener('click', function(e) {
                            if (e.target && e.target.id === 'checkout' || e.target.closest('#checkout')) {
                                const btn = e.target.id === 'checkout' ? e.target : e.target.closest('#checkout');
                                if (btn.tagName === 'BUTTON' && !btn.disabled) {
                                    const form = document.getElementById('cart');
                                    if (form) {
                                        e.preventDefault();
                                        form.submit();
                                    }
                                }
                            }
                        });
                    })();
                    </script>
                    </webi-cart-items>
                  </div>
                </li>
                <div class="mobile-menu">
                  <button class="mobile-menu-button" id="menu">
                    <div class="one"></div>
                    <div class="two"></div>
                    <div class="three"></div>
                  </button>
                </div>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="main-navigationbar">
      <div class="container">
        <div class="navigationbar-row d-flex align-items-center justify-content-between">
          <div class="menu-items-col">
            <ul class="main-nav">







              <li class="menu-lnk has-item">
                <a class=" category-btn active" href=" javascript:; ">

                  All Categories
                </a>


                <div class="mega-menu menu-dropdown">
                  <div class="mega-menu-container container">
                    <ul class="row" id="menu_d1b60774-590f-40e0-8860-e29584aed4ee">



                      <li class="col-md-3 col-12">
                        <ul class="megamenu-list arrow-list" id="menu_d1b60774-590f-40e0-8860-e29584aed4ee-1">
                          <li class="list-title"><span>Kitchen Staples</span></li>

                          <li>

                            <a href="shop.php?category=Maharaja Supermarket-shop-groceries-atta">Atta (Wheat Flour)</a>
                          </li>

                          <li>

                            <a href="shop.php?category=rice">Rice</a>
                          </li>

                          <li>

                            <a href="shop.php?category=fresh-vegetables">Fresh Vegetables</a>
                          </li>

                          <li>

                            <a href="shop.php?category=Maharaja Supermarket-shop-groceries-spices-and-herbs">Seasonings
                              &
                              Spices</a>
                          </li>

                          <li>

                            <a href="shop.php?category=Maharaja Supermarket-shop-sauces-and-pickles">Indian Pickles </a>
                          </li>

                          <li>

                            <a href="shop.php?category=Maharaja Supermarket-shop-groceries-beans-and-lentils">Dal, Beans
                              and
                              Lentils</a>
                          </li>

                          <li>

                            <a href="shop.php?category=Maharaja Supermarket-shop-groceries-oil">Cooking Oils</a>
                          </li>

                          <li>

                            <a href="shop.php?category=south-indian-breakfast-mixes">Rice Powders</a>
                          </li>

                          <li>

                            <a href="shop.php?category=frozen-food">Frozen Food</a>
                          </li>

                        </ul>
                      </li>



                      <li class="col-md-3 col-12">
                        <ul class="megamenu-list arrow-list" id="menu_d1b60774-590f-40e0-8860-e29584aed4ee-2">
                          <li class="list-title"><span>Snack Foods</span></li>

                          <li>

                            <a href="shop.php?category=default-category-snacks-and-savouries">Snacks and Savouries</a>
                          </li>

                          <li>

                            <a href="shop.php?category=snack-assortment-packs">Snack Assortments</a>
                          </li>

                          <li>

                            <a href="shop.php?category=biscuits-and-cookies">Biscuits and Cookies</a>
                          </li>

                          <li>

                            <a href="shop.php?category=fryums-and-papads">Fryums and Papads</a>
                          </li>

                        </ul>
                      </li>



                      <li class="col-md-3 col-12">
                        <ul class="megamenu-list arrow-list" id="menu_d1b60774-590f-40e0-8860-e29584aed4ee-3">
                          <li class="list-title"><span>Beverages</span></li>

                          <li>

                            <a href="shop.php?category=Maharaja Supermarket-shop-groceries-coffee-and-tea">Coffee and
                              Tea</a>
                          </li>

                          <li>

                            <a href="shop.php?category=Maharaja Supermarket-shop-groceries-juices-and-nectars">Juices
                              and
                              Sharbats</a>
                          </li>

                          <li>

                            <a href="shop.php?category=payasam-kheer-mixes">Payasam/Kheer Mixes</a>
                          </li>

                        </ul>
                      </li>


                    </ul>
                  </div>
                </div>


              </li>







              <li class="menu-lnk">
                <a class="special-link " href="shop.php?category=promotion ">

                  Special Offer
                </a>

              </li>







              <li class="menu-lnk">
                <a class=" " href="shop.php?category=Maharaja Supermarket-shop-new-products ">

                  New Arrivals
                </a>

              </li>







              <li class="menu-lnk has-item">
                <a class=" " href=" javascript:; ">

                  Popular Brands
                </a>


                <div class="menu-dropdown">
                  <ul id="menu_link_linklist_WwNDaC">


                    <li class="">
                      <a
                        href="shop.php?q=Double+Horse">Double
                        Horse</a>

                    </li>


                    <li class="">
                      <a
                        href="shop.php?q=Sweekar">Sweekar</a>

                    </li>


                    <li class="">
                      <a
                        href="shop.php?q=Kitchen+Treasures">Kitchen
                        Treasures</a>

                    </li>


                    <li class="">
                      <a
                        href="shop.php?q=Patanjali">Patanjali</a>

                    </li>


                    <li class="">
                      <a
                        href="shop.php?q=Organic+India">Organic
                        India</a>

                    </li>


                    <li class="">
                      <a href="shop.php?category=bikano">Bikano</a>

                    </li>


                    <li class="">
                      <a
                        href="shop.php?q=JFK">JFK
                        Indian Coffee</a>

                    </li>


                    <li class="">
                      <a href="shop.php?category=amul">Amul</a>

                    </li>


                    <li class="">
                      <a href="shop.php?category=aachi">Aachi</a>

                    </li>


                    <li class="">
                      <a href="shop.php?category=aashirvaad">Aashirvaad</a>

                    </li>


                    <li class="">
                      <a href="shop.php?category=everest">Everest</a>

                    </li>


                    <li class="">
                      <a href="shop.php?category=haldirams">Haldiram's</a>

                    </li>


                    <li class="">
                      <a href="shop.php?category=daawat">Daawat</a>

                    </li>


                    <li class="">
                      <a href="shop.php?category=trs">TRS</a>

                    </li>


                    <li class="">
                      <a href="shop.php?category=shan">Shan</a>

                    </li>


                    <li class="">
                      <a href="shop.php?category=wagh-bakri">Wagh Bakri</a>

                    </li>

                  </ul>
                </div>



              </li>







              <li class="menu-lnk">
                <a class=" " href="shop.php?category=cosmetics ">

                  Health & Beauty
                </a>

              </li>







              <li class="menu-lnk">
                <a class=" " href="shop.php?category=Maharaja Supermarket-shop-dietary-supplements ">

                  Patanjali Supplements
                </a>

              </li>







              <li class="menu-lnk">
                <a class=" " href="shop.php?category=kitchen-appliances ">

                  Kitchen Appliances
                </a>

              </li>






























































            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="search-popup" role="dialog" aria-modal="true" aria-label="Search">
      <button type="button" class="close-search">
        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50" fill="none">
          <path
            d="M27.7618 25.0008L49.4275 3.33503C50.1903 2.57224 50.1903 1.33552 49.4275 0.572826C48.6647 -0.189868 47.428 -0.189965 46.6653 0.572826L24.9995 22.2386L3.33381 0.572826C2.57102 -0.189965 1.3343 -0.189965 0.571605 0.572826C-0.191089 1.33562 -0.191186 2.57233 0.571605 3.33503L22.2373 25.0007L0.571605 46.6665C-0.191186 47.4293 -0.191186 48.666 0.571605 49.4287C0.952952 49.81 1.45285 50.0007 1.95275 50.0007C2.45266 50.0007 2.95246 49.81 3.3339 49.4287L24.9995 27.763L46.6652 49.4287C47.0465 49.81 47.5464 50.0007 48.0463 50.0007C48.5462 50.0007 49.046 49.81 49.4275 49.4287C50.1903 48.6659 50.1903 47.4292 49.4275 46.6665L27.7618 25.0008Z"
            fill="white"></path>
        </svg>
      </button>
      <div class="search-form-wrapper" tabindex="-1"><predictive-search class="search-modal__form"
          data-loading-text="Loading...">
          <form action="/search" method="get" role="search" class="search search-modal__form">
            <div class="field form-inputs">
              <input class="search__input field__input form-control" id="Search-In-Modal-1" type="search" name="q"
                value="" placeholder="Search Product..." role="combobox" aria-expanded="false"
                aria-owns="predictive-search-results-list" aria-controls="predictive-search-results-list"
                aria-haspopup="listbox" aria-autocomplete="list" autocorrect="off" autocomplete="off"
                autocapitalize="off" spellcheck="false">
              <input type="hidden" name="options[prefix]" value="last">
              <button class="btn" aria-label="Search" id="btn-submit">
                <svg>
                  <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M0.000169754 6.99457C0.000169754 10.8576 3.13174 13.9891 6.99473 13.9891C8.60967 13.9891 10.0968 13.4418 11.2807 12.5226C11.3253 12.6169 11.3866 12.7053 11.4646 12.7834L17.0603 18.379C17.4245 18.7432 18.015 18.7432 18.3792 18.379C18.7434 18.0148 18.7434 17.4243 18.3792 17.0601L12.7835 11.4645C12.7055 11.3864 12.6171 11.3251 12.5228 11.2805C13.442 10.0966 13.9893 8.60951 13.9893 6.99457C13.9893 3.13157 10.8577 0 6.99473 0C3.13174 0 0.000169754 3.13157 0.000169754 6.99457ZM1.86539 6.99457C1.86539 4.1617 4.16187 1.86522 6.99473 1.86522C9.8276 1.86522 12.1241 4.1617 12.1241 6.99457C12.1241 9.82743 9.8276 12.1239 6.99473 12.1239C4.16187 12.1239 1.86539 9.82743 1.86539 6.99457Z">
                  </path>
                </svg>
              </button>
              <div class="form-select">
                <select name="collection" id="collection-option" data-option="collection-option"
                  class="single-option-selector nice-select">
                  <option value="all">All Collections</option>

                  <option value="/collections/aachi" data-product-types="
                                            
                                            
                                            
                                            Spice Mixes OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Aachi</option>

                  <option value="/collections/aashirvaad" data-product-types="
                                            
                                            
                                            
                                            Atta (Wheat Flour) OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Aashirvaad</option>

                  <option value="/collections/shop-all" data-product-types="
                                            
                                            
                                            
                                            Spice Mixes OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Atta (Wheat Flour) OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Indian Pickles (Achaar) OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            Basmati Rice OR
                                            
                                            
                                            
                                            
                                            
                                            
                                             OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Whole Spices OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Frozen OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Sri Lankan Spices OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Fryums and Papads OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Szafran OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Biscuits and Cookies OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            Leaf Tea OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    All Products</option>

                  <option value="/collections/amul" data-product-types="
                                            
                                            
                                            
                                             OR
                                            
                                            
                                            
                                            ">
                    Amul</option>

                  <option value="/collections/annam" data-product-types="
                                            
                                            
                                            
                                            Whole Spices OR
                                            
                                            
                                            
                                            
                                            
                                            
                                             OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Frozen OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Fryums and Papads OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Sri Lankan Spices OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Annam</option>

                  <option value="/collections/Maharaja Supermarket-shop-groceries-atta" data-product-types="
                                            
                                            
                                            
                                            Atta (Wheat Flour) OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Instant Noodles OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Atta</option>

                  <option value="/collections/best-sellers" data-product-types="
                                            
                                            
                                            
                                             OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            Soya OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            Puffed Rice OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Best Sellers</option>

                  <option value="/collections/bikano" data-product-types="
                                            
                                            
                                            
                                             OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Bikano</option>

                  <option value="/collections/Maharaja Supermarket-shop-snacks-and-savouries-bikano-maida-snacks"
                    data-product-types="
                                            ">
                    Bikano Maida Snacks</option>

                  <option value="/collections/Maharaja Supermarket-shop-snacks-and-savouries-bikano-namkeens"
                    data-product-types="
                                            ">
                    Bikano Namkeens</option>

                  <option value="/collections/biscuits-and-cookies" data-product-types="
                                            
                                            
                                            
                                            Biscuits and Cookies OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Biscuits and Cookies</option>

                  <option value="/collections/chings-secret" data-product-types="
                                            
                                            
                                            
                                             OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Ching's Secret</option>

                  <option value="/collections/Maharaja Supermarket-shop-groceries-coffee-and-tea" data-product-types="
                                            
                                            
                                            
                                             OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            Leaf Tea OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Coffee and Tea</option>

                  <option value="/collections/Maharaja Supermarket-shop-groceries-oil" data-product-types="
                                            ">
                    Cooking Oils</option>

                  <option value="/collections/cosmetics" data-product-types="
                                            
                                            
                                            
                                             OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Cosmetics</option>

                  <option value="/collections/daawat" data-product-types="
                                            
                                            
                                            
                                            Basmati Rice OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Daawat</option>

                  <option value="/collections/Maharaja Supermarket-shop-groceries-dairy-products" data-product-types="
                                            
                                            
                                            
                                             OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Dairy Products</option>

                  <option value="/collections/Maharaja Supermarket-shop-groceries-beans-and-lentils" data-product-types="
                                            
                                            
                                            
                                             OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Dal, Beans and Lentils</option>

                  <option value="/collections/desi-ghee" data-product-types="
                                            
                                            
                                            
                                             OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Desi Ghee</option>

                  <option value="/collections/Maharaja Supermarket-shop-dietary-supplements" data-product-types="
                                            ">
                    Dietary supplements</option>

                  <option value="/collections/double-horse" data-product-types="
                                            
                                            
                                            
                                             OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Indian Biryani Mix OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Indian Pickles (Achaar) OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Semiya OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Spice Powders OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Double Horse</option>

                  <option value="/collections/Maharaja Supermarket-shop-drinks-and-beverages" data-product-types="
                                            ">
                    Drinks and Beverages</option>

                  <option value="/collections/everest" data-product-types="
                                            
                                            
                                            
                                            Chilli Powders OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                             OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Spice Mixes OR
                                            
                                            
                                            
                                            ">
                    Everest</option>

                  <option value="/collections/featured" data-product-types="
                                            
                                            
                                            
                                            Ready-to-Eat Mix OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            Instant Noodles OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            Corn Chips OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Biscuits and Cookies OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Spice Mixes OR
                                            
                                            
                                            
                                            
                                            
                                            
                                             OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Indian Biryani Mix OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Tapioca Pearls OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            Soya OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Cold Lime Juice OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Sri Lankan Spices OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Puffed Rice OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Whole Spices OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Mango Juice OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Fryums and Papads OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Semiya OR
                                            
                                            
                                            
                                            ">
                    Featured</option>

                  <option value="/collections/fresh-vegetables" data-product-types="
                                            
                                            
                                            
                                             OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Fresh Vegetables</option>

                  <option value="/collections/frozen-food" data-product-types="
                                            
                                            
                                            
                                            Frozen OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            Frozen Foods OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Frozen Food</option>

                  <option value="/collections/fryums-and-papads" data-product-types="
                                            
                                            
                                            
                                            Fryums and Papads OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Fryums and Papads</option>

                  <option value="/collections/Maharaja Supermarket-shop-groceries-groats-and-flour" data-product-types="
                                            
                                            
                                            
                                            Atta (Wheat Flour) OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Groats and Flour</option>

                  <option value="/collections/Maharaja Supermarket-shop-groceries" data-product-types="
                                            
                                            
                                            
                                             OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Groceries</option>

                  <option value="/collections/haldirams" data-product-types="
                                            
                                            
                                            
                                            Frozen Foods OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            Indian Sweets OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Haldiram's</option>

                  <option value="/collections/Maharaja Supermarket-shop-incense-sticks" data-product-types="
                                            ">
                    Incense Sticks</option>

                  <option value="/collections/Maharaja Supermarket-shop-sauces-and-pickles" data-product-types="
                                            
                                            
                                            
                                            Indian Pickles (Achaar) OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Indian Pickles</option>

                  <option value="/collections/Maharaja Supermarket-shop-instant-mix" data-product-types="
                                            ">
                    Instant Mix</option>

                  <option value="/collections/jfk-coffee" data-product-types="
                                            ">
                    JFK Coffee</option>

                  <option value="/collections/Maharaja Supermarket-shop-groceries-juices-and-nectars"
                    data-product-types="
                                            ">
                    Juices and Nectars</option>

                  <option value="/collections/kitchen-appliances" data-product-types="
                                            
                                            
                                            
                                             OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Kitchen Appliances</option>

                  <option value="/collections/mdh" data-product-types="
                                            
                                            
                                            
                                            Dried Seasoning OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            Spice Mixes OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Indian Biryani Mix OR
                                            
                                            
                                            
                                            ">
                    MDH</option>

                  <option value="/collections/mothers" data-product-types="
                                            
                                            
                                            
                                            Indian Pickles (Achaar) OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Mother's</option>

                  <option value="/collections/Maharaja Supermarket-shop-new-products" data-product-types="
                                            
                                            
                                            
                                            Frozen Foods OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Spice Mixes OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            Indian Pickles (Achaar) OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Szafran OR
                                            
                                            
                                            
                                            
                                            
                                            
                                             OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Whole Spices OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Instant Noodles OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Corn Chips OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Basmati Rice OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Semiya OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Fryums and Papads OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    New Products</option>

                  <option value="/collections/olive-and-vinegar" data-product-types="
                                            ">
                    Olive and Vinegar</option>

                  <option value="/collections/pataks" data-product-types="
                                            
                                            
                                            
                                            Indian Curry Paste OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Patak's</option>

                  <option value="/collections/patanjali" data-product-types="
                                            ">
                    Patanjali</option>

                  <option value="/collections/payasam-kheer-mixes" data-product-types="
                                            
                                            
                                            
                                             OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Payasam/Kheer Mixes</option>

                  <option value="/collections/promotion" data-product-types="
                                            
                                            
                                            
                                             OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Puffed Rice OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            Tapioca Pearls OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Soya OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Semiya OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Promotion</option>

                  <option value="/collections/religious-items" data-product-types="
                                            
                                            
                                            
                                             OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Religious Items</option>

                  <option value="/collections/rice" data-product-types="
                                            
                                            
                                            
                                            Basmati Rice OR
                                            
                                            
                                            
                                            
                                            
                                            
                                             OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Rice</option>

                  <option value="/collections/Maharaja Supermarket-shop-groceries-spices-and-herbs" data-product-types="
                                            
                                            
                                            
                                            Spice Mixes OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Indian Biryani Mix OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                             OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            Sri Lankan Spices OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Whole Spices OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Chilli Powders OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Spice Powders OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Dried Seasoning OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Szafran OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Seasonings & Spices</option>

                  <option value="/collections/shan" data-product-types="
                                            
                                            
                                            
                                            Spice Mixes OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Indian Pickles (Achaar) OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Indian Biryani Mix OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Shan</option>

                  <option value="/collections/snack-assortment-packs" data-product-types="
                                            ">
                    Snack Assortment Packs</option>

                  <option value="/collections/default-category-snacks-and-savouries" data-product-types="
                                            
                                            
                                            
                                            Ready-to-Eat Mix OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            Corn Chips OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Biscuits and Cookies OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Snacks and Savouries</option>

                  <option value="/collections/south-indian-breakfast-mixes" data-product-types="
                                            
                                            
                                            
                                            Semiya OR
                                            
                                            
                                            
                                            
                                            
                                            
                                             OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    South Indian Breakfast Mixes</option>

                  <option value="/collections/sweekar" data-product-types="
                                            
                                            
                                            
                                            Tapioca Pearls OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            Soya OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            Puffed Rice OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Sweekar</option>

                  <option value="/collections/Maharaja Supermarket-shop-groceries-thai-oriental" data-product-types="
                                            ">
                    Thai & Oriental</option>

                  <option value="/collections/trs" data-product-types="
                                            
                                            
                                            
                                             OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            Whole Spices OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    TRS</option>

                  <option value="/collections/wagh-bakri" data-product-types="
                                            
                                            
                                            
                                            Leaf Tea OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                             OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Wagh Bakri</option>

                  <option value="/collections/whole-spices" data-product-types="
                                            
                                            
                                            
                                            Whole Spices OR
                                            
                                            
                                            
                                            
                                            
                                            
                                             OR
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            
                                            ">
                    Whole Spices</option>

                </select>
              </div>
            </div>
            <div class="predictive-search predictive-search--header" tabindex="-1" data-predictive-search="">
              <div class="predictive-search__loading-state">
                <svg aria-hidden="true" focusable="false" role="presentation" class="spinner" viewBox="0 0 66 66"
                  xmlns="http://www.w3.org/2000/svg">
                  <circle class="path" fill="none" stroke-width="6" cx="33" cy="33" r="30"></circle>
                </svg>
              </div>
            </div>
            <span class="predictive-search-status hidden" role="status" aria-hidden="true"></span>
          </form>
        </predictive-search></div>
    </div>
    <div class="mobile-menu-wrapper">
      <div class="menu-close-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18">
          <path fill="#24272a"
            d="M19.95 16.75l-.05-.4-1.2-1-5.2-4.2c-.1-.05-.3-.2-.6-.5l-.7-.55c-.15-.1-.5-.45-1-1.1l-.1-.1c.2-.15.4-.35.6-.55l1.95-1.85 1.1-1c1-1 1.7-1.65 2.1-1.9l.5-.35c.4-.25.65-.45.75-.45.2-.15.45-.35.65-.6s.3-.5.3-.7l-.3-.65c-.55.2-1.2.65-2.05 1.35-.85.75-1.65 1.55-2.5 2.5-.8.9-1.6 1.65-2.4 2.3-.8.65-1.4.95-1.9 1-.15 0-1.5-1.05-4.1-3.2C3.1 2.6 1.45 1.2.7.55L.45.1c-.1.05-.2.15-.3.3C.05.55 0 .7 0 .85l.05.35.05.4 1.2 1 5.2 4.15c.1.05.3.2.6.5l.7.6c.15.1.5.45 1 1.1l.1.1c-.2.15-.4.35-.6.55l-1.95 1.85-1.1 1c-1 1-1.7 1.65-2.1 1.9l-.5.35c-.4.25-.65.45-.75.45-.25.15-.45.35-.65.6-.15.3-.25.55-.25.75l.3.65c.55-.2 1.2-.65 2.05-1.35.85-.75 1.65-1.55 2.5-2.5.8-.9 1.6-1.65 2.4-2.3.8-.65 1.4-.95 1.9-1 .15 0 1.5 1.05 4.1 3.2 2.6 2.15 4.3 3.55 5.05 4.2l.2.45c.1-.05.2-.15.3-.3.1-.15.15-.3.15-.45z">
          </path>
        </svg>
      </div>
      <div class="mobile-menu-bar">
        <ul>








































          <li class="mobile-item">
            <a class="acnav-label " href="/pages/contact ">
              <?php echo $lang['contact_us']; ?>
              <svg class="menu-open-arrow" xmlns="http://www.w3.org/2000/svg" width="20" height="11"
                viewBox="0 0 20 11">
                <path fill="#24272a"
                  d="M.268 1.076C.373.918.478.813.584.76l.21.474c.79.684 2.527 2.158 5.21 4.368 2.738 2.21 4.159 3.316 4.264 3.316.474-.053 1.158-.369 1.947-1.053.842-.631 1.632-1.42 2.474-2.368.895-.948 1.737-1.842 2.632-2.58.842-.789 1.578-1.262 2.105-1.42l.316.684c0 .21-.106.474-.316.737-.053.21-.263.421-.474.579-.053.052-.316.21-.737.474l-.526.368c-.421.263-1.105.947-2.158 2l-1.105 1.053-2.053 1.947c-1 .947-1.579 1.421-1.842 1.421-.263 0-.684-.263-1.158-.895-.526-.631-.842-1-1.052-1.105l-.737-.579c-.316-.316-.527-.474-.632-.474l-5.42-4.315L.267 2.339l-.105-.421-.053-.369c0-.157.053-.315.158-.473z">
                </path>
              </svg>
              <svg class="close-menu-ioc" xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18">
                <path fill="#24272a"
                  d="M19.95 16.75l-.05-.4-1.2-1-5.2-4.2c-.1-.05-.3-.2-.6-.5l-.7-.55c-.15-.1-.5-.45-1-1.1l-.1-.1c.2-.15.4-.35.6-.55l1.95-1.85 1.1-1c1-1 1.7-1.65 2.1-1.9l.5-.35c.4-.25.65-.45.75-.45.2-.15.45-.35.65-.6s.3-.5.3-.7l-.3-.65c-.55.2-1.2.65-2.05 1.35-.85.75-1.65 1.55-2.5 2.5-.8.9-1.6 1.65-2.4 2.3-.8.65-1.4.95-1.9 1-.15 0-1.5-1.05-4.1-3.2C3.1 2.6 1.45 1.2.7.55L.45.1c-.1.05-.2.15-.3.3C.05.55 0 .7 0 .85l.05.35.05.4 1.2 1 5.2 4.15c.1.05.3.2.6.5l.7.6c.15.1.5.45 1 1.1l.1.1c-.2.15-.4.35-.6.55l-1.95 1.85-1.1 1c-1 1-1.7 1.65-2.1 1.9l-.5.35c-.4.25-.65.45-.75.45-.25.15-.45.35-.65.6-.15.3-.25.55-.25.75l.3.65c.55-.2 1.2-.65 2.05-1.35.85-.75 1.65-1.55 2.5-2.5.8-.9 1.6-1.65 2.4-2.3.8-.65 1.4-.95 1.9-1 .15 0 1.5 1.05 4.1 3.2 2.6 2.15 4.3 3.55 5.05 4.2l.2.45c.1-.05.2-.15.3-.3.1-.15.15-.3.15-.45z">
                </path>
              </svg>
            </a>

          </li>






          <li class="mobile-item">
            <a class="acnav-label " href="/pages/faq ">
              FAQ
              <svg class="menu-open-arrow" xmlns="http://www.w3.org/2000/svg" width="20" height="11"
                viewBox="0 0 20 11">
                <path fill="#24272a"
                  d="M.268 1.076C.373.918.478.813.584.76l.21.474c.79.684 2.527 2.158 5.21 4.368 2.738 2.21 4.159 3.316 4.264 3.316.474-.053 1.158-.369 1.947-1.053.842-.631 1.632-1.42 2.474-2.368.895-.948 1.737-1.842 2.632-2.58.842-.789 1.578-1.262 2.105-1.42l.316.684c0 .21-.106.474-.316.737-.053.21-.263.421-.474.579-.053.052-.316.21-.737.474l-.526.368c-.421.263-1.105.947-2.158 2l-1.105 1.053-2.053 1.947c-1 .947-1.579 1.421-1.842 1.421-.263 0-.684-.263-1.158-.895-.526-.631-.842-1-1.052-1.105l-.737-.579c-.316-.316-.527-.474-.632-.474l-5.42-4.315L.267 2.339l-.105-.421-.053-.369c0-.157.053-.315.158-.473z">
                </path>
              </svg>
              <svg class="close-menu-ioc" xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18">
                <path fill="#24272a"
                  d="M19.95 16.75l-.05-.4-1.2-1-5.2-4.2c-.1-.05-.3-.2-.6-.5l-.7-.55c-.15-.1-.5-.45-1-1.1l-.1-.1c.2-.15.4-.35.6-.55l1.95-1.85 1.1-1c1-1 1.7-1.65 2.1-1.9l.5-.35c.4-.25.65-.45.75-.45.2-.15.45-.35.65-.6s.3-.5.3-.7l-.3-.65c-.55.2-1.2.65-2.05 1.35-.85.75-1.65 1.55-2.5 2.5-.8.9-1.6 1.65-2.4 2.3-.8.65-1.4.95-1.9 1-.15 0-1.5-1.05-4.1-3.2C3.1 2.6 1.45 1.2.7.55L.45.1c-.1.05-.2.15-.3.3C.05.55 0 .7 0 .85l.05.35.05.4 1.2 1 5.2 4.15c.1.05.3.2.6.5l.7.6c.15.1.5.45 1 1.1l.1.1c-.2.15-.4.35-.6.55l-1.95 1.85-1.1 1c-1 1-1.7 1.65-2.1 1.9l-.5.35c-.4.25-.65.45-.75.45-.25.15-.45.35-.65.6-.15.3-.25.55-.25.75l.3.65c.55-.2 1.2-.65 2.05-1.35.85-.75 1.65-1.55 2.5-2.5.8-.9 1.6-1.65 2.4-2.3.8-.65 1.4-.95 1.9-1 .15 0 1.5 1.05 4.1 3.2 2.6 2.15 4.3 3.55 5.05 4.2l.2.45c.1-.05.2-.15.3-.3.1-.15.15-.3.15-.45z">
                </path>
              </svg>
            </a>

          </li>






          <li class="mobile-item">
            <a class="acnav-label " href="shop.php?category=shop-all ">
              <?php echo $lang['all_products']; ?>
              <svg class="menu-open-arrow" xmlns="http://www.w3.org/2000/svg" width="20" height="11"
                viewBox="0 0 20 11">
                <path fill="#24272a"
                  d="M.268 1.076C.373.918.478.813.584.76l.21.474c.79.684 2.527 2.158 5.21 4.368 2.738 2.21 4.159 3.316 4.264 3.316.474-.053 1.158-.369 1.947-1.053.842-.631 1.632-1.42 2.474-2.368.895-.948 1.737-1.842 2.632-2.58.842-.789 1.578-1.262 2.105-1.42l.316.684c0 .21-.106.474-.316.737-.053.21-.263.421-.474.579-.053.052-.316.21-.737.474l-.526.368c-.421.263-1.105.947-2.158 2l-1.105 1.053-2.053 1.947c-1 .947-1.579 1.421-1.842 1.421-.263 0-.684-.263-1.158-.895-.526-.631-.842-1-1.052-1.105l-.737-.579c-.316-.316-.527-.474-.632-.474l-5.42-4.315L.267 2.339l-.105-.421-.053-.369c0-.157.053-.315.158-.473z">
                </path>
              </svg>
              <svg class="close-menu-ioc" xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18">
                <path fill="#24272a"
                  d="M19.95 16.75l-.05-.4-1.2-1-5.2-4.2c-.1-.05-.3-.2-.6-.5l-.7-.55c-.15-.1-.5-.45-1-1.1l-.1-.1c.2-.15.4-.35.6-.55l1.95-1.85 1.1-1c1-1 1.7-1.65 2.1-1.9l.5-.35c.4-.25.65-.45.75-.45.2-.15.45-.35.65-.6s.3-.5.3-.7l-.3-.65c-.55.2-1.2.65-2.05 1.35-.85.75-1.65 1.55-2.5 2.5-.8.9-1.6 1.65-2.4 2.3-.8.65-1.4.95-1.9 1-.15 0-1.5-1.05-4.1-3.2C3.1 2.6 1.45 1.2.7.55L.45.1c-.1.05-.2.15-.3.3C.05.55 0 .7 0 .85l.05.35.05.4 1.2 1 5.2 4.15c.1.05.3.2.6.5l.7.6c.15.1.5.45 1 1.1l.1.1c-.2.15-.4.35-.6.55l-1.95 1.85-1.1 1c-1 1-1.7 1.65-2.1 1.9l-.5.35c-.4.25-.65.45-.75.45-.25.15-.45.35-.65.6-.15.3-.25.55-.25.75l.3.65c.55-.2 1.2-.65 2.05-1.35.85-.75 1.65-1.55 2.5-2.5.8-.9 1.6-1.65 2.4-2.3.8-.65 1.4-.95 1.9-1 .15 0 1.5 1.05 4.1 3.2 2.6 2.15 4.3 3.55 5.05 4.2l.2.45c.1-.05.2-.15.3-.3.1-.15.15-.3.15-.45z">
                </path>
              </svg>
            </a>

          </li>






          <li class="mobile-item has-children">
            <a class="acnav-label " href=" javascript: ">
              <?php echo $lang['categories']; ?>
              <svg class="menu-open-arrow" xmlns="http://www.w3.org/2000/svg" width="20" height="11"
                viewBox="0 0 20 11">
                <path fill="#24272a"
                  d="M.268 1.076C.373.918.478.813.584.76l.21.474c.79.684 2.527 2.158 5.21 4.368 2.738 2.21 4.159 3.316 4.264 3.316.474-.053 1.158-.369 1.947-1.053.842-.631 1.632-1.42 2.474-2.368.895-.948 1.737-1.842 2.632-2.58.842-.789 1.578-1.262 2.105-1.42l.316.684c0 .21-.106.474-.316.737-.053.21-.263.421-.474.579-.053.052-.316.21-.737.474l-.526.368c-.421.263-1.105.947-2.158 2l-1.105 1.053-2.053 1.947c-1 .947-1.579 1.421-1.842 1.421-.263 0-.684-.263-1.158-.895-.526-.631-.842-1-1.052-1.105l-.737-.579c-.316-.316-.527-.474-.632-.474l-5.42-4.315L.267 2.339l-.105-.421-.053-.369c0-.157.053-.315.158-.473z">
                </path>
              </svg>
              <svg class="close-menu-ioc" xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18">
                <path fill="#24272a"
                  d="M19.95 16.75l-.05-.4-1.2-1-5.2-4.2c-.1-.05-.3-.2-.6-.5l-.7-.55c-.15-.1-.5-.45-1-1.1l-.1-.1c.2-.15.4-.35.6-.55l1.95-1.85 1.1-1c1-1 1.7-1.65 2.1-1.9l.5-.35c.4-.25.65-.45.75-.45.2-.15.45-.35.65-.6s.3-.5.3-.7l-.3-.65c-.55.2-1.2.65-2.05 1.35-.85.75-1.65 1.55-2.5 2.5-.8.9-1.6 1.65-2.4 2.3-.8.65-1.4.95-1.9 1-.15 0-1.5-1.05-4.1-3.2C3.1 2.6 1.45 1.2.7.55L.45.1c-.1.05-.2.15-.3.3C.05.55 0 .7 0 .85l.05.35.05.4 1.2 1 5.2 4.15c.1.05.3.2.6.5l.7.6c.15.1.5.45 1 1.1l.1.1c-.2.15-.4.35-.6.55l-1.95 1.85-1.1 1c-1 1-1.7 1.65-2.1 1.9l-.5.35c-.4.25-.65.45-.75.45-.25.15-.45.35-.65.6-.15.3-.25.55-.25.75l.3.65c.55-.2 1.2-.65 2.05-1.35.85-.75 1.65-1.55 2.5-2.5.8-.9 1.6-1.65 2.4-2.3.8-.65 1.4-.95 1.9-1 .15 0 1.5 1.05 4.1 3.2 2.6 2.15 4.3 3.55 5.05 4.2l.2.45c.1-.05.2-.15.3-.3.1-.15.15-.3.15-.45z">
                </path>
              </svg>
            </a>


            <ul id="menu_mob_link_linklist_7PhCye" class="mobile_menu_inner acnav-list">


              <li class="menu-h-link ">
                <a class="acnav-label" href="shop.php?category=promotion"><?php echo $lang['special_offer'] ?? 'Special Offers'; ?>

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label" href="shop.php?category=rice">Rice

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label"
                  href="shop.php?category=Maharaja Supermarket-shop-groceries-beans-and-lentils">Dal,
                  Beans and Lentils

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label"
                  href="shop.php?category=Maharaja Supermarket-shop-groceries-spices-and-herbs">Whole
                  and Ground Spices (Masalas)

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label"
                  href="shop.php?category=Maharaja Supermarket-shop-groceries-coffee-and-tea">Coffee and
                  Tea

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label" href="shop.php?category=Maharaja Supermarket-shop-groceries-atta">Atta

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label" href="shop.php?category=fresh-vegetables">Fresh Vegetables

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label"
                  href="shop.php?category=Maharaja Supermarket-shop-groceries-groats-and-flour">Groats
                  and Flour

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label"
                  href="shop.php?category=Maharaja Supermarket-shop-groceries-juices-and-nectars">Juices
                  and Nectars

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label" href="shop.php?category=Maharaja Supermarket-shop-groceries-oil">Cooking Oils

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label" href="shop.php?category=default-category-snacks-and-savouries"><?php echo $lang['snacks_savouries'] ?? 'Snacks and Savouries'; ?>

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label" href="shop.php?category=frozen-food"><?php echo $lang['frozen_food']; ?>

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label" href="shop.php?category=Maharaja Supermarket-shop-instant-mix"><?php echo $lang['instant_mix']; ?>

                </a>

              </li>

            </ul>


          </li>






          <li class="mobile-item">
            <a class="acnav-label special-link" href="shop.php?category=promotion ">
              Special Offer
              <svg class="menu-open-arrow" xmlns="http://www.w3.org/2000/svg" width="20" height="11"
                viewBox="0 0 20 11">
                <path fill="#24272a"
                  d="M.268 1.076C.373.918.478.813.584.76l.21.474c.79.684 2.527 2.158 5.21 4.368 2.738 2.21 4.159 3.316 4.264 3.316.474-.053 1.158-.369 1.947-1.053.842-.631 1.632-1.42 2.474-2.368.895-.948 1.737-1.842 2.632-2.58.842-.789 1.578-1.262 2.105-1.42l.316.684c0 .21-.106.474-.316.737-.053.21-.263.421-.474.579-.053.052-.316.21-.737.474l-.526.368c-.421.263-1.105.947-2.158 2l-1.105 1.053-2.053 1.947c-1 .947-1.579 1.421-1.842 1.421-.263 0-.684-.263-1.158-.895-.526-.631-.842-1-1.052-1.105l-.737-.579c-.316-.316-.527-.474-.632-.474l-5.42-4.315L.267 2.339l-.105-.421-.053-.369c0-.157.053-.315.158-.473z">
                </path>
              </svg>
              <svg class="close-menu-ioc" xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18">
                <path fill="#24272a"
                  d="M19.95 16.75l-.05-.4-1.2-1-5.2-4.2c-.1-.05-.3-.2-.6-.5l-.7-.55c-.15-.1-.5-.45-1-1.1l-.1-.1c.2-.15.4-.35.6-.55l1.95-1.85 1.1-1c1-1 1.7-1.65 2.1-1.9l.5-.35c.4-.25.65-.45.75-.45.2-.15.45-.35.65-.6s.3-.5.3-.7l-.3-.65c-.55.2-1.2.65-2.05 1.35-.85.75-1.65 1.55-2.5 2.5-.8.9-1.6 1.65-2.4 2.3-.8.65-1.4.95-1.9 1-.15 0-1.5-1.05-4.1-3.2C3.1 2.6 1.45 1.2.7.55L.45.1c-.1.05-.2.15-.3.3C.05.55 0 .7 0 .85l.05.35.05.4 1.2 1 5.2 4.15c.1.05.3.2.6.5l.7.6c.15.1.5.45 1 1.1l.1.1c-.2.15-.4.35-.6.55l-1.95 1.85-1.1 1c-1 1-1.7 1.65-2.1 1.9l-.5.35c-.4.25-.65.45-.75.45-.25.15-.45.35-.65.6-.15.3-.25.55-.25.75l.3.65c.55-.2 1.2-.65 2.05-1.35.85-.75 1.65-1.55 2.5-2.5.8-.9 1.6-1.65 2.4-2.3.8-.65 1.4-.95 1.9-1 .15 0 1.5 1.05 4.1 3.2 2.6 2.15 4.3 3.55 5.05 4.2l.2.45c.1-.05.2-.15.3-.3.1-.15.15-.3.15-.45z">
                </path>
              </svg>
            </a>

          </li>






          <li class="mobile-item">
            <a class="acnav-label " href="shop.php?category=Maharaja Supermarket-shop-new-products ">
              New Arrivals
              <svg class="menu-open-arrow" xmlns="http://www.w3.org/2000/svg" width="20" height="11"
                viewBox="0 0 20 11">
                <path fill="#24272a"
                  d="M.268 1.076C.373.918.478.813.584.76l.21.474c.79.684 2.527 2.158 5.21 4.368 2.738 2.21 4.159 3.316 4.264 3.316.474-.053 1.158-.369 1.947-1.053.842-.631 1.632-1.42 2.474-2.368.895-.948 1.737-1.842 2.632-2.58.842-.789 1.578-1.262 2.105-1.42l.316.684c0 .21-.106.474-.316.737-.053.21-.263.421-.474.579-.053.052-.316.21-.737.474l-.526.368c-.421.263-1.105.947-2.158 2l-1.105 1.053-2.053 1.947c-1 .947-1.579 1.421-1.842 1.421-.263 0-.684-.263-1.158-.895-.526-.631-.842-1-1.052-1.105l-.737-.579c-.316-.316-.527-.474-.632-.474l-5.42-4.315L.267 2.339l-.105-.421-.053-.369c0-.157.053-.315.158-.473z">
                </path>
              </svg>
              <svg class="close-menu-ioc" xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18">
                <path fill="#24272a"
                  d="M19.95 16.75l-.05-.4-1.2-1-5.2-4.2c-.1-.05-.3-.2-.6-.5l-.7-.55c-.15-.1-.5-.45-1-1.1l-.1-.1c.2-.15.4-.35.6-.55l1.95-1.85 1.1-1c1-1 1.7-1.65 2.1-1.9l.5-.35c.4-.25.65-.45.75-.45.2-.15.45-.35.65-.6s.3-.5.3-.7l-.3-.65c-.55.2-1.2.65-2.05 1.35-.85.75-1.65 1.55-2.5 2.5-.8.9-1.6 1.65-2.4 2.3-.8.65-1.4.95-1.9 1-.15 0-1.5-1.05-4.1-3.2C3.1 2.6 1.45 1.2.7.55L.45.1c-.1.05-.2.15-.3.3C.05.55 0 .7 0 .85l.05.35.05.4 1.2 1 5.2 4.15c.1.05.3.2.6.5l.7.6c.15.1.5.45 1 1.1l.1.1c-.2.15-.4.35-.6.55l-1.95 1.85-1.1 1c-1 1-1.7 1.65-2.1 1.9l-.5.35c-.4.25-.65.45-.75.45-.25.15-.45.35-.65.6-.15.3-.25.55-.25.75l.3.65c.55-.2 1.2-.65 2.05-1.35.85-.75 1.65-1.55 2.5-2.5.8-.9 1.6-1.65 2.4-2.3.8-.65 1.4-.95 1.9-1 .15 0 1.5 1.05 4.1 3.2 2.6 2.15 4.3 3.55 5.05 4.2l.2.45c.1-.05.2-.15.3-.3.1-.15.15-.3.15-.45z">
                </path>
              </svg>
            </a>

          </li>






          <li class="mobile-item has-children">
            <a class="acnav-label " href=" javascript: ">
              Popular Brands
              <svg class="menu-open-arrow" xmlns="http://www.w3.org/2000/svg" width="20" height="11"
                viewBox="0 0 20 11">
                <path fill="#24272a"
                  d="M.268 1.076C.373.918.478.813.584.76l.21.474c.79.684 2.527 2.158 5.21 4.368 2.738 2.21 4.159 3.316 4.264 3.316.474-.053 1.158-.369 1.947-1.053.842-.631 1.632-1.42 2.474-2.368.895-.948 1.737-1.842 2.632-2.58.842-.789 1.578-1.262 2.105-1.42l.316.684c0 .21-.106.474-.316.737-.053.21-.263.421-.474.579-.053.052-.316.21-.737.474l-.526.368c-.421.263-1.105.947-2.158 2l-1.105 1.053-2.053 1.947c-1 .947-1.579 1.421-1.842 1.421-.263 0-.684-.263-1.158-.895-.526-.631-.842-1-1.052-1.105l-.737-.579c-.316-.316-.527-.474-.632-.474l-5.42-4.315L.267 2.339l-.105-.421-.053-.369c0-.157.053-.315.158-.473z">
                </path>
              </svg>
              <svg class="close-menu-ioc" xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18">
                <path fill="#24272a"
                  d="M19.95 16.75l-.05-.4-1.2-1-5.2-4.2c-.1-.05-.3-.2-.6-.5l-.7-.55c-.15-.1-.5-.45-1-1.1l-.1-.1c.2-.15.4-.35.6-.55l1.95-1.85 1.1-1c1-1 1.7-1.65 2.1-1.9l.5-.35c.4-.25.65-.45.75-.45.2-.15.45-.35.65-.6s.3-.5.3-.7l-.3-.65c-.55.2-1.2.65-2.05 1.35-.85.75-1.65 1.55-2.5 2.5-.8.9-1.6 1.65-2.4 2.3-.8.65-1.4.95-1.9 1-.15 0-1.5-1.05-4.1-3.2C3.1 2.6 1.45 1.2.7.55L.45.1c-.1.05-.2.15-.3.3C.05.55 0 .7 0 .85l.05.35.05.4 1.2 1 5.2 4.15c.1.05.3.2.6.5l.7.6c.15.1.5.45 1 1.1l.1.1c-.2.15-.4.35-.6.55l-1.95 1.85-1.1 1c-1 1-1.7 1.65-2.1 1.9l-.5.35c-.4.25-.65.45-.75.45-.25.15-.45.35-.65.6-.15.3-.25.55-.25.75l.3.65c.55-.2 1.2-.65 2.05-1.35.85-.75 1.65-1.55 2.5-2.5.8-.9 1.6-1.65 2.4-2.3.8-.65 1.4-.95 1.9-1 .15 0 1.5 1.05 4.1 3.2 2.6 2.15 4.3 3.55 5.05 4.2l.2.45c.1-.05.2-.15.3-.3.1-.15.15-.3.15-.45z">
                </path>
              </svg>
            </a>


            <ul id="menu_mob_link_linklist_Xw7RY7" class="mobile_menu_inner acnav-list">


              <li class="menu-h-link ">
                <a class="acnav-label"
                  href="https://maharajasupermarket.ro/collections/shop-all?filter.v.price.gte=&filter.v.price.lte=&filter.p.vendor=Double+Horse&sort_by=best-selling">Double
                  Horse

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label"
                  href="https://maharajasupermarket.ro/collections/shop-all?filter.v.price.gte=&filter.v.price.lte=&filter.p.vendor=Sweekar&sort_by=best-selling">Sweekar

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label"
                  href="https://maharajasupermarket.ro/collections/shop-all?filter.v.price.gte=&filter.v.price.lte=&filter.p.vendor=Kitchen+Treasures&sort_by=best-selling">Kitchen
                  Treasures

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label"
                  href="https://maharajasupermarket.ro/collections/shop-all?filter.v.price.gte=&filter.v.price.lte=&filter.p.vendor=Patanjali&sort_by=best-selling">Patanjali

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label"
                  href="https://maharajasupermarket.ro/collections/shop-all?filter.v.price.gte=&filter.v.price.lte=&filter.p.vendor=Organic+India&sort_by=best-selling">Organic
                  India

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label" href="shop.php?category=bikano">Bikano

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label"
                  href="https://maharajasupermarket.ro/collections/shop-all?filter.v.price.gte=&filter.v.price.lte=&filter.p.vendor=JFK&sort_by=best-selling">JFK
                  Indian Coffee

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label" href="shop.php?category=amul">Amul

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label" href="shop.php?category=aachi">Aachi

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label" href="shop.php?category=aashirvaad">Aashirvaad

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label" href="shop.php?category=everest">Everest

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label" href="shop.php?category=haldirams">Haldiram's

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label" href="shop.php?category=daawat">Daawat

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label" href="shop.php?category=trs">TRS

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label" href="shop.php?category=shan">Shan

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label" href="shop.php?category=wagh-bakri">Wagh Bakri

                </a>

              </li>

            </ul>


          </li>






          <li class="mobile-item">
            <a class="acnav-label " href="shop.php?category=cosmetics ">
              Health & Beauty
              <svg class="menu-open-arrow" xmlns="http://www.w3.org/2000/svg" width="20" height="11"
                viewBox="0 0 20 11">
                <path fill="#24272a"
                  d="M.268 1.076C.373.918.478.813.584.76l.21.474c.79.684 2.527 2.158 5.21 4.368 2.738 2.21 4.159 3.316 4.264 3.316.474-.053 1.158-.369 1.947-1.053.842-.631 1.632-1.42 2.474-2.368.895-.948 1.737-1.842 2.632-2.58.842-.789 1.578-1.262 2.105-1.42l.316.684c0 .21-.106.474-.316.737-.053.21-.263.421-.474.579-.053.052-.316.21-.737.474l-.526.368c-.421.263-1.105.947-2.158 2l-1.105 1.053-2.053 1.947c-1 .947-1.579 1.421-1.842 1.421-.263 0-.684-.263-1.158-.895-.526-.631-.842-1-1.052-1.105l-.737-.579c-.316-.316-.527-.474-.632-.474l-5.42-4.315L.267 2.339l-.105-.421-.053-.369c0-.157.053-.315.158-.473z">
                </path>
              </svg>
              <svg class="close-menu-ioc" xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18">
                <path fill="#24272a"
                  d="M19.95 16.75l-.05-.4-1.2-1-5.2-4.2c-.1-.05-.3-.2-.6-.5l-.7-.55c-.15-.1-.5-.45-1-1.1l-.1-.1c.2-.15.4-.35.6-.55l1.95-1.85 1.1-1c1-1 1.7-1.65 2.1-1.9l.5-.35c.4-.25.65-.45.75-.45.2-.15.45-.35.65-.6s.3-.5.3-.7l-.3-.65c-.55.2-1.2.65-2.05 1.35-.85.75-1.65 1.55-2.5 2.5-.8.9-1.6 1.65-2.4 2.3-.8.65-1.4.95-1.9 1-.15 0-1.5-1.05-4.1-3.2C3.1 2.6 1.45 1.2.7.55L.45.1c-.1.05-.2.15-.3.3C.05.55 0 .7 0 .85l.05.35.05.4 1.2 1 5.2 4.15c.1.05.3.2.6.5l.7.6c.15.1.5.45 1 1.1l.1.1c-.2.15-.4.35-.6.55l-1.95 1.85-1.1 1c-1 1-1.7 1.65-2.1 1.9l-.5.35c-.4.25-.65.45-.75.45-.25.15-.45.35-.65.6-.15.3-.25.55-.25.75l.3.65c.55-.2 1.2-.65 2.05-1.35.85-.75 1.65-1.55 2.5-2.5.8-.9 1.6-1.65 2.4-2.3.8-.65 1.4-.95 1.9-1 .15 0 1.5 1.05 4.1 3.2 2.6 2.15 4.3 3.55 5.05 4.2l.2.45c.1-.05.2-.15.3-.3.1-.15.15-.3.15-.45z">
                </path>
              </svg>
            </a>

          </li>






          <li class="mobile-item">
            <a class="acnav-label " href="shop.php?category=Maharaja Supermarket-shop-dietary-supplements ">
              Dietary Supplements
              <svg class="menu-open-arrow" xmlns="http://www.w3.org/2000/svg" width="20" height="11"
                viewBox="0 0 20 11">
                <path fill="#24272a"
                  d="M.268 1.076C.373.918.478.813.584.76l.21.474c.79.684 2.527 2.158 5.21 4.368 2.738 2.21 4.159 3.316 4.264 3.316.474-.053 1.158-.369 1.947-1.053.842-.631 1.632-1.42 2.474-2.368.895-.948 1.737-1.842 2.632-2.58.842-.789 1.578-1.262 2.105-1.42l.316.684c0 .21-.106.474-.316.737-.053.21-.263.421-.474.579-.053.052-.316.21-.737.474l-.526.368c-.421.263-1.105.947-2.158 2l-1.105 1.053-2.053 1.947c-1 .947-1.579 1.421-1.842 1.421-.263 0-.684-.263-1.158-.895-.526-.631-.842-1-1.052-1.105l-.737-.579c-.316-.316-.527-.474-.632-.474l-5.42-4.315L.267 2.339l-.105-.421-.053-.369c0-.157.053-.315.158-.473z">
                </path>
              </svg>
              <svg class="close-menu-ioc" xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18">
                <path fill="#24272a"
                  d="M19.95 16.75l-.05-.4-1.2-1-5.2-4.2c-.1-.05-.3-.2-.6-.5l-.7-.55c-.15-.1-.5-.45-1-1.1l-.1-.1c.2-.15.4-.35.6-.55l1.95-1.85 1.1-1c1-1 1.7-1.65 2.1-1.9l.5-.35c.4-.25.65-.45.75-.45.2-.15.45-.35.65-.6s.3-.5.3-.7l-.3-.65c-.55.2-1.2.65-2.05 1.35-.85.75-1.65 1.55-2.5 2.5-.8.9-1.6 1.65-2.4 2.3-.8.65-1.4.95-1.9 1-.15 0-1.5-1.05-4.1-3.2C3.1 2.6 1.45 1.2.7.55L.45.1c-.1.05-.2.15-.3.3C.05.55 0 .7 0 .85l.05.35.05.4 1.2 1 5.2 4.15c.1.05.3.2.6.5l.7.6c.15.1.5.45 1 1.1l.1.1c-.2.15-.4.35-.6.55l-1.95 1.85-1.1 1c-1 1-1.7 1.65-2.1 1.9l-.5.35c-.4.25-.65.45-.75.45-.25.15-.45.35-.65.6-.15.3-.25.55-.25.75l.3.65c.55-.2 1.2-.65 2.05-1.35.85-.75 1.65-1.55 2.5-2.5.8-.9 1.6-1.65 2.4-2.3.8-.65 1.4-.95 1.9-1 .15 0 1.5 1.05 4.1 3.2 2.6 2.15 4.3 3.55 5.05 4.2l.2.45c.1-.05.2-.15.3-.3.1-.15.15-.3.15-.45z">
                </path>
              </svg>
            </a>

          </li>






          <li class="mobile-item">
            <a class="acnav-label " href="shop.php?category=kitchen-appliances ">
              Kitchen Appliances
              <svg class="menu-open-arrow" xmlns="http://www.w3.org/2000/svg" width="20" height="11"
                viewBox="0 0 20 11">
                <path fill="#24272a"
                  d="M.268 1.076C.373.918.478.813.584.76l.21.474c.79.684 2.527 2.158 5.21 4.368 2.738 2.21 4.159 3.316 4.264 3.316.474-.053 1.158-.369 1.947-1.053.842-.631 1.632-1.42 2.474-2.368.895-.948 1.737-1.842 2.632-2.58.842-.789 1.578-1.262 2.105-1.42l.316.684c0 .21-.106.474-.316.737-.053.21-.263.421-.474.579-.053.052-.316.21-.737.474l-.526.368c-.421.263-1.105.947-2.158 2l-1.105 1.053-2.053 1.947c-1 .947-1.579 1.421-1.842 1.421-.263 0-.684-.263-1.158-.895-.526-.631-.842-1-1.052-1.105l-.737-.579c-.316-.316-.527-.474-.632-.474l-5.42-4.315L.267 2.339l-.105-.421-.053-.369c0-.157.053-.315.158-.473z">
                </path>
              </svg>
              <svg class="close-menu-ioc" xmlns="http://www.w3.org/2000/svg" width="20" height="18" viewBox="0 0 20 18">
                <path fill="#24272a"
                  d="M19.95 16.75l-.05-.4-1.2-1-5.2-4.2c-.1-.05-.3-.2-.6-.5l-.7-.55c-.15-.1-.5-.45-1-1.1l-.1-.1c.2-.15.4-.35.6-.55l1.95-1.85 1.1-1c1-1 1.7-1.65 2.1-1.9l.5-.35c.4-.25.65-.45.75-.45.2-.15.45-.35.65-.6s.3-.5.3-.7l-.3-.65c-.55.2-1.2.65-2.05 1.35-.85.75-1.65 1.55-2.5 2.5-.8.9-1.6 1.65-2.4 2.3-.8.65-1.4.95-1.9 1-.15 0-1.5-1.05-4.1-3.2C3.1 2.6 1.45 1.2.7.55L.45.1c-.1.05-.2.15-.3.3C.05.55 0 .7 0 .85l.05.35.05.4 1.2 1 5.2 4.15c.1.05.3.2.6.5l.7.6c.15.1.5.45 1 1.1l.1.1c-.2.15-.4.35-.6.55l-1.95 1.85-1.1 1c-1 1-1.7 1.65-2.1 1.9l-.5.35c-.4.25-.65.45-.75.45-.25.15-.45.35-.65.6-.15.3-.25.55-.25.75l.3.65c.55-.2 1.2-.65 2.05-1.35.85-.75 1.65-1.55 2.5-2.5.8-.9 1.6-1.65 2.4-2.3.8-.65 1.4-.95 1.9-1 .15 0 1.5 1.05 4.1 3.2 2.6 2.15 4.3 3.55 5.05 4.2l.2.45c.1-.05.2-.15.3-.3.1-.15.15-.3.15-.45z">
                </path>
              </svg>
            </a>

          </li>


        </ul>
      </div>
    </div>

    <script type="application/ld+json">
  {
    "@context": "http://schema.org",
    "@type": "Organization",
    "name": "Maharaja Supermarket",
    
      
      "logo": "https:\/\/maharajasupermarket.ro\/cdn\/shop\/files\/image_1_550x.png?v=1762949784"
    
}
</script>
    <script type="application/ld+json">
    {
      "@context": "http://schema.org",
      "@type": "WebSite",
      "name": "Maharaja Supermarket",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https:\/\/maharajasupermarket.ro\/search?q={search_term_string}",
        "query-input": "required name=search_term_string"
      },
      "url": "https:\/\/maharajasupermarket.ro"
    }
  </script>
  </header>