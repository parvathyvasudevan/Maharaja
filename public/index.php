/**
 * Home Page
 * 
 * Path: public/index.php
 * Part of: Maharaja Supermarket
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection ($link)
require_once __DIR__ . '/../config/database.php';

// Bilingual support
require_once __DIR__ . '/../includes/init_lang.php';
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
      background: url(/cdn/shop/t/4/assets/arrow-chevron.svg) no-repeat;
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
    input,
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
      background: url(/cdn/shop/t/6/assets/arrow-chevron.svg) no-repeat;
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
    input:not([type=checkbox]),
    input:not([type=radio]),
    input:not([type=submit]),
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
  <!-- Thunder JS Deferral --->
  <script type="text/javascript" async=""
    src="/cdn/s/trekkie.storefront.8f32c7f0b513e73f3235c26245676203e1209161.min.js"></script>
  <script type="text/javascript" async=""
    src="/cdn/s/trekkie.storefront.8f32c7f0b513e73f3235c26245676203e1209161.min.js"></script>
  <script>
       c onst e = { t: [/pa ypalobjects /i, /klaviy o/ i, / w i sti a/ i], i: [] }, t = (t, c) = > t && (!e.t | | e.t.s ome((e => e.te st(t)))) && (!e.i || e.i.every((e => !e.t e st(t)))), c = document.createElement, r = { src: Object.getOwnPr opertyD escri ptor(HTMLScriptElement.prototype, "src"), type: Object.getOw nPropert yDescr iptor(HTMLScriptElement.prototype, "type"), defer: Object.ge tOwnProp er tyDescriptor(HTMLScrip t Element.protot y pe, "defer" ) }; document.createEl ement = function (...e) { if ("script " !== e[0].toLowerCase()) r e turn c.bind(document)(...e); co n st i = c.bind(d o cume nt)(...e); try { Object.defineP roperties(i, { src: { ...r.sr c, se t(e) { t(e, i.ty pe) & & r.defe r.set.call(this, "defer "), r.src.set.c al l(this, e) } }, type: { ...r.type, g et() { const e = r.type.get.cal l(this); return t(i.src, 0) && r.defer.set.call(t his, "defer"), e }, set(e) { r.t ype.se t.c a ll(this, e), t(i.s r c, i.type) && r.defer.set.call(this, "defer") } } }), i.set Att r ibute = function (e, t) { "type" === e || "src" === e ? i[e] = t : HTMLScriptE lement.proto type.setAttribute.call(i, e, t) } } catch (e) { console.warn("Thunder was unable to prevent script execution for script src ", i.src, ".\n", 'A likely cause   would be  because you are using a Shopify app or a third-party browser extension that monkey patches     the "document.createElement" function.') } return i };
  </script>
  <!-- End Thunder JS Deferral --->
  <!-- End Thunder PageSpeed--->


  <link rel="icon" href="maharaja_logo.png" type="image/png" sizes="48x48">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="theme-color" content="">
  <link rel="canonical" href="/">
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
  <meta property="og:url" content="/">
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
  <script src="jquery.min_v=115860211936397945481742289479.js" defer=""></script>
  <script src="jquery-cookie.min_v=72365755745404048181742289478.js" defer=""></script>
  <script src="slick.min_v=53086775176596072461742289479.js" defer=""></script>

  <!-- Load deferred scripts -->
  <script src="global_v=83446935447870679591742289478.js" defer=""></script>
  <script src="/cdn/shopifycloud/storefront/assets/themes_support/api.jquery-7ab1a3a4.js"
    defer=""></script>
  <script src="countdown_v=1097705409581063121742289478.js" defer=""></script>
  <script src="cart-notification_v=21742545381121272691742289478.js" defer=""></script>
  <script src="swiper.min_v=146640479871518466531742289479.js" defer=""></script>

  <!-- Conditional script loading based on locale -->

  <script src="custom_v=171421164427531449841742289478.js" defer=""></script>


  <script>window.performance && window.performance.mark && window.performance.mark('shopify.content_for_header.start');</script>
  <meta name="facebook-domain-verification" content="oj0xj2os2kx72wk4lx67bh8dge0jhx">
  <meta id="shopify-digital-wallet" name="shopify-digital-wallet" content="/63657836700/digital_wallets/dialog">
  <link rel="alternate" hreflang="x-default" href="/">
  <link rel="alternate" hreflang="ro" href="/pl">
  <script async="async" src="/checkouts/internal/preloads_locale=en-PL.js"></script>
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
    src="/cdn/shopifycloud/shop-js/modules/v2/client.init-shop-cart-sync_DtuiiIyl.en.esm.js"></script>
  <script defer="defer" async="" type="module"
    src="/cdn/shopifycloud/shop-js/modules/v2/chunk.common_CUHEfi5Q.esm.js"></script>
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
    src="/cdn/shopifycloud/storefront/assets/storefront/load_feature-a0a9edcb.js"
    crossorigin="anonymous"></script>
  <script>
    fetch('/sf_private_access_tokens' + location.search).catch(() => { });
  </script>
  <script data-source-attribution="shopify.dynamic_checkout.dynamic.init">var Shopify = Shopify || {}; Shopify.PaymentButton = Shopify.PaymentButton || { isStorefrontPortableWallets: !0, init: function () { window.Shopify.PaymentButton.init = function () { }; var t = document.createElement("script"); t.src = "/cdn/shopifycloud/portable-wallets/latest/portable-wallets.en.js", t.type = "module", document.head.appendChild(t) } };
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
                        "urlTemplate": "/search?q={query}"
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
    id="web-pixels-manager-setup">(function e(e, d, r, n, o) { if (void 0 === o && (o = {}), !Boolean(null === (a = null === (i = window.Shopify) || void 0 === i ? void 0 : i.analytics) || void 0 === a ? void 0 : a.replayQueue)) { var i, a; window.Shopify = window.Shopify || {}; var t = window.Shopify; t.analytics = t.analytics || {}; var s = t.analytics; s.replayQueue = [], s.publish = function (e, d, r) { return s.replayQueue.push([e, d, r]), !0 }; try { self.performance.mark("wpm:start") } catch (e) { } var l = function () { var e = { modern: /Edge?\/(1{2}[4-9]|1[2-9]\d|[2-9]\d{2}|\d{4,})\.\d+(\.\d+|)|Firefox\/(1{2}[4-9]|1[2-9]\d|[2-9]\d{2}|\d{4,})\.\d+(\.\d+|)|Chrom(ium|e)\/(9{2}|\d{3,})\.\d+(\.\d+|)|(Maci|X1{2}).+ Version\/(15\.\d+|(1[6-9]|[2-9]\d|\d{3,})\.\d+)([,.]\d+|)( \(\w+\)|)( Mobile\/\w+|) Safari\/|Chrome.+OPR\/(9{2}|\d{3,})\.\d+\.\d+|(CPU[ +]OS|iPhone[ +]OS|CPU[ +]iPhone|CPU IPhone OS|CPU iPad OS)[ +]+(15[._]\d+|(1[6-9]|[2-9]\d|\d{3,})[._]\d+)([._]\d+|)|Android:?[ /-](13[3-9]|1[4-9]\d|[2-9]\d{2}|\d{4,})(\.\d+|)(\.\d+|)|Android.+Firefox\/(13[5-9]|1[4-9]\d|[2-9]\d{2}|\d{4,})\.\d+(\.\d+|)|Android.+Chrom(ium|e)\/(13[3-9]|1[4-9]\d|[2-9]\d{2}|\d{4,})\.\d+(\.\d+|)|SamsungBrowser\/([2-9]\d|\d{3,})\.\d+/, legacy: /Edge?\/(1[6-9]|[2-9]\d|\d{3,})\.\d+(\.\d+|)|Firefox\/(5[4-9]|[6-9]\d|\d{3,})\.\d+(\.\d+|)|Chrom(ium|e)\/(5[1-9]|[6-9]\d|\d{3,})\.\d+(\.\d+|)([\d.]+$|.*Safari\/(?![\d.]+ Edge\/[\d.]+$))|(Maci|X1{2}).+ Version\/(10\.\d+|(1[1-9]|[2-9]\d|\d{3,})\.\d+)([,.]\d+|)( \(\w+\)|)( Mobile\/\w+|) Safari\/|Chrome.+OPR\/(3[89]|[4-9]\d|\d{3,})\.\d+\.\d+|(CPU[ +]OS|iPhone[ +]OS|CPU[ +]iPhone|CPU IPhone OS|CPU iPad OS)[ +]+(10[._]\d+|(1[1-9]|[2-9]\d|\d{3,})[._]\d+)([._]\d+|)|Android:?[ /-](13[3-9]|1[4-9]\d|[2-9]\d{2}|\d{4,})(\.\d+|)(\.\d+|)|Mobile Safari.+OPR\/([89]\d|\d{3,})\.\d+\.\d+|Android.+Firefox\/(13[5-9]|1[4-9]\d|[2-9]\d{2}|\d{4,})\.\d+(\.\d+|)|Android.+Chrom(ium|e)\/(13[3-9]|1[4-9]\d|[2-9]\d{2}|\d{4,})\.\d+(\.\d+|)|Android.+(UC? ?Browser|UCWEB|U3)[ /]?(15\.([5-9]|\d{2,})|(1[6-9]|[2-9]\d|\d{3,})\.\d+)\.\d+|SamsungBrowser\/(5\.\d+|([6-9]|\d{2,})\.\d+)|Android.+MQ{2}Browser\/(14(\.(9|\d{2,})|)|(1[5-9]|[2-9]\d|\d{3,})(\.\d+|))(\.\d+|)|K[Aa][Ii]OS\/(3\.\d+|([4-9]|\d{2,})\.\d+)(\.\d+|)/ }, d = e.modern, r = e.legacy, n = navigator.userAgent; return n.match(d) ? "modern" : n.match(r) ? "legacy" : "unknown" }(), u = "modern" === l ? "modern" : "legacy", c = (null != n ? n : { modern: "", legacy: "" })[u], f = function (e) { return [e.baseUrl, "/wpm", "/b", e.hashVersion, "modern" === e.buildTarget ? "m" : "l", ".js"].join("") }({ baseUrl: d, hashVersion: r, buildTarget: u }), m = function (e) { var d = e.version, r = e.bundleTarget, n = e.surface, o = e.pageUrl, i = e.monorailEndpoint; return { emit: function (e) { var a = e.status, t = e.errorMsg, s = (new Date).getTime(), l = JSON.stringify({ metadata: { event_sent_at_ms: s }, events: [{ schema_id: "web_pixels_manager_load/3.1", payload: { version: d, bundle_target: r, page_url: o, status: a, surface: n, error_msg: t }, metadata: { event_created_at_ms: s } }] }); if (!i) return console && console.warn && console.warn("[Web Pixels Manager] No Monorail endpoint provided, skipping logging."), !1; try { return self.navigator.sendBeacon.bind(self.navigator)(i, l) } catch (e) { } var u = new XMLHttpRequest; try { return u.open("POST", i, !0), u.setRequestHeader("Content-Type", "text/plain"), u.send(l), !0 } catch (e) { return console && console.warn && console.warn("[Web Pixels Manager] Got an unhandled error while logging to Monorail."), !1 } } } }({ version: r, bundleTarget: l, surface: e.surface, pageUrl: self.location.href, monorailEndpoint: e.monorailEndpoint }); try { o.browserTarget = l, function (e) { var d = e.src, r = e.async, n = void 0 === r || r, o = e.onload, i = e.onerror, a = e.sri, t = e.scriptDataAttributes, s = void 0 === t ? {} : t, l = document.createElement("script"), u = document.querySelector("head"), c = document.querySelector("body"); if (l.async = n, l.src = d, a && (l.integrity = a, l.crossOrigin = "anonymous"), s) for (var f in s) if (Object.prototype.hasOwnProperty.call(s, f)) try { l.dataset[f] = s[f] } catch (e) { } if (o && l.addEventListener("load", o), i && l.addEventListener("error", i), u) u.appendChild(l); else { if (!c) throw new Error("Did not find a head or body element to append the script"); c.appendChild(l) } }({ src: f, async: !0, onload: function () { if (!function () { var e, d; return Boolean(null === (d = null === (e = window.Shopify) || void 0 === e ? void 0 : e.analytics) || void 0 === d ? void 0 : d.initialized) }()) { var d = window.webPixelsManager.init(e) || void 0; if (d) { var r = window.Shopify.analytics; r.replayQueue.forEach((function (e) { var r = e[0], n = e[1], o = e[2]; d.publishCustomEvent(r, n, o) })), r.replayQueue = [], r.publish = d.publishCustomEvent, r.visitor = d.visitor, r.initialized = !0 } } }, onerror: function () { return m.emit({ status: "failed", errorMsg: "".concat(f, " has failed to load") }) }, sri: function (e) { var d = /^sha384-[A-Za-z0-9+/=]+$/; return "string" == typeof e && d.test(e) }(c) ? c : "", scriptDataAttributes: o }), m.emit({ status: "loading" }) } catch (e) { m.emit({ status: "failed", errorMsg: (null == e ? void 0 : e.message) || "Unknown error" }) } } })({ shopId: 63657836700, storefrontBaseUrl: "https://maharajasupermarket.ro", extensionsBaseUrl: "https://extensions.shopifycdn.com/cdn/shopifycloud/web-pixels-manager", monorailEndpoint: "https://monorail-edge.shopifysvc.com/unstable/produce_batch", surface: "storefront-renderer", enabledBetaFlags: ["2dca8a86", "a0d5f9d2"], webPixelsConfigList: [{ "id": "1055391900", "configuration": "{\"webPixelName\":\"Judge.me\"}", "eventPayloadVersion": "v1", "runtimeContext": "STRICT", "scriptVersion": "34ad157958823915625854214640f0bf", "type": "APP", "apiClientId": 683015, "privacyPurposes": ["ANALYTICS"], "dataSharingAdjustments": { "protectedCustomerApprovalScopes": ["read_customer_email", "read_customer_name", "read_customer_personal_data", "read_customer_phone"] } }, { "id": "617119900", "configuration": "{\"pixel_id\":\"422866954167895\",\"pixel_type\":\"facebook_pixel\"}", "eventPayloadVersion": "v1", "runtimeContext": "OPEN", "scriptVersion": "ca16bc87fe92b6042fbaa3acc2fbdaa6", "type": "APP", "apiClientId": 2329312, "privacyPurposes": ["ANALYTICS", "MARKETING", "SALE_OF_DATA"], "dataSharingAdjustments": { "protectedCustomerApprovalScopes": ["read_customer_address", "read_customer_email", "read_customer_name", "read_customer_personal_data", "read_customer_phone"] } }, { "id": "564789404", "configuration": "{\"config\":\"{\\\"google_tag_ids\\\":[\\\"G-QT89TM8J0K\\\",\\\"GT-K8GX9H7D\\\"],\\\"target_country\\\":\\\"ZZ\\\",\\\"gtag_events\\\":[{\\\"type\\\":\\\"search\\\",\\\"action_label\\\":\\\"G-QT89TM8J0K\\\"},{\\\"type\\\":\\\"begin_checkout\\\",\\\"action_label\\\":\\\"G-QT89TM8J0K\\\"},{\\\"type\\\":\\\"view_item\\\",\\\"action_label\\\":[\\\"G-QT89TM8J0K\\\",\\\"MC-0622R69ZJ6\\\"]},{\\\"type\\\":\\\"purchase\\\",\\\"action_label\\\":[\\\"G-QT89TM8J0K\\\",\\\"MC-0622R69ZJ6\\\",\\\"AW-10814656859\\\/AxWjCIurn_sDENui6qQo\\\"]},{\\\"type\\\":\\\"page_view\\\",\\\"action_label\\\":[\\\"G-QT89TM8J0K\\\",\\\"MC-0622R69ZJ6\\\"]},{\\\"type\\\":\\\"add_payment_info\\\",\\\"action_label\\\":\\\"G-QT89TM8J0K\\\"},{\\\"type\\\":\\\"add_to_cart\\\",\\\"action_label\\\":\\\"G-QT89TM8J0K\\\"}],\\\"enable_monitoring_mode\\\":false}\"}", "eventPayloadVersion": "v1", "runtimeContext": "OPEN", "scriptVersion": "b2a88bafab3e21179ed38636efcd8a93", "type": "APP", "apiClientId": 1780363, "privacyPurposes": [], "dataSharingAdjustments": { "protectedCustomerApprovalScopes": ["read_customer_address", "read_customer_email", "read_customer_name", "read_customer_personal_data", "read_customer_phone"] } }, { "id": "shopify-app-pixel", "configuration": "{}", "eventPayloadVersion": "v1", "runtimeContext": "STRICT", "scriptVersion": "0450", "apiClientId": "shopify-pixel", "type": "APP", "privacyPurposes": ["ANALYTICS", "MARKETING"] }, { "id": "shopify-custom-pixel", "eventPayloadVersion": "v1", "runtimeContext": "LAX", "scriptVersion": "0450", "apiClientId": "shopify-pixel", "type": "CUSTOM", "privacyPurposes": ["ANALYTICS", "MARKETING"] }], isMerchantRequest: false, initData: { "shop": { "name": "Maharaja Supermarket", "paymentSettings": { "currencyCode": "RON" }, "myshopifyDomain": "new-Maharaja Supermarket.myshopify.com", "countryCode": "PL", "storefrontUrl": "https:\/\/maharajasupermarket.ro" }, "customer": null, "cart": null, "checkout": null, "productVariants": [], "purchasingCompany": null }, }, "/cdn", "da62cc92w68dfea28pcf9825a4m392e00d0", { "modern": "", "legacy": "" }, { "shopId": "63657836700", "storefrontBaseUrl": "https:\/\/maharajasupermarket.ro", "extensionBaseUrl": "https:\/\/extensions.shopifycdn.com\/cdn\/shopifycloud\/web-pixels-manager", "surface": "storefront-renderer", "enabledBetaFlags": "[\"2dca8a86\", \"a0d5f9d2\"]", "isMerchantRequest": "false", "hashVersion": "da62cc92w68dfea28pcf9825a4m392e00d0", "publish": "custom", "events": "[[\"page_viewed\",{}]]" });</script>
  <script async="" src="/cdn/wpm/bda62cc92w68dfea28pcf9825a4m392e00d0m.js"
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
    src="/cdn/shopifycloud/storefront/assets/shop_events_listener-3da45d37.js"></script>
  <script defer="" src="/cdn/shopifycloud/perf-kit/shopify-perf-kit-2.1.2.min.js"
    data-application="storefront-renderer" data-shop-id="63657836700" data-render-region="gcp-europe-west1"
    data-page-type="index" data-theme-instance-id="141771800732" data-theme-name="style" data-theme-version="6.2.0"
    data-monorail-region="shop_domain" data-resource-timing-sampling-rate="10" data-shs="true" data-shs-beacon="true"
    data-shs-export-with-fetch="true" data-shs-logs-sample-rate="1"
    data-shs-beacon-endpoint="/api/collect"></script>
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

    <div class="header__announcement-bar">
      <div class="container">
        <form method="post" action="/localization" id="language-form" accept-charset="UTF-8"
          class="shopify-localization-form" enctype="multipart/form-data"><input type="hidden" name="form_type"
            value="localization"><input type="hidden" name="utf8" value="✓"><input type="hidden" name="_method"
            value="put"><input type="hidden" name="return_to" value="/">
          <div class="locale-selector__wrap">
            <h2 class="visually-hidden" id="language-label">Language</h2>
            <select name="locale_code" aria-labelledby="language-label"
              onchange="if(this.value === 'ro') window.location.href='ro.html'">
              <option value="en" lang="en" selected="">
                En
              </option>
              <option value="ro" lang="ro">
                Ro
              </option>
            </select>
            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="6" viewBox="0 0 10 6" fill="none">
              <path d="M9 1.00003C9 1.00003 6.05407 5 5 5C3.94587 5 1 1 1 1" stroke="#5C5C5C" stroke-width="1.5"
                stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>


          </div>
        </form>
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

        <div class="header-sign-in-up__group">
          <?php if (isset($_SESSION['customer_id'])): ?>
            <div class="user-account-dropdown">
              <span class="welcome-text" style="font-weight: 600; margin-right: 10px;">
                Welcome, <?php echo htmlspecialchars($_SESSION['customer_name'] ?? 'User'); ?>
              </span>
              <a href="/account/logout.php" class="btn btn--secondary btn--sm">Logout</a>
            </div>
          <?php else: ?>
            <a href="/account/login.php" class="btn btn--secondary btn--sm">
              Sign In
            </a>
            <a href="/account/register.php" class="btn btn--primary btn--sm">
              Sign Up
            </a>
          <?php endif; ?>
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

                      <span class="count">0</span>
                    </a>
                    <webi-cart-items class="cartDrawer is-empty">
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
                        <div class="cart-tottl-itm">0 Items</div>
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
                        <form action="/cart" class="mini-cart-body" method="post" id="cart">
                          <div id="webi-main-cart-items" data-id="header">
                            <div class="js-contents"></div>
                          </div>
                          <p class="hidden" id="webi-cart-live-region-text" aria-live="polite" role="status"></p>
                          <p class="hidden" id="shopping-cart-line-item-status" aria-live="polite" aria-hidden="true"
                            role="status">Loading...</p>
                        </form>
                        <div class="webi-mini-cart-footer  is-empty" id="webi-main-cart-footer" data-id="header">
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
                                <div class="mini-total-price"><span class="money"> Lei0.00 RON</span></div>
                              </div>
                              <div></div>
                            </div>

                            <div class="cart__ctas mini-cart__ctas">
                              <noscript>
                                <button type="submit" class="cart__update-button button button--secondary"
                                  form="cart">Update</button>
                              </noscript>
                              <button type="submit" id="checkout" class="btn btn--primary btn--arrow" name="checkout"
                                form="cart">
                                Proceed to checkout

                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                  fill="none">
                                  <path d="M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                                  <path d="M15 17C15 17 20 13.3176 20 12C20 10.6824 15 7 15 7" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>

                              </button>
                              <a href="cart.php" class="btn btn--secondary btn--arrow" form="cart">
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

                            <a href="shop.php?category=Maharaja Supermarket-shop-groceries-spices-and-herbs">Seasonings &
                              Spices</a>
                          </li>

                          <li>

                            <a href="shop.php?category=Maharaja Supermarket-shop-sauces-and-pickles">Indian Pickles </a>
                          </li>

                          <li>

                            <a href="shop.php?category=Maharaja Supermarket-shop-groceries-beans-and-lentils">Dal, Beans and
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

                            <a href="shop.php?category=Maharaja Supermarket-shop-groceries-coffee-and-tea">Coffee and Tea</a>
                          </li>

                          <li>

                            <a href="shop.php?category=Maharaja Supermarket-shop-groceries-juices-and-nectars">Juices and
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
                      <a href="shop.php?category=double-horse">Double Horse</a>
                    </li>


                    <li class="">
                      <a href="shop.php?category=sweekar">Sweekar</a>
                    </li>


                    <li class="">
                      <a href="shop.php?category=kitchen-treasures">Kitchen Treasures</a>
                    </li>


                    <li class="">
                      <a href="shop.php?category=patanjali">Patanjali</a>
                    </li>


                    <li class="">
                      <a href="shop.php?category=organic-india">Organic India</a>
                    </li>


                    <li class="">
                      <a href="shop.php?category=bikano">Bikano</a>
                    </li>


                    <li class="">
                      <a href="shop.php?category=jfk">JFK Indian Coffee</a>
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
              Contact Us
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
              All Products
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
              Categories
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
                <a class="acnav-label" href="shop.php?category=promotion">Special Offers

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label" href="shop.php?category=rice">Rice

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label" href="shop.php?category=Maharaja Supermarket-shop-groceries-beans-and-lentils">Dal,
                  Beans and Lentils

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label" href="shop.php?category=Maharaja Supermarket-shop-groceries-spices-and-herbs">Whole
                  and Ground Spices (Masalas)

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label" href="shop.php?category=Maharaja Supermarket-shop-groceries-coffee-and-tea">Coffee and
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
                <a class="acnav-label" href="shop.php?category=Maharaja Supermarket-shop-groceries-groats-and-flour">Groats
                  and Flour

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label" href="shop.php?category=Maharaja Supermarket-shop-groceries-juices-and-nectars">Juices
                  and Nectars

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label" href="shop.php?category=Maharaja Supermarket-shop-groceries-oil">Cooking Oils

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label" href="shop.php?category=default-category-snacks-and-savouries">Snacks and Savouries

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label" href="shop.php?category=frozen-food">Frozen Food

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label" href="shop.php?category=Maharaja Supermarket-shop-instant-mix">Instant Mix

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
                  href="shop.php?category=Double+Horse">Double
                  Horse

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label"
                  href="shop.php?category=Sweekar">Sweekar

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label"
                  href="shop.php?category=Kitchen+Treasures">Kitchen
                  Treasures

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label"
                  href="shop.php?category=Patanjali">Patanjali

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label"
                  href="shop.php?category=Organic+India">Organic
                  India

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label" href="shop.php?category=bikano">Bikano

                </a>

              </li>


              <li class="menu-h-link ">
                <a class="acnav-label"
                  href="shop.php?category=JFK">JFK
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
  <main id="MainContent" class="content-for-layout" role="main" tabindex="-1">
    <div id="shopify-section-template--17996521046172__17479916526de48575" class="shopify-section">


      <style data-shopify="">
        .ai-mobile-nav-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p {
          display: none;
          width: 100%;
          background-color: #ffffff;
          padding: 10px 0;
          position: relative;
          z-index: 2;
          /* Lower z-index to ensure proper stacking */
          box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        @media screen and (max-width: 749px) {
          .ai-mobile-nav-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p {
            display: block;
          }
        }

        .ai-mobile-nav__container-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p {
          max-width: 100%;
          padding: 0 15px;
          margin: 0 auto;
        }

        .ai-mobile-nav__links-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p {
          display: flex;
          overflow-x: auto;
          -webkit-overflow-scrolling: touch;
          scrollbar-width: none;
          margin: 0;
          padding: 0;
          list-style: none;
        }

        .ai-mobile-nav__links-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p::-webkit-scrollbar {
          display: none;
        }

        .ai-mobile-nav__link-item-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p {
          flex: 0 0 auto;
          margin-right: 20px;
        }

        .ai-mobile-nav__link-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p {
          display: block;
          padding: 8px 0;
          font-size: 15px;
          font-weight: bold;
          color: #70ab22;
          text-decoration: none;
          white-space: nowrap;
          transition: color 0.2s ease;
          position: relative;
        }

        .ai-mobile-nav__link-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p::after {
          content: '';
          position: absolute;
          bottom: 0;
          left: 0;
          width: 0;
          height: 2px;
          background-color: #6ea622;
          transition: width 0.3s ease;
        }

        .ai-mobile-nav__link-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p:hover,
        .ai-mobile-nav__link-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p:focus {
          color: #6ea622;
        }

        .ai-mobile-nav__link-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p:hover::after,
        .ai-mobile-nav__link-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p:focus::after {
          width: 100%;
        }

        .ai-mobile-search-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p {
          margin-top: 10px;
          position: relative;
        }

        .ai-mobile-search__form-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p {
          display: flex;
          align-items: center;
        }

        .ai-mobile-search__input-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p {
          flex: 1;
          padding: 10px 40px 10px 15px;
          border: 1px solid #dddddd;
          border-radius: 4px;
          font-size: 14px;
          width: 100%;
        }

        .ai-mobile-search__button-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p {
          position: absolute;
          right: 10px;
          top: 50%;
          transform: translateY(-50%);
          background: transparent;
          border: none;
          padding: 0;
          cursor: pointer;
          color: #70ab22;
        }

        .ai-mobile-search__button-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p svg {
          width: 18px;
          height: 18px;
        }

        .ai-mobile-search__results-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p {
          position: absolute;
          top: 100%;
          left: 0;
          right: 0;
          background-color: #ffffff;
          border: 1px solid #dddddd;
          border-top: none;
          border-radius: 0 0 4px 4px;
          max-height: 300px;
          overflow-y: auto;
          z-index: 5;
          /* Higher z-index only for the results dropdown */
          box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
          display: none;
        }

        .ai-mobile-search__results-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p.active {
          display: block;
        }

        .ai-mobile-search__result-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p {
          padding: 10px 15px;
          border-bottom: 1px solid #dddddd;
        }

        .ai-mobile-search__result-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p:last-child {
          border-bottom: none;
        }

        .ai-mobile-search__result-link-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p {
          display: flex;
          align-items: center;
          text-decoration: none;
          color: #70ab22;
        }

        .ai-mobile-search__result-image-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p {
          width: 40px;
          height: 40px;
          margin-right: 10px;
          object-fit: cover;
        }

        .ai-mobile-search__result-details-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p {
          flex: 1;
        }

        .ai-mobile-search__result-title-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p {
          font-size: 14px;
          margin: 0 0 4px;
        }

        .ai-mobile-search__result-price-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p {
          font-size: 12px;
          color: #6ea622;
        }

        .ai-mobile-search__no-results-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p {
          padding: 15px;
          text-align: center;
          color: #70ab22;
        }
      </style>

      <mobile-navigation-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p
        class="ai-mobile-nav-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p" data-predictive-search="true">
        <div class="ai-mobile-nav__container-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p">
          <ul class="ai-mobile-nav__links-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p">

            <li class="ai-mobile-nav__link-item-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p">
              <a href="/collections" class="ai-mobile-nav__link-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p">
                All Categories
              </a>
            </li>

            <li class="ai-mobile-nav__link-item-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p">
              <a href="shop.php?category=promotion" class="ai-mobile-nav__link-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p">
                Super Discounts
              </a>
            </li>

            <li class="ai-mobile-nav__link-item-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p">
              <a href="shop.php?category=Maharaja Supermarket-shop-new-products"
                class="ai-mobile-nav__link-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p">
                New Arrivals
              </a>
            </li>

          </ul>


          <div class="ai-mobile-search-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p">
            <form action="/search" method="get" role="search"
              class="ai-mobile-search__form-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p">
              <input type="search" name="q" placeholder="What are you looking for?"
                class="ai-mobile-search__input-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p"
                aria-label="What are you looking for?" autocomplete="off">
              <button type="submit" class="ai-mobile-search__button-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p"
                aria-label="Search">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                    d="M21 21L16.65 16.65M1911C19 15.4183 15.4183 19 11 19C6.58172 19 3 15.4183 3 11C3 6.58172 6.58172 3 11 3C15.4183 3 19 6.58172 19 11Z"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
              </button>
            </form>
            <div class="ai-mobile-search__results-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p"></div>
          </div>

        </div>
      </mobile-navigation-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p>

      <script>
        (function () {
          class MobileNavigationan2xxstvlmkfwdfhezaigenblock975f4edce7h9p extends HTMLElement {
            constructor() {
              super();
              this.searchInput = this.querySelector('.ai-mobile-search__input-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p');
              this.searchResults = this.querySelector('.ai-mobile-search__results-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p');
              this.predictiveSearchEnabled = this.dataset.predictiveSearch === 'true';
              this.searchTimeout = null;
              this.searchMinChars = 3;
            }

            connectedCallback() {
              if (this.searchInput && this.predictiveSearchEnabled) {
                this.searchInput.addEventListener('input', this.handleSearchInput.bind(this));
                this.searchInput.addEventListener('focus', this.handleSearchFocus.bind(this));

                // Close search results when clicking outside
                document.addEventListener('click', (event) => {
                  if (!this.contains(event.target)) {
                    this.searchResults.classList.remove('active');
                  }
                });
              }

              // Add event listeners to detect when other elements are interacted with
              this.setupInteractionListeners();
            }

            disconnectedCallback() {
              document.removeEventListener('click', this.handleDocumentClick);
            }

            setupInteractionListeners() {
              // Common selectors for mobile menu toggles and interactive elements
              const interactiveSelectors = [
                '.mobile-menu-toggle',
                '.drawer-toggle',
                '.js-drawer-open-button',
                '.hamburger',
                '.mobile-nav-toggle',
                '.site-nav--mobile',
                '[data-action="toggle-menu"]',
                '.header__menu-toggle',
                '.menu-toggle'
              ];

              // Handle clicks on the document
              this.handleDocumentClick = (event) => {
                // Check if clicked element is a menu toggle
                const isMenuToggle = interactiveSelectors.some(selector =>
                  event.target.matches(selector) || event.target.closest(selector)
                );

                if (isMenuToggle) {
                  // If a menu toggle is clicked, ensure our navigation doesn't interfere
                  this.style.zIndex = '1';
                }
              };

              document.addEventListener('click', this.handleDocumentClick);
              // Observe body class changes to detect menu state
              const bodyObserver = new MutationObserver(mutations => {
                mutations.forEach(mutation => {
                  if (mutation.attributeName === 'class') {
                    const bodyClasses = document.body.classList;
                    // Common class names that indicate a mobile menu is open
                    const menuOpenClasses = [
                      'mobile-menu-open',
                      'js-drawer-open',
                      'menu-open',
                      'has-overlay',
                      'overflow-hidden'
                    ];

                    const isMenuOpen = menuOpenClasses.some(className => bodyClasses.contains(className));

                    if (isMenuOpen) {
                      // If a menu is open, lower our z-index
                      this.style.zIndex = '1';
                    } else {
                      // Reset z-index when menu closes
                      this.style.zIndex = '2';
                    }
                  }
                });
              });

              bodyObserver.observe(document.body, { attributes: true });
            }

            handleSearchInput(event) {
              const searchTerm = event.target.value.trim();

              clearTimeout(this.searchTimeout);

              if (searchTerm.length < this.searchMinChars) {
                this.searchResults.classList.remove('active');
                return;
              }

              this.searchTimeout = setTimeout(() => {
                this.performPredictiveSearch(searchTerm);
              }, 300);
            }

            handleSearchFocus(event) {
              const searchTerm = event.target.value.trim();

              if (searchTerm.length >= this.searchMinChars) {
                this.searchResults.classList.add('active');
              }
            }

            async performPredictiveSearch(searchTerm) {
              try {
                const response = await fetch(`/search/suggest.json?q=${encodeURIComponent(searchTerm)}&resources[type]=product`);
                const data = await response.json();

                this.renderSearchResults(data.resources.results.products);
              } catch (error) {
                console.error('Error performing predictive search:', error);
              }
            }

            renderSearchResults(products) {
              if (!products || products.length === 0) {
                this.searchResults.innerHTML = `
            <div class="ai-mobile-search__no-results-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p">
              No products found
            </div>
          `;
              } else {
                this.searchResults.innerHTML = products.slice(0, 5).map(product => `
            <div class="ai-mobile-search__result-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p">
              <a href="${product.url}" class="ai-mobile-search__result-link-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p">
                <img 
                  src="${product.image ? product.image : ''}" 
                  alt="${product.title}"
                  class="ai-mobile-search__result-image-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p"loading="lazy"onerror="this.style.display='none'"
                >
                <div class="ai-mobile-search__result-details-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p">
                  <h4 class="ai-mobile-search__result-title-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p">${product.title}</h4>
                  <div class="ai-mobile-search__result-price-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p">${product.price}</div>
                </div>
              </a>
            </div>
          `).join('');
              }

              this.searchResults.classList.add('active');
            }
          }

          customElements.define('mobile-navigation-an2xxstvlmkfwdfhezaigenblock975f4edce7h9p', MobileNavigationan2xxstvlmkfwdfhezaigenblock975f4edce7h9p);
        })();
      </script>



    </div>
    <div id="shopify-section-template--17996521046172__sale_banner_slider_gYAWg8"
      class="shopify-section padding-bottom">
      <style>
        .sale-banner-slider {
          overflow: hidden;
        }

        .sale-banner__pagination {
          display: flex;
          justify-content: center;
          padding-top: 18px;
        }
      </style>

      <div class="sale-banner-slider__wrap">
        <div class="container">
          <div class="sale-banner-slider">
            <div class="swiper-wrapper">


              <div class="sale-banner-slide swiper-slide">
                <a href="shop.php?category=sweekar">
                  <picture>
                    <source media="(max-width: 610px)" srcset="uploads/sweekarbannermobile2_v=1764252561.webp">
                    <img src="uploads/sweekarbannerdesktop2_v=1764252561.webp" loading="eager" alt="">
                  </picture>
                </a>
              </div>



              <div class="sale-banner-slide swiper-slide">
                <a href="#amira-long-grain-basmati-rice-5-kg">
                  <picture>
                    <source media="(max-width: 610px)" srcset="uploads/amirabannermobile_v=1764247928.webp">
                    <img src="uploads/amirabannerdesktop_v=1764247906.webp" loading="eager" alt="">
                  </picture>
                </a>
              </div>



              <div class="sale-banner-slide swiper-slide">
                <a href="#double-horse-jaggery-powder-600g">
                  <picture>
                    <source media="(max-width: 610px)" srcset="uploads/dhjaggery500ffmob_v=1763553759.webp">
                    <img src="uploads/DHjaggery50off_v=1763553759.webp" loading="eager" alt="">
                  </picture>
                </a>
              </div>



              <div class="sale-banner-slide swiper-slide">
                <a
                  href="shop.php?category=Patanjali">
                  <picture>
                    <source media="(max-width: 610px)" srcset="uploads/80_off_2_v=1758894950.png">
                    <img src="uploads/UPTO_70_OFF_8_v=1758894951.png" loading="eager" alt="">
                  </picture>
                </a>
              </div>



              <div class="sale-banner-slide swiper-slide">
                <a
                  href="shop.php?category=Double+Horse">
                  <picture>
                    <source media="(max-width: 610px)" srcset="uploads/hero_banner-MOBILE-3_v=1742469130.webp">
                    <img src="uploads/hero_banner-Desktop_a642ba2a-b00d-4009-ae32-29b36466fdaf_v=1742469130.webp"
                      loading="eager" alt="">
                  </picture>
                </a>
              </div>



              <div class="sale-banner-slide swiper-slide">
                <a
                  href="shop.php?category=Patanjali">
                  <picture>
                    <source media="(max-width: 610px)"
                      srcset="uploads/hero_banner-MOBILE-2_26e5142b-56d6-4fbb-98c6-a0b9d7724527_v=1742469130.webp">
                    <img src="uploads/hero_banner-Desktop-4_v=1742469130.webp" loading="eager" alt="">
                  </picture>
                </a>
              </div>



              <div class="sale-banner-slide swiper-slide">
                <a
                  href="shop.php?category=Kitchen+Treasures">
                  <picture>
                    <source media="(max-width: 610px)"
                      srcset="uploads/hero_banner-MOBILE_712d1b6f-8d64-4547-a094-2dd79e1621f9_v=1742469130.webp">
                    <img src="uploads/hero_banner-Desktop-2_45c69f9e-aaa1-45df-87ff-34b897692702_v=1742469131.webp"
                      loading="eager" alt="">
                  </picture>
                </a>
              </div>



              <div class="sale-banner-slide swiper-slide">
                <a
                  href="shop.php?category=Bikano">
                  <picture>
                    <source media="(max-width: 610px)"
                      srcset="uploads/hero_banner-MOBILE-1_758b7e4a-b294-419f-83e9-ab39ad298f23_v=1742469131.webp">
                    <img src="uploads/hero_banner-Desktop-3_v=1742469130.webp" loading="eager" alt="">
                  </picture>
                </a>
              </div>


            </div>

            <div class="sale-banner__pagination"></div>

          </div>
        </div>
      </div>

      <script>
        document.addEventListener('DOMContentLoaded', function () {
          const swiper = new Swiper('.sale-banner-slider', {
            autoplay: {
              delay: 2500,
              disableOnInteraction: true,
            },
            speed: 800,
            loop: true,
            spaceBetween: 18,
            slidesPerView: 1,
            slidesPerGroup: 1,
            slideShadows: true,
            pagination: {
              el: '.sale-banner__pagination',
              clickable: true,
            },
          });
        });
      </script>


    </div>
    <div id="shopify-section-template--17996521046172__categories_slider_eQ7CkB" class="shopify-section padding-bottom">
      <link href="categories-slider_v=28105661864545304061742289478.css" rel="stylesheet" type="text/css" media="all">

      <div class="category-slider__wrap">
        <div class="category-slider__container container">
          <div class="category-slider__header">
            <h3 class="category-slider__title">
              Categories
            </h3>

            <div class="category-slider__navs">
              <button class="category-slider__nav category-slider--prev">

                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 8 14" fill="none">
                  <path d="M6.99995 1C6.99995 1 1 5.4189 1 7C1 8.5812 7 13 7 13" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>

              </button>
              <button class="category-slider__nav category-slider--next">

                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 8 15" fill="none">
                  <path d="M1.00005 1.00002C1.00005 1.00002 7 5.5713 7 7.20692C7 8.84265 1 13.4138 1 13.4138"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>


              </button>
            </div>

          </div>
          <div class="category-slider__swiper">
            <div class="swiper-wrapper">


              <a class="category-slider__slide swiper-slide" href="shop.php?category=fresh-vegetables"
                style="background-color: #e4edd8;">
                <div class="category-slider__slide-img"
                  style="background-image: url(uploads/FRESH-VEGETABLES_553147aa-80f8-4d19-bf45-be57625ed1e6_v=1747988196.png);">
                </div>
                <h4 class="category-slider__slide-text">
                  Fresh Vegetables
                </h4>
              </a>



              <a class="category-slider__slide swiper-slide"
                href="shop.php?category=Maharaja Supermarket-shop-groceries-coffee-and-tea"
                style="background-color: #e4edd8;">
                <div class="category-slider__slide-img" style="background-image: url(uploads/Mask_group_1_v=1717325077.png);">
                </div>
                <h4 class="category-slider__slide-text">
                  Coffee & Tea
                </h4>
              </a>



              <a class="category-slider__slide swiper-slide" href="shop.php?category=Maharaja Supermarket-shop-groceries-oil"
                style="background-color: #e4edd8;">
                <div class="category-slider__slide-img" style="background-image: url(uploads/image_5_v=1717325068.png);">
                </div>
                <h4 class="category-slider__slide-text">
                  Cooking Oils
                </h4>
              </a>



              <a class="category-slider__slide swiper-slide"
                href="shop.php?category=Maharaja Supermarket-shop-groceries-groats-and-flour"
                style="background-color: #e4edd8;">
                <div class="category-slider__slide-img" style="background-image: url(uploads/image_6_v=1717325063.png);">
                </div>
                <h4 class="category-slider__slide-text">
                  Groats & Flour
                </h4>
              </a>



              <a class="category-slider__slide swiper-slide"
                href="shop.php?category=Maharaja Supermarket-shop-groceries-spices-and-herbs"
                style="background-color: #e4edd8;">
                <div class="category-slider__slide-img" style="background-image: url(uploads/image_10_v=1717325053.png);">
                </div>
                <h4 class="category-slider__slide-text">
                  Spices & Herbs
                </h4>
              </a>



              <a class="category-slider__slide swiper-slide" href="shop.php?category=default-category-snacks-and-savouries"
                style="background-color: #e4edd8;">
                <div class="category-slider__slide-img" style="background-image: url(uploads/Mask_group_3_v=1717325022.png);">
                </div>
                <h4 class="category-slider__slide-text">
                  Snacks & Savouries
                </h4>
              </a>



              <a class="category-slider__slide swiper-slide"
                href="shop.php?category=Maharaja Supermarket-shop-dietary-supplements" style="background-color: #e4edd8;">
                <div class="category-slider__slide-img" style="background-image: url(uploads/Mask_group_2_v=1717325059.png);">
                </div>
                <h4 class="category-slider__slide-text">
                  Dietary Supplements
                </h4>
              </a>



              <a class="category-slider__slide swiper-slide"
                href="shop.php?category=Maharaja Supermarket-shop-groceries-juices-and-nectars"
                style="background-color: #e4edd8;">
                <div class="category-slider__slide-img" style="background-image: url(uploads/image_9_v=1717325055.png);">
                </div>
                <h4 class="category-slider__slide-text">
                  Juices & Nectars
                </h4>
              </a>


            </div>
          </div>
        </div>
      </div>

      <script>
        document.addEventListener('DOMContentLoaded', function () {
          const swiper = new Swiper('.category-slider__swiper', {
            speed: 600,
            spaceBetween: 18,
            slidesPerView: 2,
            slidesPerGroup: 1,
            slideShadows: true,
            navigation: {
              nextEl: '.category-slider--next',
              prevEl: '.category-slider--prev',
            },
            breakpoints: {
              1200: {
                slidesPerView: 6,
                spaceBetween: 30,
              },
              998: {
                slidesPerView: 5,
                spaceBetween: 30,
              },
              768: {
                slidesPerView: 4,
                spaceBetween: 30,
              },
            },
          });
        });
      </script>


    </div>
    <div id="shopify-section-template--17996521046172__collection_slider_mXinzR" class="shopify-section">
      <style>
        .collection-slider__container {
          overflow: hidden;
        }

        .collection-slider__header {
          display: flex;
          flex-wrap: nowrap;
          justify-content: space-between;
          align-items: center;
          padding-bottom: 26px;
        }

        .collection-slider__swiper .collection-slide {
          max-width: 316px;
        }

        .collection-slider__swiper .collection-slide .product-card-inner.card-inner {
          height: 100%;
        }


        @media screen and (max-width: 767px) {
          .collection-slider__swiper .collection-slide {
            max-width: 265px;
          }
        }
      </style>

      <div class="collection-slider__wrap">
        <div class="collection-slider__container container padding-bottom">
          <div class="collection-slider__header">
            <h3 class="collection-slider__title">
              New Arrivals
            </h3>

            <a href="shop.php?category=Maharaja Supermarket-shop-new-products" class="btn btn--secondary btn--lg btn--arrow">
              Show more

              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round"></path>
                <path d="M15 17C15 17 20 13.3176 20 12C20 10.6824 15 7 15 7" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>

            </a>

          </div>
          <div class="collection-slider__swiper">
            <div class="swiper-wrapper">
              <?php
              $sql = "SELECT * FROM products WHERE is_active = 1 ORDER BY created_at DESC LIMIT 10";
              $result = mysqli_query($link, $sql);
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  $image_path = !empty($row['image']) ? 'uploads/' . $row['image'] : 'https://placehold.co/600x400';
                  ?>
                      <div class="collection-slide swiper-slide">
                        <div class="product-card-inner card-inner">
                          <div class="product-card-image card__media">
                            <a href="product.php?id=<?php echo $row['id']; ?>">
                              <img loading="lazy" src="<?php echo $image_path; ?>"
                                alt="<?php echo htmlspecialchars($row[get_col('title')]); ?>">
                            </a>
                          </div>
                          <div class="product-content">
                            <div class="product-content-top">
                              <h3 class="product-title">
                                <a href="product.php?id=<?php echo $row['id']; ?>">
                                  <?php echo htmlspecialchars($row[get_col('title')]); ?>
                                        </a>
                                      </h3>
                                    </div>
                                    <div class="product-content-bottom">
                                      <form method="post" action="cart_add.php">
                                        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <div class="product-card__bottom">
                                          <div class="price">
                                            <span class="money">Lei
                                              <?php echo number_format($row['price'], 2); ?> RON
                                            </span>
                                          </div>
                                          <button type="submit" class="btn btn--secondary product-form__submit">
                                            <span>Add to Cart</span>
                                          </button>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <?php
                }
              } else {
                echo '<p style="text-align: center; width: 100%; padding: 20px;">No products found.</p>';
              }
              ?>
            </div>
          </div>
        </div>
      </div>

      <script>
        document.addEventListener('DOMContentLoaded', function () {
          const swiper = new Swiper('.collection-slider__swiper', {
            speed: 400,
            spaceBetween: 18,
            slidesPerView: 'auto',
            slidesPerGroup: 1,
            slideShadows: true,
            breakpoints: {
              1200: {
                slidesPerView: 4,
                spaceBetween: 40,
              },
              767: {
                slidesPerView: 3,
              },
            },
          });
        });
      </script>


    </div>
    <div id="shopify-section-template--17996521046172__weekly_specials_QPGwDP" class="shopify-section padding-bottom">
      <link
        href="weekly-specials_v=37978517701195584171742289479.css"
        rel="stylesheet" type="text/css" media="all">

      <div class="weekly-specials__wrap">
        <div class="weekly-specials__container container">
          <h3 class="weekly-specials__title">
            Weekly Specials
          </h3>
          <div class="weekly-specials__slider">
            <div class="swiper-wrapper">


              <div class="weekly-specials__slide swiper-slide"
                style="background: linear-gradient(180deg, rgba(236, 191, 32, 0.9), rgba(197, 122, 9, 0.9) 100%);">

                <div class="weekly-specials__slide-logo"
                  style="background-image: url(amullogo2_v=1750158970.png);">
                </div>

                <h3 class="weekly-specials__slide-text">
                  Choose from our Dairy Products for Ghee and Paneer
                </h3>
                <div class="weekly-specials__slide-link">
                  <a href="shop.php?category=Maharaja Supermarket-shop-groceries-dairy-products"
                    class="btn btn--white btn--lg btn--arrow">
                    Shop Now

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                      <path d="M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                      <path d="M15 17C15 17 20 13.3176 20 12C20 10.6824 15 7 15 7" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>

                  </a>
                </div>
                <div class="weekly-specials__slide-featued-img">
                  <img src="uploads/amul500-removebg-preview_v=1750158971.png"
                    loading="lazy" alt="">
                </div>
              </div>



              <div class="weekly-specials__slide swiper-slide"
                style="background: linear-gradient(180deg, rgba(230, 11, 11, 0.8) 100%, rgba(138, 29, 29, 0.8) 100%);">

                <div class="weekly-specials__slide-logo"
                  style="background-image: url(image_54_v=1717308939.webp);">
                </div>

                <h3 class="weekly-specials__slide-text">
                  60% off on Bikano Papads!
                </h3>
                <div class="weekly-specials__slide-link">
                  <a href="shop.php?category=bikano" class="btn btn--white btn--lg btn--arrow">
                    Shop Now

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                      <path d="M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                      <path d="M15 17C15 17 20 13.3176 20 12C20 10.6824 15 7 15 7" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>

                  </a>
                </div>
                <div class="weekly-specials__slide-featued-img">
                  <img
                    src="uploads/papadamritsari-removebg-preview_v=1726485173.png"
                    loading="lazy" alt="">
                </div>
              </div>



              <div class="weekly-specials__slide swiper-slide"
                style="background: linear-gradient(310deg, rgba(112, 159, 61, 1), rgba(112, 159, 61, 1) 100%);">

                <div class="weekly-specials__slide-logo"
                  style="background-image: url(image_63_v=1717308939.webp);">
                </div>

                <h3 class="weekly-specials__slide-text">
                  Boost health naturally with Patanjali Ayurvedic supplements
                </h3>
                <div class="weekly-specials__slide-link">
                  <a href="shop.php?category=Maharaja Supermarket-shop-dietary-supplements"
                    class="btn btn--white btn--lg btn--arrow">
                    Shop Now

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                      <path d="M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                      <path d="M15 17C15 17 20 13.3176 20 12C20 10.6824 15 7 15 7" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>

                  </a>
                </div>
                <div class="weekly-specials__slide-featued-img">
                  <img src="uploads/pathajali_v=1726697467.png" loading="lazy"
                    alt="">
                </div>
              </div>


            </div>
          </div>
        </div>
      </div>

      <script>
        document.addEventListener('DOMContentLoaded', function () {
          const swiper = new Swiper('.weekly-specials__slider', {
            speed: 600,
            spaceBetween: 30,
            slidesPerView: 'auto',
            slidesPerGroup: 1,
            slideShadows: true,
            breakpoints: {
              768: {
                slidesPerView: 3,
              },
            },
          });
        });
      </script>


    </div>
    <div id="shopify-section-template--17996521046172__collection_slider_CHHC4j" class="shopify-section">
      <style>
        .collection-slider__container {
          overflow: hidden;
        }

        .collection-slider__header {
          display: flex;
          flex-wrap: nowrap;
          justify-content: space-between;
          align-items: center;
          padding-bottom: 26px;
        }

        .collection-slider__swiper .collection-slide {
          max-width: 316px;
        }

        .collection-slider__swiper .collection-slide .product-card-inner.card-inner {
          height: 100%;
        }


        @media screen and (max-width: 767px) {
          .collection-slider__swiper .collection-slide {
            max-width: 265px;
          }
        }
      </style>

      <div class="collection-slider__wrap">
        <div class="collection-slider__container container padding-bottom">
          <div class="collection-slider__header">
            <h3 class="collection-slider__title">
              Spice Blends and Masalas
            </h3>

            <a href="shop.php?category=Maharaja Supermarket-shop-groceries-spices-and-herbs"
              class="btn btn--secondary btn--lg btn--arrow">
              Show more

              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round"></path>
                <path d="M15 17C15 17 20 13.3176 20 12C20 10.6824 15 7 15 7" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>

            </a>

          </div>
          <div class="collection-slider__swiper">
            <div class="swiper-wrapper">

              <div class="collection-slide swiper-slide">
                <div class="product-card-inner card-inner">
                  <div id="pro-template--17996521046172__collection_slider_CHHC4j-8718968520860"
                    class="product-card-image card__media"><a href="#shan-chicken-masala-50g"
                      title="Shan Chicken Masala 50g" class="product__media-item"
                      data-media-id="template--17996521046172__collection_slider_CHHC4j-8718968520860-34917752176796"
                      tabindex="0">
                      <img loading="lazy" class=""
                        srcset="uploads/shan_chicken_masala_600x400_v=1765880636.webp"
                        alt="">
                    </a>
                    <div class="wish-lbl-wrp">

                      <div class="pro-wishlist">
                        <label>
                          <span class="wishlist-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                              fill="none">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.1335 2.95108C16.73 4.16664 16.9557 6.44579 15.6274 7.93897L8.99983 15.3894L2.37233 7.93977C1.04381 6.44646 1.26946 4.167 2.86616 2.95128C4.50032 1.70704 6.87275 2.10393 7.99225 3.80885L8.36782 4.38082C8.59267 4.72325 9.05847 4.82238 9.40821 4.60224C9.51777 4.53328 9.60294 4.44117 9.66134 4.33666L10.0076 3.80914C11.1268 2.10394 13.4993 1.70679 15.1335 2.95108ZM8.99998 2.653C7.31724 0.526225 4.15516 0.102335 1.94184 1.78754C-0.33726 3.52284 -0.659353 6.77651 1.23696 8.90805L8.4334 16.9972C8.7065 17.3041 9.18204 17.3362 9.49557 17.0688C9.53631 17.0341 9.57231 16.996 9.60351 16.9553L16.7628 8.90721C18.6589 6.77579 18.3367 3.52246 16.0579 1.78734C13.8446 0.102142 10.6825 0.526185 8.99998 2.653Z"
                                fill=" #4F4632"></path>
                            </svg>
                          </span>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="shan-chicken-masala-50g"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="pro-compare">
                        <label>
                          <span class="compare-label">
                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M9.80006 12.5C9.66163 12.5 9.52632 12.4585 9.41123 12.3809C9.29614 12.3033 9.20644 12.193 9.15347 12.0639C9.1005 11.9349 9.08664 11.7928 9.11364 11.6558C9.14064 11.5188 9.20728 11.393 9.30515 11.2942L11.6103 8.96804H2.79991C2.61426 8.96804 2.4362 8.89361 2.30493 8.76114C2.17365 8.62866 2.0999 8.44899 2.0999 8.26164C2.0999 8.0743 2.17365 7.89462 2.30493 7.76215C2.4362 7.62967 2.61426 7.55525 2.79991 7.55525H13.3001C13.4386 7.55528 13.5739 7.59672 13.689 7.67435C13.8041 7.75197 13.8938 7.86228 13.9467 7.99134C13.9997 8.1204 14.0136 8.2624 13.9866 8.39941C13.9596 8.53642 13.8929 8.66227 13.795 8.76106L10.295 12.293C10.1637 12.4255 9.9857 12.5 9.80006 12.5ZM11.9001 4.72968C11.9001 4.54233 11.8264 4.36266 11.6951 4.23018C11.5638 4.09771 11.3857 4.02328 11.2001 4.02328H2.3897L4.69485 1.69713C4.82236 1.56391 4.89292 1.38547 4.89133 1.20025C4.88973 1.01504 4.81611 0.837869 4.68632 0.706898C4.55654 0.575927 4.38096 0.501636 4.19742 0.500027C4.01388 0.498417 3.83705 0.569618 3.70503 0.698293L0.204955 4.23026C0.107087 4.32905 0.0404406 4.4549 0.0134427 4.59191C-0.0135551 4.72892 0.000307272 4.87092 0.0532774 4.99998C0.106248 5.12904 0.195947 5.23935 0.311036 5.31697C0.426126 5.3946 0.561438 5.43604 0.699866 5.43607H11.2001C11.3857 5.43607 11.5638 5.36165 11.6951 5.22917C11.8264 5.0967 11.9001 4.91703 11.9001 4.72968Z"
                                fill="#4F4632"></path>
                            </svg>
                          </span>
                          <a class="compare-now" href="/pages/compare" style="display:none;"> Compare Now </a>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="shan-chicken-masala-50g"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="quickview-btn" id="quickview">
                        <a style="text-decoration:none" href="#shan-chicken-masala-50g"
                          data-handle="shan-chicken-masala-50g">
                          <svg width="14" height="11" viewBox="0 0 14 11" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M6.99996 3.15912C5.70988 3.15912 4.66016 4.20885 4.66016 5.49892C4.66016 6.789 5.70988 7.83873 6.99996 7.83873C8.29004 7.83873 9.33977 6.789 9.33977 5.49892C9.33977 4.20885 8.29004 3.15912 6.99996 3.15912ZM6.99996 6.8724C6.24254 6.8724 5.62648 6.25635 5.62648 5.49892C5.62648 4.7415 6.24254 4.12545 6.99996 4.12545C7.75738 4.12545 8.37344 4.7415 8.37344 5.49892C8.37344 6.25635 7.75738 6.8724 6.99996 6.8724Z"
                              fill="#4F4632"></path>
                            <path
                              d="M13.4184 4.21786C13.1537 3.8509 12.6889 3.28735 11.9785 2.68715C11.2954 2.10993 10.561 1.64782 9.79562 1.31368C8.87633 0.912544 7.9357 0.709106 7 0.709106C6.0643 0.709106 5.12367 0.912544 4.2041 1.31368C3.43875 1.64754 2.7043 2.10965 2.02125 2.68715C1.31086 3.28762 0.846016 3.8509 0.581328 4.21786C0.195781 4.7527 0 5.18418 0 5.5C0 5.81582 0.195508 6.24731 0.581602 6.78215C0.846289 7.14911 1.31113 7.71266 2.02152 8.31286C2.70457 8.89008 3.43902 9.35219 4.20437 9.68633C5.12367 10.0875 6.06457 10.2909 7.00027 10.2909C7.93598 10.2909 8.8766 10.0875 9.79617 9.68633C10.5615 9.35247 11.296 8.89036 11.979 8.31286C12.6894 7.71239 13.1543 7.14911 13.4189 6.78215C13.8045 6.24731 14 5.81582 14 5.5C14 5.18418 13.8045 4.7527 13.4184 4.21786ZM11.293 7.62653C10.3592 8.40118 8.85637 9.32457 7 9.32457C5.14363 9.32457 3.64109 8.40118 2.70703 7.62653C1.56406 6.67852 1.00816 5.73625 0.967422 5.5C1.00789 5.26375 1.56406 4.32149 2.70703 3.37348C3.64082 2.59883 5.14363 1.67543 7 1.67543C8.85609 1.67543 10.3589 2.59883 11.293 3.37348C12.4359 4.32149 12.9921 5.26375 13.0326 5.5C12.9918 5.73625 12.4359 6.67852 11.293 7.62653Z"
                              fill="#4F4632"></path>
                          </svg>
                        </a>
                      </div>

                    </div>

                  </div>
                  <div id="ProductInfo-template--17996521046172__collection_slider_CHHC4j" class="product-content">
                    <div class="product-content-top">

                      <div class="product-type">Spice Mixes</div>

                      <h3 class="product-title">
                        <a href="#shan-chicken-masala-50g">Shan Chicken Masala 50g</a>
                      </h3>

                      <!-- Start of Judge.me code -->
                      <div class="jdgm-widget jdgm-preview-badge">
                        <div style="display:none" class="jdgm-prev-badge" data-average-rating="0.00"
                          data-number-of-reviews="0" data-number-of-questions="0"> <span class="jdgm-prev-badge__stars"
                            data-score="0.00" tabindex="0" aria-label="0.00 stars" role="button"> <span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span> </span> <span class="jdgm-prev-badge__text"> No
                            reviews </span> </div>
                      </div>
                      <!-- End of Judge.me code -->

                    </div>
                    <div id="ProductInfo-template--17996521046172__collection_slider_CHHC4j-8718968520860"
                      class="product-content-bottom">
                      <div class="product-selectors">


                      </div>
                      <product-form class="product-form">
                        <div class="wbquicksuccess hidden" hidden="">Translation missing:
                          en.wbcustomlabel.wballtext.quicksuccessmsg</div>
                        <div class="product-form__error-message-wrapper" role="alert" hidden="">
                          <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-error"
                            viewBox="0 0 13 13" width="25" height="25">
                            <circle cx="6.5" cy="6.50049" r="5.5" stroke="white" stroke-width="2"></circle>
                            <circle cx="6.5" cy="6.5" r="5.5" fill="#EB001B" stroke="#EB001B" stroke-width="0.7">
                            </circle>
                            <path
                              d="M5.87413 3.52832L5.97439 7.57216H7.02713L7.12739 3.52832H5.87413ZM6.50076 9.66091C6.88091 9.66091 7.18169 9.37267 7.18169 9.00504C7.18169 8.63742 6.88091 8.34917 6.50076 8.34917C6.12061 8.34917 5.81982 8.63742 5.81982 9.00504C5.81982 9.37267 6.12061 9.66091 6.50076 9.66091Z"
                              fill="white"></path>
                            <path
                              d="M5.87413 3.17832H5.51535L5.52424 3.537L5.6245 7.58083L5.63296 7.92216H5.97439H7.02713H7.36856L7.37702 7.58083L7.47728 3.537L7.48617 3.17832H7.12739H5.87413ZM6.50076 10.0109C7.06121 10.0109 7.5317 9.57872 7.5317 9.00504C7.5317 8.43137 7.06121 7.99918 6.50076 7.99918C5.94031 7.99918 5.46982 8.43137 5.46982 9.00504C5.46982 9.57872 5.94031 10.0109 6.50076 10.0109Z"
                              fill="white" stroke="#EB001B" stroke-width="0.7">
                            </path>
                          </svg>
                          <span class="product-form__error-message"></span>
                        </div>
                        <form method="post" action="cart_add.php"
                          id="product-form-template--17996521046172__collection_slider_CHHC4j-8718968520860"
                          accept-charset="UTF-8" class="form" enctype="multipart/form-data" novalidate="novalidate"
                          data-type="add-to-cart-form"><input type="hidden" name="form_type" value="product"><input
                            type="hidden" name="utf8" value="✓"><input type="hidden" name="id" value="45812856160412"
                            disabled="">
                          <div class="product-card__bottom">
                            <div class="no-js-hidden price"
                              id="price-template--17996521046172__collection_slider_CHHC4j-8718968520860" role="status">

                              <ins class="price-item--regular"><span class="money"> Lei4.99</span></ins>






                            </div>
                            <button type="submit" name="add" class="btn btn--secondary product-form__submit"
                              aria-label="Add to Cart"><span>Add to Cart</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"
                                fill="none">
                                <path
                                  d="M3.22708 14.1828L2.22412 8.19984C2.07247 7.29523 1.99665 6.84293 2.23945 6.54647C2.48226 6.25 2.92852 6.25 3.82104 6.25H16.1783C17.0708 6.25 17.5171 6.25 17.7599 6.54647C18.0027 6.84293 17.9268 7.29523 17.7753 8.19984L16.7723 14.1828C16.4398 16.1659 16.2736 17.1574 15.5949 17.7454C14.9163 18.3333 13.938 18.3333 11.9815 18.3333H8.01786C6.06131 18.3333 5.08303 18.3333 4.40438 17.7454C3.72573 17.1574 3.55952 16.1659 3.22708 14.1828Z"
                                  stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                  d="M14.5837 6.25008C14.5837 3.71877 12.5317 1.66675 10.0003 1.66675C7.46902 1.66675 5.41699 3.71877 5.41699 6.25008"
                                  stroke="currentColor" stroke-width="1.5"></path>
                              </svg>

                              <div class="loading-overlay__spinner hidden">

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                  version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 511.494 511.494"
                                  style="enable-background:new 0 0 511.494 511.494;" xml:space="preserve" width="20"
                                  height="20">
                                  <g>
                                    <path
                                      d="M478.291,255.492c-16.133,0.143-29.689,12.161-31.765,28.16c-15.37,105.014-112.961,177.685-217.975,162.315 S50.866,333.006,66.236,227.992S179.197,50.307,284.211,65.677c35.796,5.239,69.386,20.476,96.907,43.959l-24.107,24.107   c-8.33,8.332-8.328,21.84,0.004,30.17c4.015,4.014,9.465,6.262,15.142,6.246h97.835c11.782,0,21.333-9.551,21.333-21.333V50.991   c-0.003-11.782-9.556-21.331-21.338-21.329c-5.655,0.001-11.079,2.248-15.078,6.246l-28.416,28.416   C320.774-29.34,159.141-19.568,65.476,86.152S-18.415,353.505,87.304,447.17s267.353,83.892,361.017-21.828   c32.972-37.216,54.381-83.237,61.607-132.431c2.828-17.612-9.157-34.183-26.769-37.011   C481.549,255.641,479.922,255.505,478.291,255.492z">
                                    </path>
                                  </g>
                                </svg>

                              </div>
                            </button>
                          </div><input type="hidden" name="product-id" value="8718968520860"><input type="hidden"
                            name="section-id" value="template--17996521046172__collection_slider_CHHC4j">
                        </form>
                      </product-form>
                    </div>
                  </div>
                </div>

              </div>

              <div class="collection-slide swiper-slide">
                <div class="product-card-inner card-inner">
                  <div id="pro-template--17996521046172__collection_slider_CHHC4j-8446921244828"
                    class="product-card-image card__media"><a href="#shan-paya-50g" title="Shan Paya 50g"
                      class="product__media-item"
                      data-media-id="template--17996521046172__collection_slider_CHHC4j-8446921244828-33639952908444"
                      tabindex="0">
                      <img loading="lazy" class=""
                        srcset="uploads/71mYVSXS8TL._AC_UF1000_1000_QL80_c688df58-4fbc-48e6-a623-0475842def9c_600x400_v=1749653479.webp"
                        alt="">
                    </a>
                    <div class="wish-lbl-wrp">

                      <div class="pro-wishlist">
                        <label>
                          <span class="wishlist-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                              fill="none">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.1335 2.95108C16.73 4.16664 16.9557 6.44579 15.6274 7.93897L8.99983 15.3894L2.37233 7.93977C1.04381 6.44646 1.26946 4.167 2.86616 2.95128C4.50032 1.70704 6.87275 2.10393 7.99225 3.80885L8.36782 4.38082C8.59267 4.72325 9.05847 4.82238 9.40821 4.60224C9.51777 4.53328 9.60294 4.44117 9.66134 4.33666L10.0076 3.80914C11.1268 2.10394 13.4993 1.70679 15.1335 2.95108ZM8.99998 2.653C7.31724 0.526225 4.15516 0.102335 1.94184 1.78754C-0.33726 3.52284 -0.659353 6.77651 1.23696 8.90805L8.4334 16.9972C8.7065 17.3041 9.18204 17.3362 9.49557 17.0688C9.53631 17.0341 9.57231 16.996 9.60351 16.9553L16.7628 8.90721C18.6589 6.77579 18.3367 3.52246 16.0579 1.78734C13.8446 0.102142 10.6825 0.526185 8.99998 2.653Z"
                                fill=" #4F4632"></path>
                            </svg>
                          </span>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="shan-paya-50g"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="pro-compare">
                        <label>
                          <span class="compare-label">
                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M9.80006 12.5C9.66163 12.5 9.52632 12.4585 9.41123 12.3809C9.29614 12.3033 9.20644 12.193 9.15347 12.0639C9.1005 11.9349 9.08664 11.7928 9.11364 11.6558C9.14064 11.5188 9.20728 11.393 9.30515 11.2942L11.6103 8.96804H2.79991C2.61426 8.96804 2.4362 8.89361 2.30493 8.76114C2.17365 8.62866 2.0999 8.44899 2.0999 8.26164C2.0999 8.0743 2.17365 7.89462 2.30493 7.76215C2.4362 7.62967 2.61426 7.55525 2.79991 7.55525H13.3001C13.4386 7.55528 13.5739 7.59672 13.689 7.67435C13.8041 7.75197 13.8938 7.86228 13.9467 7.99134C13.9997 8.1204 14.0136 8.2624 13.9866 8.39941C13.9596 8.53642 13.8929 8.66227 13.795 8.76106L10.295 12.293C10.1637 12.4255 9.9857 12.5 9.80006 12.5ZM11.9001 4.72968C11.9001 4.54233 11.8264 4.36266 11.6951 4.23018C11.5638 4.09771 11.3857 4.02328 11.2001 4.02328H2.3897L4.69485 1.69713C4.82236 1.56391 4.89292 1.38547 4.89133 1.20025C4.88973 1.01504 4.81611 0.837869 4.68632 0.706898C4.55654 0.575927 4.38096 0.501636 4.19742 0.500027C4.01388 0.498417 3.83705 0.569618 3.70503 0.698293L0.204955 4.23026C0.107087 4.32905 0.0404406 4.4549 0.0134427 4.59191C-0.0135551 4.72892 0.000307272 4.87092 0.0532774 4.99998C0.106248 5.12904 0.195947 5.23935 0.311036 5.31697C0.426126 5.3946 0.561438 5.43604 0.699866 5.43607H11.2001C11.3857 5.43607 11.5638 5.36165 11.6951 5.22917C11.8264 5.0967 11.9001 4.91703 11.9001 4.72968Z"
                                fill="#4F4632"></path>
                            </svg>
                          </span>
                          <a class="compare-now" href="/pages/compare" style="display:none;"> Compare Now </a>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="shan-paya-50g"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="quickview-btn" id="quickview">
                        <a style="text-decoration:none" href="#shan-paya-50g" data-handle="shan-paya-50g">
                          <svg width="14" height="11" viewBox="0 0 14 11" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M6.99996 3.15912C5.70988 3.15912 4.66016 4.20885 4.66016 5.49892C4.66016 6.789 5.70988 7.83873 6.99996 7.83873C8.29004 7.83873 9.33977 6.789 9.33977 5.49892C9.33977 4.20885 8.29004 3.15912 6.99996 3.15912ZM6.99996 6.8724C6.24254 6.8724 5.62648 6.25635 5.62648 5.49892C5.62648 4.7415 6.24254 4.12545 6.99996 4.12545C7.75738 4.12545 8.37344 4.7415 8.37344 5.49892C8.37344 6.25635 7.75738 6.8724 6.99996 6.8724Z"
                              fill="#4F4632"></path>
                            <path
                              d="M13.4184 4.21786C13.1537 3.8509 12.6889 3.28735 11.9785 2.68715C11.2954 2.10993 10.561 1.64782 9.79562 1.31368C8.87633 0.912544 7.9357 0.709106 7 0.709106C6.0643 0.709106 5.12367 0.912544 4.2041 1.31368C3.43875 1.64754 2.7043 2.10965 2.02125 2.68715C1.31086 3.28762 0.846016 3.8509 0.581328 4.21786C0.195781 4.7527 0 5.18418 0 5.5C0 5.81582 0.195508 6.24731 0.581602 6.78215C0.846289 7.14911 1.31113 7.71266 2.02152 8.31286C2.70457 8.89008 3.43902 9.35219 4.20437 9.68633C5.12367 10.0875 6.06457 10.2909 7.00027 10.2909C7.93598 10.2909 8.8766 10.0875 9.79617 9.68633C10.5615 9.35247 11.296 8.89036 11.979 8.31286C12.6894 7.71239 13.1543 7.14911 13.4189 6.78215C13.8045 6.24731 14 5.81582 14 5.5C14 5.18418 13.8045 4.7527 13.4184 4.21786ZM11.293 7.62653C10.3592 8.40118 8.85637 9.32457 7 9.32457C5.14363 9.32457 3.64109 8.40118 2.70703 7.62653C1.56406 6.67852 1.00816 5.73625 0.967422 5.5C1.00789 5.26375 1.56406 4.32149 2.70703 3.37348C3.64082 2.59883 5.14363 1.67543 7 1.67543C8.85609 1.67543 10.3589 2.59883 11.293 3.37348C12.4359 4.32149 12.9921 5.26375 13.0326 5.5C12.9918 5.73625 12.4359 6.67852 11.293 7.62653Z"
                              fill="#4F4632"></path>
                          </svg>
                        </a>
                      </div>

                    </div>

                  </div>
                  <div id="ProductInfo-template--17996521046172__collection_slider_CHHC4j" class="product-content">
                    <div class="product-content-top">

                      <div class="product-type">Spice Mixes</div>

                      <h3 class="product-title">
                        <a href="#shan-paya-50g">Shan Paya 50g</a>
                      </h3>

                      <!-- Start of Judge.me code -->
                      <div class="jdgm-widget jdgm-preview-badge">
                        <div style="display:none" class="jdgm-prev-badge" data-average-rating="0.00"
                          data-number-of-reviews="0" data-number-of-questions="0"> <span class="jdgm-prev-badge__stars"
                            data-score="0.00" tabindex="0" aria-label="0.00 stars" role="button"> <span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span> </span> <span class="jdgm-prev-badge__text"> No
                            reviews </span> </div>
                      </div>
                      <!-- End of Judge.me code -->

                    </div>
                    <div id="ProductInfo-template--17996521046172__collection_slider_CHHC4j-8446921244828"
                      class="product-content-bottom">
                      <div class="product-selectors">


                      </div>
                      <product-form class="product-form">
                        <div class="wbquicksuccess hidden" hidden="">Translation missing:
                          en.wbcustomlabel.wballtext.quicksuccessmsg</div>
                        <div class="product-form__error-message-wrapper" role="alert" hidden="">
                          <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-error"
                            viewBox="0 0 13 13" width="25" height="25">
                            <circle cx="6.5" cy="6.50049" r="5.5" stroke="white" stroke-width="2"></circle>
                            <circle cx="6.5" cy="6.5" r="5.5" fill="#EB001B" stroke="#EB001B" stroke-width="0.7">
                            </circle>
                            <path
                              d="M5.87413 3.52832L5.97439 7.57216H7.02713L7.12739 3.52832H5.87413ZM6.50076 9.66091C6.88091 9.66091 7.18169 9.37267 7.18169 9.00504C7.18169 8.63742 6.88091 8.34917 6.50076 8.34917C6.12061 8.34917 5.81982 8.63742 5.81982 9.00504C5.81982 9.37267 6.12061 9.66091 6.50076 9.66091Z"
                              fill="white"></path>
                            <path
                              d="M5.87413 3.17832H5.51535L5.52424 3.537L5.6245 7.58083L5.63296 7.92216H5.97439H7.02713H7.36856L7.37702 7.58083L7.47728 3.537L7.48617 3.17832H7.12739H5.87413ZM6.50076 10.0109C7.06121 10.0109 7.5317 9.57872 7.5317 9.00504C7.5317 8.43137 7.06121 7.99918 6.50076 7.99918C5.94031 7.99918 5.46982 8.43137 5.46982 9.00504C5.46982 9.57872 5.94031 10.0109 6.50076 10.0109Z"
                              fill="white" stroke="#EB001B" stroke-width="0.7">
                            </path>
                          </svg>
                          <span class="product-form__error-message"></span>
                        </div>
                        <form method="post" action="cart_add.php"
                          id="product-form-template--17996521046172__collection_slider_CHHC4j-8446921244828"
                          accept-charset="UTF-8" class="form" enctype="multipart/form-data" novalidate="novalidate"
                          data-type="add-to-cart-form"><input type="hidden" name="form_type" value="product"><input
                            type="hidden" name="utf8" value="✓"><input type="hidden" name="id" value="45040274604188"
                            disabled="">
                          <div class="product-card__bottom">
                            <div class="no-js-hidden price"
                              id="price-template--17996521046172__collection_slider_CHHC4j-8446921244828" role="status">

                              <ins class="price-item--regular"><span class="money"> Lei5.00</span></ins>






                            </div>
                            <button type="submit" name="add" class="btn btn--secondary product-form__submit"
                              aria-label="Add to Cart"><span>Add to Cart</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"
                                fill="none">
                                <path
                                  d="M3.22708 14.1828L2.22412 8.19984C2.07247 7.29523 1.99665 6.84293 2.23945 6.54647C2.48226 6.25 2.92852 6.25 3.82104 6.25H16.1783C17.0708 6.25 17.5171 6.25 17.7599 6.54647C18.0027 6.84293 17.9268 7.29523 17.7753 8.19984L16.7723 14.1828C16.4398 16.1659 16.2736 17.1574 15.5949 17.7454C14.9163 18.3333 13.938 18.3333 11.9815 18.3333H8.01786C6.06131 18.3333 5.08303 18.3333 4.40438 17.7454C3.72573 17.1574 3.55952 16.1659 3.22708 14.1828Z"
                                  stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                  d="M14.5837 6.25008C14.5837 3.71877 12.5317 1.66675 10.0003 1.66675C7.46902 1.66675 5.41699 3.71877 5.41699 6.25008"
                                  stroke="currentColor" stroke-width="1.5"></path>
                              </svg>

                              <div class="loading-overlay__spinner hidden">

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                  version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 511.494 511.494"
                                  style="enable-background:new 0 0 511.494 511.494;" xml:space="preserve" width="20"
                                  height="20">
                                  <g>
                                    <path
                                      d="M478.291,255.492c-16.133,0.143-29.689,12.161-31.765,28.16c-15.37,105.014-112.961,177.685-217.975,162.315 S50.866,333.006,66.236,227.992S179.197,50.307,284.211,65.677c35.796,5.239,69.386,20.476,96.907,43.959l-24.107,24.107   c-8.33,8.332-8.328,21.84,0.004,30.17c4.015,4.014,9.465,6.262,15.142,6.246h97.835c11.782,0,21.333-9.551,21.333-21.333V50.991   c-0.003-11.782-9.556-21.331-21.338-21.329c-5.655,0.001-11.079,2.248-15.078,6.246l-28.416,28.416   C320.774-29.34,159.141-19.568,65.476,86.152S-18.415,353.505,87.304,447.17s267.353,83.892,361.017-21.828   c32.972-37.216,54.381-83.237,61.607-132.431c2.828-17.612-9.157-34.183-26.769-37.011   C481.549,255.641,479.922,255.505,478.291,255.492z">
                                    </path>
                                  </g>
                                </svg>

                              </div>
                            </button>
                          </div><input type="hidden" name="product-id" value="8446921244828"><input type="hidden"
                            name="section-id" value="template--17996521046172__collection_slider_CHHC4j">
                        </form>
                      </product-form>
                    </div>
                  </div>
                </div>

              </div>

              <div class="collection-slide swiper-slide">
                <div class="product-card-inner card-inner">
                  <div id="pro-template--17996521046172__collection_slider_CHHC4j-8446921343132"
                    class="product-card-image card__media"><a href="#shan-bihari-kabab-50g"
                      title="Shan Bihari Kabab 50g" class="product__media-item"
                      data-media-id="template--17996521046172__collection_slider_CHHC4j-8446921343132-33639953236124"
                      tabindex="0">
                      <img loading="lazy" class=""
                        srcset="uploads/bihari_becb275f-32fc-4d96-af57-cf5c77309e6f_600x400_v=1749653486.webp"
                        alt="">
                    </a>
                    <div class="wish-lbl-wrp">

                      <div class="pro-wishlist">
                        <label>
                          <span class="wishlist-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                              fill="none">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.1335 2.95108C16.73 4.16664 16.9557 6.44579 15.6274 7.93897L8.99983 15.3894L2.37233 7.93977C1.04381 6.44646 1.26946 4.167 2.86616 2.95128C4.50032 1.70704 6.87275 2.10393 7.99225 3.80885L8.36782 4.38082C8.59267 4.72325 9.05847 4.82238 9.40821 4.60224C9.51777 4.53328 9.60294 4.44117 9.66134 4.33666L10.0076 3.80914C11.1268 2.10394 13.4993 1.70679 15.1335 2.95108ZM8.99998 2.653C7.31724 0.526225 4.15516 0.102335 1.94184 1.78754C-0.33726 3.52284 -0.659353 6.77651 1.23696 8.90805L8.4334 16.9972C8.7065 17.3041 9.18204 17.3362 9.49557 17.0688C9.53631 17.0341 9.57231 16.996 9.60351 16.9553L16.7628 8.90721C18.6589 6.77579 18.3367 3.52246 16.0579 1.78734C13.8446 0.102142 10.6825 0.526185 8.99998 2.653Z"
                                fill=" #4F4632"></path>
                            </svg>
                          </span>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="shan-bihari-kabab-50g"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="pro-compare">
                        <label>
                          <span class="compare-label">
                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M9.80006 12.5C9.66163 12.5 9.52632 12.4585 9.41123 12.3809C9.29614 12.3033 9.20644 12.193 9.15347 12.0639C9.1005 11.9349 9.08664 11.7928 9.11364 11.6558C9.14064 11.5188 9.20728 11.393 9.30515 11.2942L11.6103 8.96804H2.79991C2.61426 8.96804 2.4362 8.89361 2.30493 8.76114C2.17365 8.62866 2.0999 8.44899 2.0999 8.26164C2.0999 8.0743 2.17365 7.89462 2.30493 7.76215C2.4362 7.62967 2.61426 7.55525 2.79991 7.55525H13.3001C13.4386 7.55528 13.5739 7.59672 13.689 7.67435C13.8041 7.75197 13.8938 7.86228 13.9467 7.99134C13.9997 8.1204 14.0136 8.2624 13.9866 8.39941C13.9596 8.53642 13.8929 8.66227 13.795 8.76106L10.295 12.293C10.1637 12.4255 9.9857 12.5 9.80006 12.5ZM11.9001 4.72968C11.9001 4.54233 11.8264 4.36266 11.6951 4.23018C11.5638 4.09771 11.3857 4.02328 11.2001 4.02328H2.3897L4.69485 1.69713C4.82236 1.56391 4.89292 1.38547 4.89133 1.20025C4.88973 1.01504 4.81611 0.837869 4.68632 0.706898C4.55654 0.575927 4.38096 0.501636 4.19742 0.500027C4.01388 0.498417 3.83705 0.569618 3.70503 0.698293L0.204955 4.23026C0.107087 4.32905 0.0404406 4.4549 0.0134427 4.59191C-0.0135551 4.72892 0.000307272 4.87092 0.0532774 4.99998C0.106248 5.12904 0.195947 5.23935 0.311036 5.31697C0.426126 5.3946 0.561438 5.43604 0.699866 5.43607H11.2001C11.3857 5.43607 11.5638 5.36165 11.6951 5.22917C11.8264 5.0967 11.9001 4.91703 11.9001 4.72968Z"
                                fill="#4F4632"></path>
                            </svg>
                          </span>
                          <a class="compare-now" href="/pages/compare" style="display:none;"> Compare Now </a>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="shan-bihari-kabab-50g"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="quickview-btn" id="quickview">
                        <a style="text-decoration:none" href="#shan-bihari-kabab-50g"
                          data-handle="shan-bihari-kabab-50g">
                          <svg width="14" height="11" viewBox="0 0 14 11" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M6.99996 3.15912C5.70988 3.15912 4.66016 4.20885 4.66016 5.49892C4.66016 6.789 5.70988 7.83873 6.99996 7.83873C8.29004 7.83873 9.33977 6.789 9.33977 5.49892C9.33977 4.20885 8.29004 3.15912 6.99996 3.15912ZM6.99996 6.8724C6.24254 6.8724 5.62648 6.25635 5.62648 5.49892C5.62648 4.7415 6.24254 4.12545 6.99996 4.12545C7.75738 4.12545 8.37344 4.7415 8.37344 5.49892C8.37344 6.25635 7.75738 6.8724 6.99996 6.8724Z"
                              fill="#4F4632"></path>
                            <path
                              d="M13.4184 4.21786C13.1537 3.8509 12.6889 3.28735 11.9785 2.68715C11.2954 2.10993 10.561 1.64782 9.79562 1.31368C8.87633 0.912544 7.9357 0.709106 7 0.709106C6.0643 0.709106 5.12367 0.912544 4.2041 1.31368C3.43875 1.64754 2.7043 2.10965 2.02125 2.68715C1.31086 3.28762 0.846016 3.8509 0.581328 4.21786C0.195781 4.7527 0 5.18418 0 5.5C0 5.81582 0.195508 6.24731 0.581602 6.78215C0.846289 7.14911 1.31113 7.71266 2.02152 8.31286C2.70457 8.89008 3.43902 9.35219 4.20437 9.68633C5.12367 10.0875 6.06457 10.2909 7.00027 10.2909C7.93598 10.2909 8.8766 10.0875 9.79617 9.68633C10.5615 9.35247 11.296 8.89036 11.979 8.31286C12.6894 7.71239 13.1543 7.14911 13.4189 6.78215C13.8045 6.24731 14 5.81582 14 5.5C14 5.18418 13.8045 4.7527 13.4184 4.21786ZM11.293 7.62653C10.3592 8.40118 8.85637 9.32457 7 9.32457C5.14363 9.32457 3.64109 8.40118 2.70703 7.62653C1.56406 6.67852 1.00816 5.73625 0.967422 5.5C1.00789 5.26375 1.56406 4.32149 2.70703 3.37348C3.64082 2.59883 5.14363 1.67543 7 1.67543C8.85609 1.67543 10.3589 2.59883 11.293 3.37348C12.4359 4.32149 12.9921 5.26375 13.0326 5.5C12.9918 5.73625 12.4359 6.67852 11.293 7.62653Z"
                              fill="#4F4632"></path>
                          </svg>
                        </a>
                      </div>

                    </div>

                  </div>
                  <div id="ProductInfo-template--17996521046172__collection_slider_CHHC4j" class="product-content">
                    <div class="product-content-top">

                      <div class="product-type">Spice Mixes</div>

                      <h3 class="product-title">
                        <a href="#shan-bihari-kabab-50g">Shan Bihari Kabab 50g</a>
                      </h3>

                      <!-- Start of Judge.me code -->
                      <div class="jdgm-widget jdgm-preview-badge">
                        <div style="display:none" class="jdgm-prev-badge" data-average-rating="0.00"
                          data-number-of-reviews="0" data-number-of-questions="0"> <span class="jdgm-prev-badge__stars"
                            data-score="0.00" tabindex="0" aria-label="0.00 stars" role="button"> <span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span> </span> <span class="jdgm-prev-badge__text"> No
                            reviews </span> </div>
                      </div>
                      <!-- End of Judge.me code -->

                    </div>
                    <div id="ProductInfo-template--17996521046172__collection_slider_CHHC4j-8446921343132"
                      class="product-content-bottom">
                      <div class="product-selectors">


                      </div>
                      <product-form class="product-form">
                        <div class="wbquicksuccess hidden" hidden="">Translation missing:
                          en.wbcustomlabel.wballtext.quicksuccessmsg</div>
                        <div class="product-form__error-message-wrapper" role="alert" hidden="">
                          <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-error"
                            viewBox="0 0 13 13" width="25" height="25">
                            <circle cx="6.5" cy="6.50049" r="5.5" stroke="white" stroke-width="2"></circle>
                            <circle cx="6.5" cy="6.5" r="5.5" fill="#EB001B" stroke="#EB001B" stroke-width="0.7">
                            </circle>
                            <path
                              d="M5.87413 3.52832L5.97439 7.57216H7.02713L7.12739 3.52832H5.87413ZM6.50076 9.66091C6.88091 9.66091 7.18169 9.37267 7.18169 9.00504C7.18169 8.63742 6.88091 8.34917 6.50076 8.34917C6.12061 8.34917 5.81982 8.63742 5.81982 9.00504C5.81982 9.37267 6.12061 9.66091 6.50076 9.66091Z"
                              fill="white"></path>
                            <path
                              d="M5.87413 3.17832H5.51535L5.52424 3.537L5.6245 7.58083L5.63296 7.92216H5.97439H7.02713H7.36856L7.37702 7.58083L7.47728 3.537L7.48617 3.17832H7.12739H5.87413ZM6.50076 10.0109C7.06121 10.0109 7.5317 9.57872 7.5317 9.00504C7.5317 8.43137 7.06121 7.99918 6.50076 7.99918C5.94031 7.99918 5.46982 8.43137 5.46982 9.00504C5.46982 9.57872 5.94031 10.0109 6.50076 10.0109Z"
                              fill="white" stroke="#EB001B" stroke-width="0.7">
                            </path>
                          </svg>
                          <span class="product-form__error-message"></span>
                        </div>
                        <form method="post" action="cart_add.php"
                          id="product-form-template--17996521046172__collection_slider_CHHC4j-8446921343132"
                          accept-charset="UTF-8" class="form" enctype="multipart/form-data" novalidate="novalidate"
                          data-type="add-to-cart-form"><input type="hidden" name="form_type" value="product"><input
                            type="hidden" name="utf8" value="✓"><input type="hidden" name="id" value="45040274702492"
                            disabled="">
                          <div class="product-card__bottom">
                            <div class="no-js-hidden price"
                              id="price-template--17996521046172__collection_slider_CHHC4j-8446921343132" role="status">

                              <ins class="price-item--regular"><span class="money"> Lei5.00</span></ins>






                            </div>
                            <button type="submit" name="add" class="btn btn--secondary product-form__submit"
                              aria-label="Add to Cart"><span>Add to Cart</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"
                                fill="none">
                                <path
                                  d="M3.22708 14.1828L2.22412 8.19984C2.07247 7.29523 1.99665 6.84293 2.23945 6.54647C2.48226 6.25 2.92852 6.25 3.82104 6.25H16.1783C17.0708 6.25 17.5171 6.25 17.7599 6.54647C18.0027 6.84293 17.9268 7.29523 17.7753 8.19984L16.7723 14.1828C16.4398 16.1659 16.2736 17.1574 15.5949 17.7454C14.9163 18.3333 13.938 18.3333 11.9815 18.3333H8.01786C6.06131 18.3333 5.08303 18.3333 4.40438 17.7454C3.72573 17.1574 3.55952 16.1659 3.22708 14.1828Z"
                                  stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                  d="M14.5837 6.25008C14.5837 3.71877 12.5317 1.66675 10.0003 1.66675C7.46902 1.66675 5.41699 3.71877 5.41699 6.25008"
                                  stroke="currentColor" stroke-width="1.5"></path>
                              </svg>

                              <div class="loading-overlay__spinner hidden">

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                  version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 511.494 511.494"
                                  style="enable-background:new 0 0 511.494 511.494;" xml:space="preserve" width="20"
                                  height="20">
                                  <g>
                                    <path
                                      d="M478.291,255.492c-16.133,0.143-29.689,12.161-31.765,28.16c-15.37,105.014-112.961,177.685-217.975,162.315 S50.866,333.006,66.236,227.992S179.197,50.307,284.211,65.677c35.796,5.239,69.386,20.476,96.907,43.959l-24.107,24.107   c-8.33,8.332-8.328,21.84,0.004,30.17c4.015,4.014,9.465,6.262,15.142,6.246h97.835c11.782,0,21.333-9.551,21.333-21.333V50.991   c-0.003-11.782-9.556-21.331-21.338-21.329c-5.655,0.001-11.079,2.248-15.078,6.246l-28.416,28.416   C320.774-29.34,159.141-19.568,65.476,86.152S-18.415,353.505,87.304,447.17s267.353,83.892,361.017-21.828   c32.972-37.216,54.381-83.237,61.607-132.431c2.828-17.612-9.157-34.183-26.769-37.011   C481.549,255.641,479.922,255.505,478.291,255.492z">
                                    </path>
                                  </g>
                                </svg>

                              </div>
                            </button>
                          </div><input type="hidden" name="product-id" value="8446921343132"><input type="hidden"
                            name="section-id" value="template--17996521046172__collection_slider_CHHC4j">
                        </form>
                      </product-form>
                    </div>
                  </div>
                </div>

              </div>

              <div class="collection-slide swiper-slide">
                <div class="product-card-inner card-inner">
                  <div id="pro-template--17996521046172__collection_slider_CHHC4j-8446921441436"
                    class="product-card-image card__media"><a href="#shan-keema-50g" title="Shan Keema 50g"
                      class="product__media-item"
                      data-media-id="template--17996521046172__collection_slider_CHHC4j-8446921441436-33639953727644"
                      tabindex="0">
                      <img loading="lazy" class=""
                        srcset="uploads/keema1_25aae058-cee2-41cb-9a2c-632eafd6794a_600x400_v=1749653494.webp"
                        alt="">
                    </a>
                    <div class="wish-lbl-wrp">

                      <div class="pro-wishlist">
                        <label>
                          <span class="wishlist-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                              fill="none">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.1335 2.95108C16.73 4.16664 16.9557 6.44579 15.6274 7.93897L8.99983 15.3894L2.37233 7.93977C1.04381 6.44646 1.26946 4.167 2.86616 2.95128C4.50032 1.70704 6.87275 2.10393 7.99225 3.80885L8.36782 4.38082C8.59267 4.72325 9.05847 4.82238 9.40821 4.60224C9.51777 4.53328 9.60294 4.44117 9.66134 4.33666L10.0076 3.80914C11.1268 2.10394 13.4993 1.70679 15.1335 2.95108ZM8.99998 2.653C7.31724 0.526225 4.15516 0.102335 1.94184 1.78754C-0.33726 3.52284 -0.659353 6.77651 1.23696 8.90805L8.4334 16.9972C8.7065 17.3041 9.18204 17.3362 9.49557 17.0688C9.53631 17.0341 9.57231 16.996 9.60351 16.9553L16.7628 8.90721C18.6589 6.77579 18.3367 3.52246 16.0579 1.78734C13.8446 0.102142 10.6825 0.526185 8.99998 2.653Z"
                                fill=" #4F4632"></path>
                            </svg>
                          </span>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="shan-keema-50g"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="pro-compare">
                        <label>
                          <span class="compare-label">
                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M9.80006 12.5C9.66163 12.5 9.52632 12.4585 9.41123 12.3809C9.29614 12.3033 9.20644 12.193 9.15347 12.0639C9.1005 11.9349 9.08664 11.7928 9.11364 11.6558C9.14064 11.5188 9.20728 11.393 9.30515 11.2942L11.6103 8.96804H2.79991C2.61426 8.96804 2.4362 8.89361 2.30493 8.76114C2.17365 8.62866 2.0999 8.44899 2.0999 8.26164C2.0999 8.0743 2.17365 7.89462 2.30493 7.76215C2.4362 7.62967 2.61426 7.55525 2.79991 7.55525H13.3001C13.4386 7.55528 13.5739 7.59672 13.689 7.67435C13.8041 7.75197 13.8938 7.86228 13.9467 7.99134C13.9997 8.1204 14.0136 8.2624 13.9866 8.39941C13.9596 8.53642 13.8929 8.66227 13.795 8.76106L10.295 12.293C10.1637 12.4255 9.9857 12.5 9.80006 12.5ZM11.9001 4.72968C11.9001 4.54233 11.8264 4.36266 11.6951 4.23018C11.5638 4.09771 11.3857 4.02328 11.2001 4.02328H2.3897L4.69485 1.69713C4.82236 1.56391 4.89292 1.38547 4.89133 1.20025C4.88973 1.01504 4.81611 0.837869 4.68632 0.706898C4.55654 0.575927 4.38096 0.501636 4.19742 0.500027C4.01388 0.498417 3.83705 0.569618 3.70503 0.698293L0.204955 4.23026C0.107087 4.32905 0.0404406 4.4549 0.0134427 4.59191C-0.0135551 4.72892 0.000307272 4.87092 0.0532774 4.99998C0.106248 5.12904 0.195947 5.23935 0.311036 5.31697C0.426126 5.3946 0.561438 5.43604 0.699866 5.43607H11.2001C11.3857 5.43607 11.5638 5.36165 11.6951 5.22917C11.8264 5.0967 11.9001 4.91703 11.9001 4.72968Z"
                                fill="#4F4632"></path>
                            </svg>
                          </span>
                          <a class="compare-now" href="/pages/compare" style="display:none;"> Compare Now </a>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="shan-keema-50g"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="quickview-btn" id="quickview">
                        <a style="text-decoration:none" href="#shan-keema-50g" data-handle="shan-keema-50g">
                          <svg width="14" height="11" viewBox="0 0 14 11" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M6.99996 3.15912C5.70988 3.15912 4.66016 4.20885 4.66016 5.49892C4.66016 6.789 5.70988 7.83873 6.99996 7.83873C8.29004 7.83873 9.33977 6.789 9.33977 5.49892C9.33977 4.20885 8.29004 3.15912 6.99996 3.15912ZM6.99996 6.8724C6.24254 6.8724 5.62648 6.25635 5.62648 5.49892C5.62648 4.7415 6.24254 4.12545 6.99996 4.12545C7.75738 4.12545 8.37344 4.7415 8.37344 5.49892C8.37344 6.25635 7.75738 6.8724 6.99996 6.8724Z"
                              fill="#4F4632"></path>
                            <path
                              d="M13.4184 4.21786C13.1537 3.8509 12.6889 3.28735 11.9785 2.68715C11.2954 2.10993 10.561 1.64782 9.79562 1.31368C8.87633 0.912544 7.9357 0.709106 7 0.709106C6.0643 0.709106 5.12367 0.912544 4.2041 1.31368C3.43875 1.64754 2.7043 2.10965 2.02125 2.68715C1.31086 3.28762 0.846016 3.8509 0.581328 4.21786C0.195781 4.7527 0 5.18418 0 5.5C0 5.81582 0.195508 6.24731 0.581602 6.78215C0.846289 7.14911 1.31113 7.71266 2.02152 8.31286C2.70457 8.89008 3.43902 9.35219 4.20437 9.68633C5.12367 10.0875 6.06457 10.2909 7.00027 10.2909C7.93598 10.2909 8.8766 10.0875 9.79617 9.68633C10.5615 9.35247 11.296 8.89036 11.979 8.31286C12.6894 7.71239 13.1543 7.14911 13.4189 6.78215C13.8045 6.24731 14 5.81582 14 5.5C14 5.18418 13.8045 4.7527 13.4184 4.21786ZM11.293 7.62653C10.3592 8.40118 8.85637 9.32457 7 9.32457C5.14363 9.32457 3.64109 8.40118 2.70703 7.62653C1.56406 6.67852 1.00816 5.73625 0.967422 5.5C1.00789 5.26375 1.56406 4.32149 2.70703 3.37348C3.64082 2.59883 5.14363 1.67543 7 1.67543C8.85609 1.67543 10.3589 2.59883 11.293 3.37348C12.4359 4.32149 12.9921 5.26375 13.0326 5.5C12.9918 5.73625 12.4359 6.67852 11.293 7.62653Z"
                              fill="#4F4632"></path>
                          </svg>
                        </a>
                      </div>

                    </div>

                  </div>
                  <div id="ProductInfo-template--17996521046172__collection_slider_CHHC4j" class="product-content">
                    <div class="product-content-top">

                      <div class="product-type">Spice Mixes</div>

                      <h3 class="product-title">
                        <a href="#shan-keema-50g">Shan Keema 50g</a>
                      </h3>

                      <!-- Start of Judge.me code -->
                      <div class="jdgm-widget jdgm-preview-badge">
                        <div style="display:none" class="jdgm-prev-badge" data-average-rating="0.00"
                          data-number-of-reviews="0" data-number-of-questions="0"> <span class="jdgm-prev-badge__stars"
                            data-score="0.00" tabindex="0" aria-label="0.00 stars" role="button"> <span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span> </span> <span class="jdgm-prev-badge__text"> No
                            reviews </span> </div>
                      </div>
                      <!-- End of Judge.me code -->

                    </div>
                    <div id="ProductInfo-template--17996521046172__collection_slider_CHHC4j-8446921441436"
                      class="product-content-bottom">
                      <div class="product-selectors">


                      </div>
                      <product-form class="product-form">
                        <div class="wbquicksuccess hidden" hidden="">Translation missing:
                          en.wbcustomlabel.wballtext.quicksuccessmsg</div>
                        <div class="product-form__error-message-wrapper" role="alert" hidden="">
                          <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-error"
                            viewBox="0 0 13 13" width="25" height="25">
                            <circle cx="6.5" cy="6.50049" r="5.5" stroke="white" stroke-width="2"></circle>
                            <circle cx="6.5" cy="6.5" r="5.5" fill="#EB001B" stroke="#EB001B" stroke-width="0.7">
                            </circle>
                            <path
                              d="M5.87413 3.52832L5.97439 7.57216H7.02713L7.12739 3.52832H5.87413ZM6.50076 9.66091C6.88091 9.66091 7.18169 9.37267 7.18169 9.00504C7.18169 8.63742 6.88091 8.34917 6.50076 8.34917C6.12061 8.34917 5.81982 8.63742 5.81982 9.00504C5.81982 9.37267 6.12061 9.66091 6.50076 9.66091Z"
                              fill="white"></path>
                            <path
                              d="M5.87413 3.17832H5.51535L5.52424 3.537L5.6245 7.58083L5.63296 7.92216H5.97439H7.02713H7.36856L7.37702 7.58083L7.47728 3.537L7.48617 3.17832H7.12739H5.87413ZM6.50076 10.0109C7.06121 10.0109 7.5317 9.57872 7.5317 9.00504C7.5317 8.43137 7.06121 7.99918 6.50076 7.99918C5.94031 7.99918 5.46982 8.43137 5.46982 9.00504C5.46982 9.57872 5.94031 10.0109 6.50076 10.0109Z"
                              fill="white" stroke="#EB001B" stroke-width="0.7">
                            </path>
                          </svg>
                          <span class="product-form__error-message"></span>
                        </div>
                        <form method="post" action="cart_add.php"
                          id="product-form-template--17996521046172__collection_slider_CHHC4j-8446921441436"
                          accept-charset="UTF-8" class="form" enctype="multipart/form-data" novalidate="novalidate"
                          data-type="add-to-cart-form"><input type="hidden" name="form_type" value="product"><input
                            type="hidden" name="utf8" value="✓"><input type="hidden" name="id" value="45040274800796"
                            disabled="">
                          <div class="product-card__bottom">
                            <div class="no-js-hidden price"
                              id="price-template--17996521046172__collection_slider_CHHC4j-8446921441436" role="status">

                              <ins class="price-item--regular"><span class="money"> Lei5.00</span></ins>






                            </div>
                            <button type="submit" name="add" class="btn btn--secondary product-form__submit"
                              aria-label="Add to Cart"><span>Add to Cart</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"
                                fill="none">
                                <path
                                  d="M3.22708 14.1828L2.22412 8.19984C2.07247 7.29523 1.99665 6.84293 2.23945 6.54647C2.48226 6.25 2.92852 6.25 3.82104 6.25H16.1783C17.0708 6.25 17.5171 6.25 17.7599 6.54647C18.0027 6.84293 17.9268 7.29523 17.7753 8.19984L16.7723 14.1828C16.4398 16.1659 16.2736 17.1574 15.5949 17.7454C14.9163 18.3333 13.938 18.3333 11.9815 18.3333H8.01786C6.06131 18.3333 5.08303 18.3333 4.40438 17.7454C3.72573 17.1574 3.55952 16.1659 3.22708 14.1828Z"
                                  stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                  d="M14.5837 6.25008C14.5837 3.71877 12.5317 1.66675 10.0003 1.66675C7.46902 1.66675 5.41699 3.71877 5.41699 6.25008"
                                  stroke="currentColor" stroke-width="1.5"></path>
                              </svg>

                              <div class="loading-overlay__spinner hidden">

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                  version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 511.494 511.494"
                                  style="enable-background:new 0 0 511.494 511.494;" xml:space="preserve" width="20"
                                  height="20">
                                  <g>
                                    <path
                                      d="M478.291,255.492c-16.133,0.143-29.689,12.161-31.765,28.16c-15.37,105.014-112.961,177.685-217.975,162.315 S50.866,333.006,66.236,227.992S179.197,50.307,284.211,65.677c35.796,5.239,69.386,20.476,96.907,43.959l-24.107,24.107   c-8.33,8.332-8.328,21.84,0.004,30.17c4.015,4.014,9.465,6.262,15.142,6.246h97.835c11.782,0,21.333-9.551,21.333-21.333V50.991   c-0.003-11.782-9.556-21.331-21.338-21.329c-5.655,0.001-11.079,2.248-15.078,6.246l-28.416,28.416   C320.774-29.34,159.141-19.568,65.476,86.152S-18.415,353.505,87.304,447.17s267.353,83.892,361.017-21.828   c32.972-37.216,54.381-83.237,61.607-132.431c2.828-17.612-9.157-34.183-26.769-37.011   C481.549,255.641,479.922,255.505,478.291,255.492z">
                                    </path>
                                  </g>
                                </svg>

                              </div>
                            </button>
                          </div><input type="hidden" name="product-id" value="8446921441436"><input type="hidden"
                            name="section-id" value="template--17996521046172__collection_slider_CHHC4j">
                        </form>
                      </product-form>
                    </div>
                  </div>
                </div>

              </div>

              <div class="collection-slide swiper-slide">
                <div class="product-card-inner card-inner">
                  <div id="pro-template--17996521046172__collection_slider_CHHC4j-8446921703580"
                    class="product-card-image card__media"><a href="#shan-chicken-handi-50g"
                      title="Shan Chicken Handi 50g" class="product__media-item"
                      data-media-id="template--17996521046172__collection_slider_CHHC4j-8446921703580-33639954612380"
                      tabindex="0">
                      <img loading="lazy" class=""
                        srcset="uploads/719YNoYts3L._AC_UF894_1000_QL80_d6ff8ae0-8cc6-456e-80ff-f7a266246efc_600x400_v=1749653508.jpg"
                        alt="">
                    </a>
                    <div class="wish-lbl-wrp">

                      <div class="pro-wishlist">
                        <label>
                          <span class="wishlist-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                              fill="none">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.1335 2.95108C16.73 4.16664 16.9557 6.44579 15.6274 7.93897L8.99983 15.3894L2.37233 7.93977C1.04381 6.44646 1.26946 4.167 2.86616 2.95128C4.50032 1.70704 6.87275 2.10393 7.99225 3.80885L8.36782 4.38082C8.59267 4.72325 9.05847 4.82238 9.40821 4.60224C9.51777 4.53328 9.60294 4.44117 9.66134 4.33666L10.0076 3.80914C11.1268 2.10394 13.4993 1.70679 15.1335 2.95108ZM8.99998 2.653C7.31724 0.526225 4.15516 0.102335 1.94184 1.78754C-0.33726 3.52284 -0.659353 6.77651 1.23696 8.90805L8.4334 16.9972C8.7065 17.3041 9.18204 17.3362 9.49557 17.0688C9.53631 17.0341 9.57231 16.996 9.60351 16.9553L16.7628 8.90721C18.6589 6.77579 18.3367 3.52246 16.0579 1.78734C13.8446 0.102142 10.6825 0.526185 8.99998 2.653Z"
                                fill=" #4F4632"></path>
                            </svg>
                          </span>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="shan-chicken-handi-50g"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="pro-compare">
                        <label>
                          <span class="compare-label">
                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M9.80006 12.5C9.66163 12.5 9.52632 12.4585 9.41123 12.3809C9.29614 12.3033 9.20644 12.193 9.15347 12.0639C9.1005 11.9349 9.08664 11.7928 9.11364 11.6558C9.14064 11.5188 9.20728 11.393 9.30515 11.2942L11.6103 8.96804H2.79991C2.61426 8.96804 2.4362 8.89361 2.30493 8.76114C2.17365 8.62866 2.0999 8.44899 2.0999 8.26164C2.0999 8.0743 2.17365 7.89462 2.30493 7.76215C2.4362 7.62967 2.61426 7.55525 2.79991 7.55525H13.3001C13.4386 7.55528 13.5739 7.59672 13.689 7.67435C13.8041 7.75197 13.8938 7.86228 13.9467 7.99134C13.9997 8.1204 14.0136 8.2624 13.9866 8.39941C13.9596 8.53642 13.8929 8.66227 13.795 8.76106L10.295 12.293C10.1637 12.4255 9.9857 12.5 9.80006 12.5ZM11.9001 4.72968C11.9001 4.54233 11.8264 4.36266 11.6951 4.23018C11.5638 4.09771 11.3857 4.02328 11.2001 4.02328H2.3897L4.69485 1.69713C4.82236 1.56391 4.89292 1.38547 4.89133 1.20025C4.88973 1.01504 4.81611 0.837869 4.68632 0.706898C4.55654 0.575927 4.38096 0.501636 4.19742 0.500027C4.01388 0.498417 3.83705 0.569618 3.70503 0.698293L0.204955 4.23026C0.107087 4.32905 0.0404406 4.4549 0.0134427 4.59191C-0.0135551 4.72892 0.000307272 4.87092 0.0532774 4.99998C0.106248 5.12904 0.195947 5.23935 0.311036 5.31697C0.426126 5.3946 0.561438 5.43604 0.699866 5.43607H11.2001C11.3857 5.43607 11.5638 5.36165 11.6951 5.22917C11.8264 5.0967 11.9001 4.91703 11.9001 4.72968Z"
                                fill="#4F4632"></path>
                            </svg>
                          </span>
                          <a class="compare-now" href="/pages/compare" style="display:none;"> Compare Now </a>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="shan-chicken-handi-50g"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="quickview-btn" id="quickview">
                        <a style="text-decoration:none" href="#shan-chicken-handi-50g"
                          data-handle="shan-chicken-handi-50g">
                          <svg width="14" height="11" viewBox="0 0 14 11" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M6.99996 3.15912C5.70988 3.15912 4.66016 4.20885 4.66016 5.49892C4.66016 6.789 5.70988 7.83873 6.99996 7.83873C8.29004 7.83873 9.33977 6.789 9.33977 5.49892C9.33977 4.20885 8.29004 3.15912 6.99996 3.15912ZM6.99996 6.8724C6.24254 6.8724 5.62648 6.25635 5.62648 5.49892C5.62648 4.7415 6.24254 4.12545 6.99996 4.12545C7.75738 4.12545 8.37344 4.7415 8.37344 5.49892C8.37344 6.25635 7.75738 6.8724 6.99996 6.8724Z"
                              fill="#4F4632"></path>
                            <path
                              d="M13.4184 4.21786C13.1537 3.8509 12.6889 3.28735 11.9785 2.68715C11.2954 2.10993 10.561 1.64782 9.79562 1.31368C8.87633 0.912544 7.9357 0.709106 7 0.709106C6.0643 0.709106 5.12367 0.912544 4.2041 1.31368C3.43875 1.64754 2.7043 2.10965 2.02125 2.68715C1.31086 3.28762 0.846016 3.8509 0.581328 4.21786C0.195781 4.7527 0 5.18418 0 5.5C0 5.81582 0.195508 6.24731 0.581602 6.78215C0.846289 7.14911 1.31113 7.71266 2.02152 8.31286C2.70457 8.89008 3.43902 9.35219 4.20437 9.68633C5.12367 10.0875 6.06457 10.2909 7.00027 10.2909C7.93598 10.2909 8.8766 10.0875 9.79617 9.68633C10.5615 9.35247 11.296 8.89036 11.979 8.31286C12.6894 7.71239 13.1543 7.14911 13.4189 6.78215C13.8045 6.24731 14 5.81582 14 5.5C14 5.18418 13.8045 4.7527 13.4184 4.21786ZM11.293 7.62653C10.3592 8.40118 8.85637 9.32457 7 9.32457C5.14363 9.32457 3.64109 8.40118 2.70703 7.62653C1.56406 6.67852 1.00816 5.73625 0.967422 5.5C1.00789 5.26375 1.56406 4.32149 2.70703 3.37348C3.64082 2.59883 5.14363 1.67543 7 1.67543C8.85609 1.67543 10.3589 2.59883 11.293 3.37348C12.4359 4.32149 12.9921 5.26375 13.0326 5.5C12.9918 5.73625 12.4359 6.67852 11.293 7.62653Z"
                              fill="#4F4632"></path>
                          </svg>
                        </a>
                      </div>

                    </div>

                  </div>
                  <div id="ProductInfo-template--17996521046172__collection_slider_CHHC4j" class="product-content">
                    <div class="product-content-top">

                      <div class="product-type">Spice Mixes</div>

                      <h3 class="product-title">
                        <a href="#shan-chicken-handi-50g">Shan Chicken Handi 50g</a>
                      </h3>

                      <!-- Start of Judge.me code -->
                      <div class="jdgm-widget jdgm-preview-badge">
                        <div style="display:none" class="jdgm-prev-badge" data-average-rating="0.00"
                          data-number-of-reviews="0" data-number-of-questions="0"> <span class="jdgm-prev-badge__stars"
                            data-score="0.00" tabindex="0" aria-label="0.00 stars" role="button"> <span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span> </span> <span class="jdgm-prev-badge__text"> No
                            reviews </span> </div>
                      </div>
                      <!-- End of Judge.me code -->

                    </div>
                    <div id="ProductInfo-template--17996521046172__collection_slider_CHHC4j-8446921703580"
                      class="product-content-bottom">
                      <div class="product-selectors">


                      </div>
                      <product-form class="product-form">
                        <div class="wbquicksuccess hidden" hidden="">Translation missing:
                          en.wbcustomlabel.wballtext.quicksuccessmsg</div>
                        <div class="product-form__error-message-wrapper" role="alert" hidden="">
                          <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-error"
                            viewBox="0 0 13 13" width="25" height="25">
                            <circle cx="6.5" cy="6.50049" r="5.5" stroke="white" stroke-width="2"></circle>
                            <circle cx="6.5" cy="6.5" r="5.5" fill="#EB001B" stroke="#EB001B" stroke-width="0.7">
                            </circle>
                            <path
                              d="M5.87413 3.52832L5.97439 7.57216H7.02713L7.12739 3.52832H5.87413ZM6.50076 9.66091C6.88091 9.66091 7.18169 9.37267 7.18169 9.00504C7.18169 8.63742 6.88091 8.34917 6.50076 8.34917C6.12061 8.34917 5.81982 8.63742 5.81982 9.00504C5.81982 9.37267 6.12061 9.66091 6.50076 9.66091Z"
                              fill="white"></path>
                            <path
                              d="M5.87413 3.17832H5.51535L5.52424 3.537L5.6245 7.58083L5.63296 7.92216H5.97439H7.02713H7.36856L7.37702 7.58083L7.47728 3.537L7.48617 3.17832H7.12739H5.87413ZM6.50076 10.0109C7.06121 10.0109 7.5317 9.57872 7.5317 9.00504C7.5317 8.43137 7.06121 7.99918 6.50076 7.99918C5.94031 7.99918 5.46982 8.43137 5.46982 9.00504C5.46982 9.57872 5.94031 10.0109 6.50076 10.0109Z"
                              fill="white" stroke="#EB001B" stroke-width="0.7">
                            </path>
                          </svg>
                          <span class="product-form__error-message"></span>
                        </div>
                        <form method="post" action="cart_add.php"
                          id="product-form-template--17996521046172__collection_slider_CHHC4j-8446921703580"
                          accept-charset="UTF-8" class="form" enctype="multipart/form-data" novalidate="novalidate"
                          data-type="add-to-cart-form"><input type="hidden" name="form_type" value="product"><input
                            type="hidden" name="utf8" value="✓"><input type="hidden" name="id" value="45040275095708"
                            disabled="">
                          <div class="product-card__bottom">
                            <div class="no-js-hidden price"
                              id="price-template--17996521046172__collection_slider_CHHC4j-8446921703580" role="status">

                              <ins class="price-item--regular"><span class="money"> Lei5.00</span></ins>






                            </div>
                            <button type="submit" name="add" class="btn btn--secondary product-form__submit"
                              aria-label="Add to Cart"><span>Add to Cart</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"
                                fill="none">
                                <path
                                  d="M3.22708 14.1828L2.22412 8.19984C2.07247 7.29523 1.99665 6.84293 2.23945 6.54647C2.48226 6.25 2.92852 6.25 3.82104 6.25H16.1783C17.0708 6.25 17.5171 6.25 17.7599 6.54647C18.0027 6.84293 17.9268 7.29523 17.7753 8.19984L16.7723 14.1828C16.4398 16.1659 16.2736 17.1574 15.5949 17.7454C14.9163 18.3333 13.938 18.3333 11.9815 18.3333H8.01786C6.06131 18.3333 5.08303 18.3333 4.40438 17.7454C3.72573 17.1574 3.55952 16.1659 3.22708 14.1828Z"
                                  stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                  d="M14.5837 6.25008C14.5837 3.71877 12.5317 1.66675 10.0003 1.66675C7.46902 1.66675 5.41699 3.71877 5.41699 6.25008"
                                  stroke="currentColor" stroke-width="1.5"></path>
                              </svg>

                              <div class="loading-overlay__spinner hidden">

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                  version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 511.494 511.494"
                                  style="enable-background:new 0 0 511.494 511.494;" xml:space="preserve" width="20"
                                  height="20">
                                  <g>
                                    <path
                                      d="M478.291,255.492c-16.133,0.143-29.689,12.161-31.765,28.16c-15.37,105.014-112.961,177.685-217.975,162.315 S50.866,333.006,66.236,227.992S179.197,50.307,284.211,65.677c35.796,5.239,69.386,20.476,96.907,43.959l-24.107,24.107   c-8.33,8.332-8.328,21.84,0.004,30.17c4.015,4.014,9.465,6.262,15.142,6.246h97.835c11.782,0,21.333-9.551,21.333-21.333V50.991   c-0.003-11.782-9.556-21.331-21.338-21.329c-5.655,0.001-11.079,2.248-15.078,6.246l-28.416,28.416   C320.774-29.34,159.141-19.568,65.476,86.152S-18.415,353.505,87.304,447.17s267.353,83.892,361.017-21.828   c32.972-37.216,54.381-83.237,61.607-132.431c2.828-17.612-9.157-34.183-26.769-37.011   C481.549,255.641,479.922,255.505,478.291,255.492z">
                                    </path>
                                  </g>
                                </svg>

                              </div>
                            </button>
                          </div><input type="hidden" name="product-id" value="8446921703580"><input type="hidden"
                            name="section-id" value="template--17996521046172__collection_slider_CHHC4j">
                        </form>
                      </product-form>
                    </div>
                  </div>
                </div>

              </div>

              <div class="collection-slide swiper-slide">
                <div class="product-card-inner card-inner">
                  <div id="pro-template--17996521046172__collection_slider_CHHC4j-8446922031260"
                    class="product-card-image card__media"><a href="#shan-seekh-kabab-50g" title="Shan Seekh Kabab 50g"
                      class="product__media-item"
                      data-media-id="template--17996521046172__collection_slider_CHHC4j-8446922031260-33639955562652"
                      tabindex="0">
                      <img loading="lazy" class=""
                        srcset="uploads/shan_seekh_kabab_01e13dae-92bd-4365-a4db-08fd07bf7d92_600x400_v=1749653527.webp"
                        alt="">
                    </a>
                    <div class="wish-lbl-wrp">

                      <div class="pro-wishlist">
                        <label>
                          <span class="wishlist-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                              fill="none">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.1335 2.95108C16.73 4.16664 16.9557 6.44579 15.6274 7.93897L8.99983 15.3894L2.37233 7.93977C1.04381 6.44646 1.26946 4.167 2.86616 2.95128C4.50032 1.70704 6.87275 2.10393 7.99225 3.80885L8.36782 4.38082C8.59267 4.72325 9.05847 4.82238 9.40821 4.60224C9.51777 4.53328 9.60294 4.44117 9.66134 4.33666L10.0076 3.80914C11.1268 2.10394 13.4993 1.70679 15.1335 2.95108ZM8.99998 2.653C7.31724 0.526225 4.15516 0.102335 1.94184 1.78754C-0.33726 3.52284 -0.659353 6.77651 1.23696 8.90805L8.4334 16.9972C8.7065 17.3041 9.18204 17.3362 9.49557 17.0688C9.53631 17.0341 9.57231 16.996 9.60351 16.9553L16.7628 8.90721C18.6589 6.77579 18.3367 3.52246 16.0579 1.78734C13.8446 0.102142 10.6825 0.526185 8.99998 2.653Z"
                                fill=" #4F4632"></path>
                            </svg>
                          </span>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="shan-seekh-kabab-50g"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="pro-compare">
                        <label>
                          <span class="compare-label">
                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M9.80006 12.5C9.66163 12.5 9.52632 12.4585 9.41123 12.3809C9.29614 12.3033 9.20644 12.193 9.15347 12.0639C9.1005 11.9349 9.08664 11.7928 9.11364 11.6558C9.14064 11.5188 9.20728 11.393 9.30515 11.2942L11.6103 8.96804H2.79991C2.61426 8.96804 2.4362 8.89361 2.30493 8.76114C2.17365 8.62866 2.0999 8.44899 2.0999 8.26164C2.0999 8.0743 2.17365 7.89462 2.30493 7.76215C2.4362 7.62967 2.61426 7.55525 2.79991 7.55525H13.3001C13.4386 7.55528 13.5739 7.59672 13.689 7.67435C13.8041 7.75197 13.8938 7.86228 13.9467 7.99134C13.9997 8.1204 14.0136 8.2624 13.9866 8.39941C13.9596 8.53642 13.8929 8.66227 13.795 8.76106L10.295 12.293C10.1637 12.4255 9.9857 12.5 9.80006 12.5ZM11.9001 4.72968C11.9001 4.54233 11.8264 4.36266 11.6951 4.23018C11.5638 4.09771 11.3857 4.02328 11.2001 4.02328H2.3897L4.69485 1.69713C4.82236 1.56391 4.89292 1.38547 4.89133 1.20025C4.88973 1.01504 4.81611 0.837869 4.68632 0.706898C4.55654 0.575927 4.38096 0.501636 4.19742 0.500027C4.01388 0.498417 3.83705 0.569618 3.70503 0.698293L0.204955 4.23026C0.107087 4.32905 0.0404406 4.4549 0.0134427 4.59191C-0.0135551 4.72892 0.000307272 4.87092 0.0532774 4.99998C0.106248 5.12904 0.195947 5.23935 0.311036 5.31697C0.426126 5.3946 0.561438 5.43604 0.699866 5.43607H11.2001C11.3857 5.43607 11.5638 5.36165 11.6951 5.22917C11.8264 5.0967 11.9001 4.91703 11.9001 4.72968Z"
                                fill="#4F4632"></path>
                            </svg>
                          </span>
                          <a class="compare-now" href="/pages/compare" style="display:none;"> Compare Now </a>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="shan-seekh-kabab-50g"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="quickview-btn" id="quickview">
                        <a style="text-decoration:none" href="#shan-seekh-kabab-50g" data-handle="shan-seekh-kabab-50g">
                          <svg width="14" height="11" viewBox="0 0 14 11" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M6.99996 3.15912C5.70988 3.15912 4.66016 4.20885 4.66016 5.49892C4.66016 6.789 5.70988 7.83873 6.99996 7.83873C8.29004 7.83873 9.33977 6.789 9.33977 5.49892C9.33977 4.20885 8.29004 3.15912 6.99996 3.15912ZM6.99996 6.8724C6.24254 6.8724 5.62648 6.25635 5.62648 5.49892C5.62648 4.7415 6.24254 4.12545 6.99996 4.12545C7.75738 4.12545 8.37344 4.7415 8.37344 5.49892C8.37344 6.25635 7.75738 6.8724 6.99996 6.8724Z"
                              fill="#4F4632"></path>
                            <path
                              d="M13.4184 4.21786C13.1537 3.8509 12.6889 3.28735 11.9785 2.68715C11.2954 2.10993 10.561 1.64782 9.79562 1.31368C8.87633 0.912544 7.9357 0.709106 7 0.709106C6.0643 0.709106 5.12367 0.912544 4.2041 1.31368C3.43875 1.64754 2.7043 2.10965 2.02125 2.68715C1.31086 3.28762 0.846016 3.8509 0.581328 4.21786C0.195781 4.7527 0 5.18418 0 5.5C0 5.81582 0.195508 6.24731 0.581602 6.78215C0.846289 7.14911 1.31113 7.71266 2.02152 8.31286C2.70457 8.89008 3.43902 9.35219 4.20437 9.68633C5.12367 10.0875 6.06457 10.2909 7.00027 10.2909C7.93598 10.2909 8.8766 10.0875 9.79617 9.68633C10.5615 9.35247 11.296 8.89036 11.979 8.31286C12.6894 7.71239 13.1543 7.14911 13.4189 6.78215C13.8045 6.24731 14 5.81582 14 5.5C14 5.18418 13.8045 4.7527 13.4184 4.21786ZM11.293 7.62653C10.3592 8.40118 8.85637 9.32457 7 9.32457C5.14363 9.32457 3.64109 8.40118 2.70703 7.62653C1.56406 6.67852 1.00816 5.73625 0.967422 5.5C1.00789 5.26375 1.56406 4.32149 2.70703 3.37348C3.64082 2.59883 5.14363 1.67543 7 1.67543C8.85609 1.67543 10.3589 2.59883 11.293 3.37348C12.4359 4.32149 12.9921 5.26375 13.0326 5.5C12.9918 5.73625 12.4359 6.67852 11.293 7.62653Z"
                              fill="#4F4632"></path>
                          </svg>
                        </a>
                      </div>

                    </div>

                  </div>
                  <div id="ProductInfo-template--17996521046172__collection_slider_CHHC4j" class="product-content">
                    <div class="product-content-top">

                      <div class="product-type">Spice Mixes</div>

                      <h3 class="product-title">
                        <a href="#shan-seekh-kabab-50g">Shan Seekh Kabab 50g</a>
                      </h3>

                      <!-- Start of Judge.me code -->
                      <div class="jdgm-widget jdgm-preview-badge">
                        <div style="display:none" class="jdgm-prev-badge" data-average-rating="0.00"
                          data-number-of-reviews="0" data-number-of-questions="0"> <span class="jdgm-prev-badge__stars"
                            data-score="0.00" tabindex="0" aria-label="0.00 stars" role="button"> <span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span> </span> <span class="jdgm-prev-badge__text"> No
                            reviews </span> </div>
                      </div>
                      <!-- End of Judge.me code -->

                    </div>
                    <div id="ProductInfo-template--17996521046172__collection_slider_CHHC4j-8446922031260"
                      class="product-content-bottom">
                      <div class="product-selectors">


                      </div>
                      <product-form class="product-form">
                        <div class="wbquicksuccess hidden" hidden="">Translation missing:
                          en.wbcustomlabel.wballtext.quicksuccessmsg</div>
                        <div class="product-form__error-message-wrapper" role="alert" hidden="">
                          <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-error"
                            viewBox="0 0 13 13" width="25" height="25">
                            <circle cx="6.5" cy="6.50049" r="5.5" stroke="white" stroke-width="2"></circle>
                            <circle cx="6.5" cy="6.5" r="5.5" fill="#EB001B" stroke="#EB001B" stroke-width="0.7">
                            </circle>
                            <path
                              d="M5.87413 3.52832L5.97439 7.57216H7.02713L7.12739 3.52832H5.87413ZM6.50076 9.66091C6.88091 9.66091 7.18169 9.37267 7.18169 9.00504C7.18169 8.63742 6.88091 8.34917 6.50076 8.34917C6.12061 8.34917 5.81982 8.63742 5.81982 9.00504C5.81982 9.37267 6.12061 9.66091 6.50076 9.66091Z"
                              fill="white"></path>
                            <path
                              d="M5.87413 3.17832H5.51535L5.52424 3.537L5.6245 7.58083L5.63296 7.92216H5.97439H7.02713H7.36856L7.37702 7.58083L7.47728 3.537L7.48617 3.17832H7.12739H5.87413ZM6.50076 10.0109C7.06121 10.0109 7.5317 9.57872 7.5317 9.00504C7.5317 8.43137 7.06121 7.99918 6.50076 7.99918C5.94031 7.99918 5.46982 8.43137 5.46982 9.00504C5.46982 9.57872 5.94031 10.0109 6.50076 10.0109Z"
                              fill="white" stroke="#EB001B" stroke-width="0.7">
                            </path>
                          </svg>
                          <span class="product-form__error-message"></span>
                        </div>
                        <form method="post" action="cart_add.php"
                          id="product-form-template--17996521046172__collection_slider_CHHC4j-8446922031260"
                          accept-charset="UTF-8" class="form" enctype="multipart/form-data" novalidate="novalidate"
                          data-type="add-to-cart-form"><input type="hidden" name="form_type" value="product"><input
                            type="hidden" name="utf8" value="✓"><input type="hidden" name="id" value="45040275423388"
                            disabled="">
                          <div class="product-card__bottom">
                            <div class="no-js-hidden price"
                              id="price-template--17996521046172__collection_slider_CHHC4j-8446922031260" role="status">

                              <ins class="price-item--regular"><span class="money"> Lei5.00</span></ins>






                            </div>
                            <button type="submit" name="add" class="btn btn--secondary product-form__submit"
                              aria-label="Add to Cart"><span>Add to Cart</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"
                                fill="none">
                                <path
                                  d="M3.22708 14.1828L2.22412 8.19984C2.07247 7.29523 1.99665 6.84293 2.23945 6.54647C2.48226 6.25 2.92852 6.25 3.82104 6.25H16.1783C17.0708 6.25 17.5171 6.25 17.7599 6.54647C18.0027 6.84293 17.9268 7.29523 17.7753 8.19984L16.7723 14.1828C16.4398 16.1659 16.2736 17.1574 15.5949 17.7454C14.9163 18.3333 13.938 18.3333 11.9815 18.3333H8.01786C6.06131 18.3333 5.08303 18.3333 4.40438 17.7454C3.72573 17.1574 3.55952 16.1659 3.22708 14.1828Z"
                                  stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                  d="M14.5837 6.25008C14.5837 3.71877 12.5317 1.66675 10.0003 1.66675C7.46902 1.66675 5.41699 3.71877 5.41699 6.25008"
                                  stroke="currentColor" stroke-width="1.5"></path>
                              </svg>

                              <div class="loading-overlay__spinner hidden">

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                  version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 511.494 511.494"
                                  style="enable-background:new 0 0 511.494 511.494;" xml:space="preserve" width="20"
                                  height="20">
                                  <g>
                                    <path
                                      d="M478.291,255.492c-16.133,0.143-29.689,12.161-31.765,28.16c-15.37,105.014-112.961,177.685-217.975,162.315 S50.866,333.006,66.236,227.992S179.197,50.307,284.211,65.677c35.796,5.239,69.386,20.476,96.907,43.959l-24.107,24.107   c-8.33,8.332-8.328,21.84,0.004,30.17c4.015,4.014,9.465,6.262,15.142,6.246h97.835c11.782,0,21.333-9.551,21.333-21.333V50.991   c-0.003-11.782-9.556-21.331-21.338-21.329c-5.655,0.001-11.079,2.248-15.078,6.246l-28.416,28.416   C320.774-29.34,159.141-19.568,65.476,86.152S-18.415,353.505,87.304,447.17s267.353,83.892,361.017-21.828   c32.972-37.216,54.381-83.237,61.607-132.431c2.828-17.612-9.157-34.183-26.769-37.011   C481.549,255.641,479.922,255.505,478.291,255.492z">
                                    </path>
                                  </g>
                                </svg>

                              </div>
                            </button>
                          </div><input type="hidden" name="product-id" value="8446922031260"><input type="hidden"
                            name="section-id" value="template--17996521046172__collection_slider_CHHC4j">
                        </form>
                      </product-form>
                    </div>
                  </div>
                </div>

              </div>

              <div class="collection-slide swiper-slide">
                <div class="product-card-inner card-inner">
                  <div id="pro-template--17996521046172__collection_slider_CHHC4j-8446922096796"
                    class="product-card-image card__media"><a href="#shan-memoni-mutton-biryani-50g"
                      title="Shan Memoni Mutton Biryani 50g" class="product__media-item"
                      data-media-id="template--17996521046172__collection_slider_CHHC4j-8446922096796-33639955693724"
                      tabindex="0">
                      <img loading="lazy" class=""
                        srcset="uploads/Shan_Memoni_Mutton_Biryani_Masala_100g-Shan-Spices_800x_9d0c9d4f-c8ec-41c2-b29f-e6a927cbf272_600x400_v=1749653530.webp"
                        alt="">
                    </a>
                    <div class="wish-lbl-wrp">

                      <div class="pro-wishlist">
                        <label>
                          <span class="wishlist-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                              fill="none">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.1335 2.95108C16.73 4.16664 16.9557 6.44579 15.6274 7.93897L8.99983 15.3894L2.37233 7.93977C1.04381 6.44646 1.26946 4.167 2.86616 2.95128C4.50032 1.70704 6.87275 2.10393 7.99225 3.80885L8.36782 4.38082C8.59267 4.72325 9.05847 4.82238 9.40821 4.60224C9.51777 4.53328 9.60294 4.44117 9.66134 4.33666L10.0076 3.80914C11.1268 2.10394 13.4993 1.70679 15.1335 2.95108ZM8.99998 2.653C7.31724 0.526225 4.15516 0.102335 1.94184 1.78754C-0.33726 3.52284 -0.659353 6.77651 1.23696 8.90805L8.4334 16.9972C8.7065 17.3041 9.18204 17.3362 9.49557 17.0688C9.53631 17.0341 9.57231 16.996 9.60351 16.9553L16.7628 8.90721C18.6589 6.77579 18.3367 3.52246 16.0579 1.78734C13.8446 0.102142 10.6825 0.526185 8.99998 2.653Z"
                                fill=" #4F4632"></path>
                            </svg>
                          </span>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="shan-memoni-mutton-biryani-50g"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="pro-compare">
                        <label>
                          <span class="compare-label">
                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M9.80006 12.5C9.66163 12.5 9.52632 12.4585 9.41123 12.3809C9.29614 12.3033 9.20644 12.193 9.15347 12.0639C9.1005 11.9349 9.08664 11.7928 9.11364 11.6558C9.14064 11.5188 9.20728 11.393 9.30515 11.2942L11.6103 8.96804H2.79991C2.61426 8.96804 2.4362 8.89361 2.30493 8.76114C2.17365 8.62866 2.0999 8.44899 2.0999 8.26164C2.0999 8.0743 2.17365 7.89462 2.30493 7.76215C2.4362 7.62967 2.61426 7.55525 2.79991 7.55525H13.3001C13.4386 7.55528 13.5739 7.59672 13.689 7.67435C13.8041 7.75197 13.8938 7.86228 13.9467 7.99134C13.9997 8.1204 14.0136 8.2624 13.9866 8.39941C13.9596 8.53642 13.8929 8.66227 13.795 8.76106L10.295 12.293C10.1637 12.4255 9.9857 12.5 9.80006 12.5ZM11.9001 4.72968C11.9001 4.54233 11.8264 4.36266 11.6951 4.23018C11.5638 4.09771 11.3857 4.02328 11.2001 4.02328H2.3897L4.69485 1.69713C4.82236 1.56391 4.89292 1.38547 4.89133 1.20025C4.88973 1.01504 4.81611 0.837869 4.68632 0.706898C4.55654 0.575927 4.38096 0.501636 4.19742 0.500027C4.01388 0.498417 3.83705 0.569618 3.70503 0.698293L0.204955 4.23026C0.107087 4.32905 0.0404406 4.4549 0.0134427 4.59191C-0.0135551 4.72892 0.000307272 4.87092 0.0532774 4.99998C0.106248 5.12904 0.195947 5.23935 0.311036 5.31697C0.426126 5.3946 0.561438 5.43604 0.699866 5.43607H11.2001C11.3857 5.43607 11.5638 5.36165 11.6951 5.22917C11.8264 5.0967 11.9001 4.91703 11.9001 4.72968Z"
                                fill="#4F4632"></path>
                            </svg>
                          </span>
                          <a class="compare-now" href="/pages/compare" style="display:none;"> Compare Now </a>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="shan-memoni-mutton-biryani-50g"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="quickview-btn" id="quickview">
                        <a style="text-decoration:none" href="#shan-memoni-mutton-biryani-50g"
                          data-handle="shan-memoni-mutton-biryani-50g">
                          <svg width="14" height="11" viewBox="0 0 14 11" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M6.99996 3.15912C5.70988 3.15912 4.66016 4.20885 4.66016 5.49892C4.66016 6.789 5.70988 7.83873 6.99996 7.83873C8.29004 7.83873 9.33977 6.789 9.33977 5.49892C9.33977 4.20885 8.29004 3.15912 6.99996 3.15912ZM6.99996 6.8724C6.24254 6.8724 5.62648 6.25635 5.62648 5.49892C5.62648 4.7415 6.24254 4.12545 6.99996 4.12545C7.75738 4.12545 8.37344 4.7415 8.37344 5.49892C8.37344 6.25635 7.75738 6.8724 6.99996 6.8724Z"
                              fill="#4F4632"></path>
                            <path
                              d="M13.4184 4.21786C13.1537 3.8509 12.6889 3.28735 11.9785 2.68715C11.2954 2.10993 10.561 1.64782 9.79562 1.31368C8.87633 0.912544 7.9357 0.709106 7 0.709106C6.0643 0.709106 5.12367 0.912544 4.2041 1.31368C3.43875 1.64754 2.7043 2.10965 2.02125 2.68715C1.31086 3.28762 0.846016 3.8509 0.581328 4.21786C0.195781 4.7527 0 5.18418 0 5.5C0 5.81582 0.195508 6.24731 0.581602 6.78215C0.846289 7.14911 1.31113 7.71266 2.02152 8.31286C2.70457 8.89008 3.43902 9.35219 4.20437 9.68633C5.12367 10.0875 6.06457 10.2909 7.00027 10.2909C7.93598 10.2909 8.8766 10.0875 9.79617 9.68633C10.5615 9.35247 11.296 8.89036 11.979 8.31286C12.6894 7.71239 13.1543 7.14911 13.4189 6.78215C13.8045 6.24731 14 5.81582 14 5.5C14 5.18418 13.8045 4.7527 13.4184 4.21786ZM11.293 7.62653C10.3592 8.40118 8.85637 9.32457 7 9.32457C5.14363 9.32457 3.64109 8.40118 2.70703 7.62653C1.56406 6.67852 1.00816 5.73625 0.967422 5.5C1.00789 5.26375 1.56406 4.32149 2.70703 3.37348C3.64082 2.59883 5.14363 1.67543 7 1.67543C8.85609 1.67543 10.3589 2.59883 11.293 3.37348C12.4359 4.32149 12.9921 5.26375 13.0326 5.5C12.9918 5.73625 12.4359 6.67852 11.293 7.62653Z"
                              fill="#4F4632"></path>
                          </svg>
                        </a>
                      </div>

                    </div>

                  </div>
                  <div id="ProductInfo-template--17996521046172__collection_slider_CHHC4j" class="product-content">
                    <div class="product-content-top">

                      <div class="product-type">Indian Biryani Mix</div>

                      <h3 class="product-title">
                        <a href="#shan-memoni-mutton-biryani-50g">Shan Memoni Mutton Biryani 50g</a>
                      </h3>

                      <!-- Start of Judge.me code -->
                      <div class="jdgm-widget jdgm-preview-badge">
                        <div style="display:none" class="jdgm-prev-badge" data-average-rating="0.00"
                          data-number-of-reviews="0" data-number-of-questions="0"> <span class="jdgm-prev-badge__stars"
                            data-score="0.00" tabindex="0" aria-label="0.00 stars" role="button"> <span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span> </span> <span class="jdgm-prev-badge__text"> No
                            reviews </span> </div>
                      </div>
                      <!-- End of Judge.me code -->

                    </div>
                    <div id="ProductInfo-template--17996521046172__collection_slider_CHHC4j-8446922096796"
                      class="product-content-bottom">
                      <div class="product-selectors">


                      </div>
                      <product-form class="product-form">
                        <div class="wbquicksuccess hidden" hidden="">Translation missing:
                          en.wbcustomlabel.wballtext.quicksuccessmsg</div>
                        <div class="product-form__error-message-wrapper" role="alert" hidden="">
                          <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-error"
                            viewBox="0 0 13 13" width="25" height="25">
                            <circle cx="6.5" cy="6.50049" r="5.5" stroke="white" stroke-width="2"></circle>
                            <circle cx="6.5" cy="6.5" r="5.5" fill="#EB001B" stroke="#EB001B" stroke-width="0.7">
                            </circle>
                            <path
                              d="M5.87413 3.52832L5.97439 7.57216H7.02713L7.12739 3.52832H5.87413ZM6.50076 9.66091C6.88091 9.66091 7.18169 9.37267 7.18169 9.00504C7.18169 8.63742 6.88091 8.34917 6.50076 8.34917C6.12061 8.34917 5.81982 8.63742 5.81982 9.00504C5.81982 9.37267 6.12061 9.66091 6.50076 9.66091Z"
                              fill="white"></path>
                            <path
                              d="M5.87413 3.17832H5.51535L5.52424 3.537L5.6245 7.58083L5.63296 7.92216H5.97439H7.02713H7.36856L7.37702 7.58083L7.47728 3.537L7.48617 3.17832H7.12739H5.87413ZM6.50076 10.0109C7.06121 10.0109 7.5317 9.57872 7.5317 9.00504C7.5317 8.43137 7.06121 7.99918 6.50076 7.99918C5.94031 7.99918 5.46982 8.43137 5.46982 9.00504C5.46982 9.57872 5.94031 10.0109 6.50076 10.0109Z"
                              fill="white" stroke="#EB001B" stroke-width="0.7">
                            </path>
                          </svg>
                          <span class="product-form__error-message"></span>
                        </div>
                        <form method="post" action="cart_add.php"
                          id="product-form-template--17996521046172__collection_slider_CHHC4j-8446922096796"
                          accept-charset="UTF-8" class="form" enctype="multipart/form-data" novalidate="novalidate"
                          data-type="add-to-cart-form"><input type="hidden" name="form_type" value="product"><input
                            type="hidden" name="utf8" value="✓"><input type="hidden" name="id" value="45040275488924"
                            disabled="">
                          <div class="product-card__bottom">
                            <div class="no-js-hidden price"
                              id="price-template--17996521046172__collection_slider_CHHC4j-8446922096796" role="status">

                              <ins class="price-item--regular"><span class="money"> Lei5.00</span></ins>






                            </div>
                            <button type="submit" name="add" class="btn btn--secondary product-form__submit"
                              aria-label="Add to Cart"><span>Add to Cart</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"
                                fill="none">
                                <path
                                  d="M3.22708 14.1828L2.22412 8.19984C2.07247 7.29523 1.99665 6.84293 2.23945 6.54647C2.48226 6.25 2.92852 6.25 3.82104 6.25H16.1783C17.0708 6.25 17.5171 6.25 17.7599 6.54647C18.0027 6.84293 17.9268 7.29523 17.7753 8.19984L16.7723 14.1828C16.4398 16.1659 16.2736 17.1574 15.5949 17.7454C14.9163 18.3333 13.938 18.3333 11.9815 18.3333H8.01786C6.06131 18.3333 5.08303 18.3333 4.40438 17.7454C3.72573 17.1574 3.55952 16.1659 3.22708 14.1828Z"
                                  stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                  d="M14.5837 6.25008C14.5837 3.71877 12.5317 1.66675 10.0003 1.66675C7.46902 1.66675 5.41699 3.71877 5.41699 6.25008"
                                  stroke="currentColor" stroke-width="1.5"></path>
                              </svg>

                              <div class="loading-overlay__spinner hidden">

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                  version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 511.494 511.494"
                                  style="enable-background:new 0 0 511.494 511.494;" xml:space="preserve" width="20"
                                  height="20">
                                  <g>
                                    <path
                                      d="M478.291,255.492c-16.133,0.143-29.689,12.161-31.765,28.16c-15.37,105.014-112.961,177.685-217.975,162.315 S50.866,333.006,66.236,227.992S179.197,50.307,284.211,65.677c35.796,5.239,69.386,20.476,96.907,43.959l-24.107,24.107   c-8.33,8.332-8.328,21.84,0.004,30.17c4.015,4.014,9.465,6.262,15.142,6.246h97.835c11.782,0,21.333-9.551,21.333-21.333V50.991   c-0.003-11.782-9.556-21.331-21.338-21.329c-5.655,0.001-11.079,2.248-15.078,6.246l-28.416,28.416   C320.774-29.34,159.141-19.568,65.476,86.152S-18.415,353.505,87.304,447.17s267.353,83.892,361.017-21.828   c32.972-37.216,54.381-83.237,61.607-132.431c2.828-17.612-9.157-34.183-26.769-37.011   C481.549,255.641,479.922,255.505,478.291,255.492z">
                                    </path>
                                  </g>
                                </svg>

                              </div>
                            </button>
                          </div><input type="hidden" name="product-id" value="8446922096796"><input type="hidden"
                            name="section-id" value="template--17996521046172__collection_slider_CHHC4j">
                        </form>
                      </product-form>
                    </div>
                  </div>
                </div>

              </div>

              <div class="collection-slide swiper-slide">
                <div class="product-card-inner card-inner">
                  <div id="pro-template--17996521046172__collection_slider_CHHC4j-8446922162332"
                    class="product-card-image card__media"><a href="#shan-chicken-white-korma-masala-40g"
                      title="Shan Chicken White Korma Masala 40g" class="product__media-item"
                      data-media-id="template--17996521046172__collection_slider_CHHC4j-8446922162332-33639955955868"
                      tabindex="0">
                      <img loading="lazy" class=""
                        srcset="uploads/shan_chicken_white_korma_b9040d57-e6c3-408a-af16-042a068e51f3_600x400_v=1749653533.webp"
                        alt="">
                    </a>
                    <div class="wish-lbl-wrp">

                      <div class="pro-wishlist">
                        <label>
                          <span class="wishlist-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                              fill="none">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.1335 2.95108C16.73 4.16664 16.9557 6.44579 15.6274 7.93897L8.99983 15.3894L2.37233 7.93977C1.04381 6.44646 1.26946 4.167 2.86616 2.95128C4.50032 1.70704 6.87275 2.10393 7.99225 3.80885L8.36782 4.38082C8.59267 4.72325 9.05847 4.82238 9.40821 4.60224C9.51777 4.53328 9.60294 4.44117 9.66134 4.33666L10.0076 3.80914C11.1268 2.10394 13.4993 1.70679 15.1335 2.95108ZM8.99998 2.653C7.31724 0.526225 4.15516 0.102335 1.94184 1.78754C-0.33726 3.52284 -0.659353 6.77651 1.23696 8.90805L8.4334 16.9972C8.7065 17.3041 9.18204 17.3362 9.49557 17.0688C9.53631 17.0341 9.57231 16.996 9.60351 16.9553L16.7628 8.90721C18.6589 6.77579 18.3367 3.52246 16.0579 1.78734C13.8446 0.102142 10.6825 0.526185 8.99998 2.653Z"
                                fill=" #4F4632"></path>
                            </svg>
                          </span>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="shan-chicken-white-korma-masala-40g"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="pro-compare">
                        <label>
                          <span class="compare-label">
                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M9.80006 12.5C9.66163 12.5 9.52632 12.4585 9.41123 12.3809C9.29614 12.3033 9.20644 12.193 9.15347 12.0639C9.1005 11.9349 9.08664 11.7928 9.11364 11.6558C9.14064 11.5188 9.20728 11.393 9.30515 11.2942L11.6103 8.96804H2.79991C2.61426 8.96804 2.4362 8.89361 2.30493 8.76114C2.17365 8.62866 2.0999 8.44899 2.0999 8.26164C2.0999 8.0743 2.17365 7.89462 2.30493 7.76215C2.4362 7.62967 2.61426 7.55525 2.79991 7.55525H13.3001C13.4386 7.55528 13.5739 7.59672 13.689 7.67435C13.8041 7.75197 13.8938 7.86228 13.9467 7.99134C13.9997 8.1204 14.0136 8.2624 13.9866 8.39941C13.9596 8.53642 13.8929 8.66227 13.795 8.76106L10.295 12.293C10.1637 12.4255 9.9857 12.5 9.80006 12.5ZM11.9001 4.72968C11.9001 4.54233 11.8264 4.36266 11.6951 4.23018C11.5638 4.09771 11.3857 4.02328 11.2001 4.02328H2.3897L4.69485 1.69713C4.82236 1.56391 4.89292 1.38547 4.89133 1.20025C4.88973 1.01504 4.81611 0.837869 4.68632 0.706898C4.55654 0.575927 4.38096 0.501636 4.19742 0.500027C4.01388 0.498417 3.83705 0.569618 3.70503 0.698293L0.204955 4.23026C0.107087 4.32905 0.0404406 4.4549 0.0134427 4.59191C-0.0135551 4.72892 0.000307272 4.87092 0.0532774 4.99998C0.106248 5.12904 0.195947 5.23935 0.311036 5.31697C0.426126 5.3946 0.561438 5.43604 0.699866 5.43607H11.2001C11.3857 5.43607 11.5638 5.36165 11.6951 5.22917C11.8264 5.0967 11.9001 4.91703 11.9001 4.72968Z"
                                fill="#4F4632"></path>
                            </svg>
                          </span>
                          <a class="compare-now" href="/pages/compare" style="display:none;"> Compare Now </a>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="shan-chicken-white-korma-masala-40g"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="quickview-btn" id="quickview">
                        <a style="text-decoration:none" href="#shan-chicken-white-korma-masala-40g"
                          data-handle="shan-chicken-white-korma-masala-40g">
                          <svg width="14" height="11" viewBox="0 0 14 11" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M6.99996 3.15912C5.70988 3.15912 4.66016 4.20885 4.66016 5.49892C4.66016 6.789 5.70988 7.83873 6.99996 7.83873C8.29004 7.83873 9.33977 6.789 9.33977 5.49892C9.33977 4.20885 8.29004 3.15912 6.99996 3.15912ZM6.99996 6.8724C6.24254 6.8724 5.62648 6.25635 5.62648 5.49892C5.62648 4.7415 6.24254 4.12545 6.99996 4.12545C7.75738 4.12545 8.37344 4.7415 8.37344 5.49892C8.37344 6.25635 7.75738 6.8724 6.99996 6.8724Z"
                              fill="#4F4632"></path>
                            <path
                              d="M13.4184 4.21786C13.1537 3.8509 12.6889 3.28735 11.9785 2.68715C11.2954 2.10993 10.561 1.64782 9.79562 1.31368C8.87633 0.912544 7.9357 0.709106 7 0.709106C6.0643 0.709106 5.12367 0.912544 4.2041 1.31368C3.43875 1.64754 2.7043 2.10965 2.02125 2.68715C1.31086 3.28762 0.846016 3.8509 0.581328 4.21786C0.195781 4.7527 0 5.18418 0 5.5C0 5.81582 0.195508 6.24731 0.581602 6.78215C0.846289 7.14911 1.31113 7.71266 2.02152 8.31286C2.70457 8.89008 3.43902 9.35219 4.20437 9.68633C5.12367 10.0875 6.06457 10.2909 7.00027 10.2909C7.93598 10.2909 8.8766 10.0875 9.79617 9.68633C10.5615 9.35247 11.296 8.89036 11.979 8.31286C12.6894 7.71239 13.1543 7.14911 13.4189 6.78215C13.8045 6.24731 14 5.81582 14 5.5C14 5.18418 13.8045 4.7527 13.4184 4.21786ZM11.293 7.62653C10.3592 8.40118 8.85637 9.32457 7 9.32457C5.14363 9.32457 3.64109 8.40118 2.70703 7.62653C1.56406 6.67852 1.00816 5.73625 0.967422 5.5C1.00789 5.26375 1.56406 4.32149 2.70703 3.37348C3.64082 2.59883 5.14363 1.67543 7 1.67543C8.85609 1.67543 10.3589 2.59883 11.293 3.37348C12.4359 4.32149 12.9921 5.26375 13.0326 5.5C12.9918 5.73625 12.4359 6.67852 11.293 7.62653Z"
                              fill="#4F4632"></path>
                          </svg>
                        </a>
                      </div>

                    </div>

                  </div>
                  <div id="ProductInfo-template--17996521046172__collection_slider_CHHC4j" class="product-content">
                    <div class="product-content-top">

                      <div class="product-type">Spice Mixes</div>

                      <h3 class="product-title">
                        <a href="#shan-chicken-white-korma-masala-40g">Shan Chicken White Korma Masala 40g</a>
                      </h3>

                      <!-- Start of Judge.me code -->
                      <div class="jdgm-widget jdgm-preview-badge">
                        <div style="display:none" class="jdgm-prev-badge" data-average-rating="0.00"
                          data-number-of-reviews="0" data-number-of-questions="0"> <span class="jdgm-prev-badge__stars"
                            data-score="0.00" tabindex="0" aria-label="0.00 stars" role="button"> <span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span> </span> <span class="jdgm-prev-badge__text"> No
                            reviews </span> </div>
                      </div>
                      <!-- End of Judge.me code -->

                    </div>
                    <div id="ProductInfo-template--17996521046172__collection_slider_CHHC4j-8446922162332"
                      class="product-content-bottom">
                      <div class="product-selectors">


                      </div>
                      <product-form class="product-form">
                        <div class="wbquicksuccess hidden" hidden="">Translation missing:
                          en.wbcustomlabel.wballtext.quicksuccessmsg</div>
                        <div class="product-form__error-message-wrapper" role="alert" hidden="">
                          <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-error"
                            viewBox="0 0 13 13" width="25" height="25">
                            <circle cx="6.5" cy="6.50049" r="5.5" stroke="white" stroke-width="2"></circle>
                            <circle cx="6.5" cy="6.5" r="5.5" fill="#EB001B" stroke="#EB001B" stroke-width="0.7">
                            </circle>
                            <path
                              d="M5.87413 3.52832L5.97439 7.57216H7.02713L7.12739 3.52832H5.87413ZM6.50076 9.66091C6.88091 9.66091 7.18169 9.37267 7.18169 9.00504C7.18169 8.63742 6.88091 8.34917 6.50076 8.34917C6.12061 8.34917 5.81982 8.63742 5.81982 9.00504C5.81982 9.37267 6.12061 9.66091 6.50076 9.66091Z"
                              fill="white"></path>
                            <path
                              d="M5.87413 3.17832H5.51535L5.52424 3.537L5.6245 7.58083L5.63296 7.92216H5.97439H7.02713H7.36856L7.37702 7.58083L7.47728 3.537L7.48617 3.17832H7.12739H5.87413ZM6.50076 10.0109C7.06121 10.0109 7.5317 9.57872 7.5317 9.00504C7.5317 8.43137 7.06121 7.99918 6.50076 7.99918C5.94031 7.99918 5.46982 8.43137 5.46982 9.00504C5.46982 9.57872 5.94031 10.0109 6.50076 10.0109Z"
                              fill="white" stroke="#EB001B" stroke-width="0.7">
                            </path>
                          </svg>
                          <span class="product-form__error-message"></span>
                        </div>
                        <form method="post" action="cart_add.php"
                          id="product-form-template--17996521046172__collection_slider_CHHC4j-8446922162332"
                          accept-charset="UTF-8" class="form" enctype="multipart/form-data" novalidate="novalidate"
                          data-type="add-to-cart-form"><input type="hidden" name="form_type" value="product"><input
                            type="hidden" name="utf8" value="✓"><input type="hidden" name="id" value="45040275554460"
                            disabled="">
                          <div class="product-card__bottom">
                            <div class="no-js-hidden price"
                              id="price-template--17996521046172__collection_slider_CHHC4j-8446922162332" role="status">

                              <ins class="price-item--regular"><span class="money"> Lei5.00</span></ins>






                            </div>
                            <button type="submit" name="add" class="btn btn--secondary product-form__submit"
                              aria-label="Add to Cart"><span>Add to Cart</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"
                                fill="none">
                                <path
                                  d="M3.22708 14.1828L2.22412 8.19984C2.07247 7.29523 1.99665 6.84293 2.23945 6.54647C2.48226 6.25 2.92852 6.25 3.82104 6.25H16.1783C17.0708 6.25 17.5171 6.25 17.7599 6.54647C18.0027 6.84293 17.9268 7.29523 17.7753 8.19984L16.7723 14.1828C16.4398 16.1659 16.2736 17.1574 15.5949 17.7454C14.9163 18.3333 13.938 18.3333 11.9815 18.3333H8.01786C6.06131 18.3333 5.08303 18.3333 4.40438 17.7454C3.72573 17.1574 3.55952 16.1659 3.22708 14.1828Z"
                                  stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                  d="M14.5837 6.25008C14.5837 3.71877 12.5317 1.66675 10.0003 1.66675C7.46902 1.66675 5.41699 3.71877 5.41699 6.25008"
                                  stroke="currentColor" stroke-width="1.5"></path>
                              </svg>

                              <div class="loading-overlay__spinner hidden">

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                  version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 511.494 511.494"
                                  style="enable-background:new 0 0 511.494 511.494;" xml:space="preserve" width="20"
                                  height="20">
                                  <g>
                                    <path
                                      d="M478.291,255.492c-16.133,0.143-29.689,12.161-31.765,28.16c-15.37,105.014-112.961,177.685-217.975,162.315 S50.866,333.006,66.236,227.992S179.197,50.307,284.211,65.677c35.796,5.239,69.386,20.476,96.907,43.959l-24.107,24.107   c-8.33,8.332-8.328,21.84,0.004,30.17c4.015,4.014,9.465,6.262,15.142,6.246h97.835c11.782,0,21.333-9.551,21.333-21.333V50.991   c-0.003-11.782-9.556-21.331-21.338-21.329c-5.655,0.001-11.079,2.248-15.078,6.246l-28.416,28.416   C320.774-29.34,159.141-19.568,65.476,86.152S-18.415,353.505,87.304,447.17s267.353,83.892,361.017-21.828   c32.972-37.216,54.381-83.237,61.607-132.431c2.828-17.612-9.157-34.183-26.769-37.011   C481.549,255.641,479.922,255.505,478.291,255.492z">
                                    </path>
                                  </g>
                                </svg>

                              </div>
                            </button>
                          </div><input type="hidden" name="product-id" value="8446922162332"><input type="hidden"
                            name="section-id" value="template--17996521046172__collection_slider_CHHC4j">
                        </form>
                      </product-form>
                    </div>
                  </div>
                </div>

              </div>

              <div class="collection-slide swiper-slide">
                <div class="product-card-inner card-inner">
                  <div id="pro-template--17996521046172__collection_slider_CHHC4j-8446922195100"
                    class="product-card-image card__media"><a href="#shan-kofta-masala-50g"
                      title="Shan Kofta Masala 50g" class="product__media-item"
                      data-media-id="template--17996521046172__collection_slider_CHHC4j-8446922195100-33639956218012"
                      tabindex="0">
                      <img loading="lazy" class=""
                        srcset="uploads/shan_kofta_be7fe03c-d883-430f-b760-195df699cff9_600x400_v=1749653536.webp"
                        alt="">
                    </a>
                    <div class="wish-lbl-wrp">

                      <div class="pro-wishlist">
                        <label>
                          <span class="wishlist-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                              fill="none">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.1335 2.95108C16.73 4.16664 16.9557 6.44579 15.6274 7.93897L8.99983 15.3894L2.37233 7.93977C1.04381 6.44646 1.26946 4.167 2.86616 2.95128C4.50032 1.70704 6.87275 2.10393 7.99225 3.80885L8.36782 4.38082C8.59267 4.72325 9.05847 4.82238 9.40821 4.60224C9.51777 4.53328 9.60294 4.44117 9.66134 4.33666L10.0076 3.80914C11.1268 2.10394 13.4993 1.70679 15.1335 2.95108ZM8.99998 2.653C7.31724 0.526225 4.15516 0.102335 1.94184 1.78754C-0.33726 3.52284 -0.659353 6.77651 1.23696 8.90805L8.4334 16.9972C8.7065 17.3041 9.18204 17.3362 9.49557 17.0688C9.53631 17.0341 9.57231 16.996 9.60351 16.9553L16.7628 8.90721C18.6589 6.77579 18.3367 3.52246 16.0579 1.78734C13.8446 0.102142 10.6825 0.526185 8.99998 2.653Z"
                                fill=" #4F4632"></path>
                            </svg>
                          </span>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="shan-kofta-masala-50g"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="pro-compare">
                        <label>
                          <span class="compare-label">
                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M9.80006 12.5C9.66163 12.5 9.52632 12.4585 9.41123 12.3809C9.29614 12.3033 9.20644 12.193 9.15347 12.0639C9.1005 11.9349 9.08664 11.7928 9.11364 11.6558C9.14064 11.5188 9.20728 11.393 9.30515 11.2942L11.6103 8.96804H2.79991C2.61426 8.96804 2.4362 8.89361 2.30493 8.76114C2.17365 8.62866 2.0999 8.44899 2.0999 8.26164C2.0999 8.0743 2.17365 7.89462 2.30493 7.76215C2.4362 7.62967 2.61426 7.55525 2.79991 7.55525H13.3001C13.4386 7.55528 13.5739 7.59672 13.689 7.67435C13.8041 7.75197 13.8938 7.86228 13.9467 7.99134C13.9997 8.1204 14.0136 8.2624 13.9866 8.39941C13.9596 8.53642 13.8929 8.66227 13.795 8.76106L10.295 12.293C10.1637 12.4255 9.9857 12.5 9.80006 12.5ZM11.9001 4.72968C11.9001 4.54233 11.8264 4.36266 11.6951 4.23018C11.5638 4.09771 11.3857 4.02328 11.2001 4.02328H2.3897L4.69485 1.69713C4.82236 1.56391 4.89292 1.38547 4.89133 1.20025C4.88973 1.01504 4.81611 0.837869 4.68632 0.706898C4.55654 0.575927 4.38096 0.501636 4.19742 0.500027C4.01388 0.498417 3.83705 0.569618 3.70503 0.698293L0.204955 4.23026C0.107087 4.32905 0.0404406 4.4549 0.0134427 4.59191C-0.0135551 4.72892 0.000307272 4.87092 0.0532774 4.99998C0.106248 5.12904 0.195947 5.23935 0.311036 5.31697C0.426126 5.3946 0.561438 5.43604 0.699866 5.43607H11.2001C11.3857 5.43607 11.5638 5.36165 11.6951 5.22917C11.8264 5.0967 11.9001 4.91703 11.9001 4.72968Z"
                                fill="#4F4632"></path>
                            </svg>
                          </span>
                          <a class="compare-now" href="/pages/compare" style="display:none;"> Compare Now </a>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="shan-kofta-masala-50g"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="quickview-btn" id="quickview">
                        <a style="text-decoration:none" href="#shan-kofta-masala-50g"
                          data-handle="shan-kofta-masala-50g">
                          <svg width="14" height="11" viewBox="0 0 14 11" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M6.99996 3.15912C5.70988 3.15912 4.66016 4.20885 4.66016 5.49892C4.66016 6.789 5.70988 7.83873 6.99996 7.83873C8.29004 7.83873 9.33977 6.789 9.33977 5.49892C9.33977 4.20885 8.29004 3.15912 6.99996 3.15912ZM6.99996 6.8724C6.24254 6.8724 5.62648 6.25635 5.62648 5.49892C5.62648 4.7415 6.24254 4.12545 6.99996 4.12545C7.75738 4.12545 8.37344 4.7415 8.37344 5.49892C8.37344 6.25635 7.75738 6.8724 6.99996 6.8724Z"
                              fill="#4F4632"></path>
                            <path
                              d="M13.4184 4.21786C13.1537 3.8509 12.6889 3.28735 11.9785 2.68715C11.2954 2.10993 10.561 1.64782 9.79562 1.31368C8.87633 0.912544 7.9357 0.709106 7 0.709106C6.0643 0.709106 5.12367 0.912544 4.2041 1.31368C3.43875 1.64754 2.7043 2.10965 2.02125 2.68715C1.31086 3.28762 0.846016 3.8509 0.581328 4.21786C0.195781 4.7527 0 5.18418 0 5.5C0 5.81582 0.195508 6.24731 0.581602 6.78215C0.846289 7.14911 1.31113 7.71266 2.02152 8.31286C2.70457 8.89008 3.43902 9.35219 4.20437 9.68633C5.12367 10.0875 6.06457 10.2909 7.00027 10.2909C7.93598 10.2909 8.8766 10.0875 9.79617 9.68633C10.5615 9.35247 11.296 8.89036 11.979 8.31286C12.6894 7.71239 13.1543 7.14911 13.4189 6.78215C13.8045 6.24731 14 5.81582 14 5.5C14 5.18418 13.8045 4.7527 13.4184 4.21786ZM11.293 7.62653C10.3592 8.40118 8.85637 9.32457 7 9.32457C5.14363 9.32457 3.64109 8.40118 2.70703 7.62653C1.56406 6.67852 1.00816 5.73625 0.967422 5.5C1.00789 5.26375 1.56406 4.32149 2.70703 3.37348C3.64082 2.59883 5.14363 1.67543 7 1.67543C8.85609 1.67543 10.3589 2.59883 11.293 3.37348C12.4359 4.32149 12.9921 5.26375 13.0326 5.5C12.9918 5.73625 12.4359 6.67852 11.293 7.62653Z"
                              fill="#4F4632"></path>
                          </svg>
                        </a>
                      </div>

                    </div>

                  </div>
                  <div id="ProductInfo-template--17996521046172__collection_slider_CHHC4j" class="product-content">
                    <div class="product-content-top">

                      <div class="product-type">Spice Mixes</div>

                      <h3 class="product-title">
                        <a href="#shan-kofta-masala-50g">Shan Kofta Masala 50g</a>
                      </h3>

                      <!-- Start of Judge.me code -->
                      <div class="jdgm-widget jdgm-preview-badge">
                        <div style="display:none" class="jdgm-prev-badge" data-average-rating="0.00"
                          data-number-of-reviews="0" data-number-of-questions="0"> <span class="jdgm-prev-badge__stars"
                            data-score="0.00" tabindex="0" aria-label="0.00 stars" role="button"> <span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span> </span> <span class="jdgm-prev-badge__text"> No
                            reviews </span> </div>
                      </div>
                      <!-- End of Judge.me code -->

                    </div>
                    <div id="ProductInfo-template--17996521046172__collection_slider_CHHC4j-8446922195100"
                      class="product-content-bottom">
                      <div class="product-selectors">


                      </div>
                      <product-form class="product-form">
                        <div class="wbquicksuccess hidden" hidden="">Translation missing:
                          en.wbcustomlabel.wballtext.quicksuccessmsg</div>
                        <div class="product-form__error-message-wrapper" role="alert" hidden="">
                          <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-error"
                            viewBox="0 0 13 13" width="25" height="25">
                            <circle cx="6.5" cy="6.50049" r="5.5" stroke="white" stroke-width="2"></circle>
                            <circle cx="6.5" cy="6.5" r="5.5" fill="#EB001B" stroke="#EB001B" stroke-width="0.7">
                            </circle>
                            <path
                              d="M5.87413 3.52832L5.97439 7.57216H7.02713L7.12739 3.52832H5.87413ZM6.50076 9.66091C6.88091 9.66091 7.18169 9.37267 7.18169 9.00504C7.18169 8.63742 6.88091 8.34917 6.50076 8.34917C6.12061 8.34917 5.81982 8.63742 5.81982 9.00504C5.81982 9.37267 6.12061 9.66091 6.50076 9.66091Z"
                              fill="white"></path>
                            <path
                              d="M5.87413 3.17832H5.51535L5.52424 3.537L5.6245 7.58083L5.63296 7.92216H5.97439H7.02713H7.36856L7.37702 7.58083L7.47728 3.537L7.48617 3.17832H7.12739H5.87413ZM6.50076 10.0109C7.06121 10.0109 7.5317 9.57872 7.5317 9.00504C7.5317 8.43137 7.06121 7.99918 6.50076 7.99918C5.94031 7.99918 5.46982 8.43137 5.46982 9.00504C5.46982 9.57872 5.94031 10.0109 6.50076 10.0109Z"
                              fill="white" stroke="#EB001B" stroke-width="0.7">
                            </path>
                          </svg>
                          <span class="product-form__error-message"></span>
                        </div>
                        <form method="post" action="cart_add.php"
                          id="product-form-template--17996521046172__collection_slider_CHHC4j-8446922195100"
                          accept-charset="UTF-8" class="form" enctype="multipart/form-data" novalidate="novalidate"
                          data-type="add-to-cart-form"><input type="hidden" name="form_type" value="product"><input
                            type="hidden" name="utf8" value="✓"><input type="hidden" name="id" value="45040275619996"
                            disabled="">
                          <div class="product-card__bottom">
                            <div class="no-js-hidden price"
                              id="price-template--17996521046172__collection_slider_CHHC4j-8446922195100" role="status">

                              <ins class="price-item--regular"><span class="money"> Lei5.00</span></ins>






                            </div>
                            <button type="submit" name="add" class="btn btn--secondary product-form__submit"
                              aria-label="Add to Cart"><span>Add to Cart</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"
                                fill="none">
                                <path
                                  d="M3.22708 14.1828L2.22412 8.19984C2.07247 7.29523 1.99665 6.84293 2.23945 6.54647C2.48226 6.25 2.92852 6.25 3.82104 6.25H16.1783C17.0708 6.25 17.5171 6.25 17.7599 6.54647C18.0027 6.84293 17.9268 7.29523 17.7753 8.19984L16.7723 14.1828C16.4398 16.1659 16.2736 17.1574 15.5949 17.7454C14.9163 18.3333 13.938 18.3333 11.9815 18.3333H8.01786C6.06131 18.3333 5.08303 18.3333 4.40438 17.7454C3.72573 17.1574 3.55952 16.1659 3.22708 14.1828Z"
                                  stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                  d="M14.5837 6.25008C14.5837 3.71877 12.5317 1.66675 10.0003 1.66675C7.46902 1.66675 5.41699 3.71877 5.41699 6.25008"
                                  stroke="currentColor" stroke-width="1.5"></path>
                              </svg>

                              <div class="loading-overlay__spinner hidden">

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                  version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 511.494 511.494"
                                  style="enable-background:new 0 0 511.494 511.494;" xml:space="preserve" width="20"
                                  height="20">
                                  <g>
                                    <path
                                      d="M478.291,255.492c-16.133,0.143-29.689,12.161-31.765,28.16c-15.37,105.014-112.961,177.685-217.975,162.315 S50.866,333.006,66.236,227.992S179.197,50.307,284.211,65.677c35.796,5.239,69.386,20.476,96.907,43.959l-24.107,24.107   c-8.33,8.332-8.328,21.84,0.004,30.17c4.015,4.014,9.465,6.262,15.142,6.246h97.835c11.782,0,21.333-9.551,21.333-21.333V50.991   c-0.003-11.782-9.556-21.331-21.338-21.329c-5.655,0.001-11.079,2.248-15.078,6.246l-28.416,28.416   C320.774-29.34,159.141-19.568,65.476,86.152S-18.415,353.505,87.304,447.17s267.353,83.892,361.017-21.828   c32.972-37.216,54.381-83.237,61.607-132.431c2.828-17.612-9.157-34.183-26.769-37.011   C481.549,255.641,479.922,255.505,478.291,255.492z">
                                    </path>
                                  </g>
                                </svg>

                              </div>
                            </button>
                          </div><input type="hidden" name="product-id" value="8446922195100"><input type="hidden"
                            name="section-id" value="template--17996521046172__collection_slider_CHHC4j">
                        </form>
                      </product-form>
                    </div>
                  </div>
                </div>

              </div>

              <div class="collection-slide swiper-slide">
                <div class="product-card-inner card-inner">
                  <div id="pro-template--17996521046172__collection_slider_CHHC4j-8446922391708"
                    class="product-card-image card__media"><a href="#aachi-tamarind-rice-powder-100g"
                      title="Aachi Tamarind Rice Powder 100g (Puliyodharai)" class="product__media-item"
                      data-media-id="template--17996521046172__collection_slider_CHHC4j-8446922391708-33639956611228"
                      tabindex="0">
                      <img loading="lazy" class=""
                        srcset="uploads/puloitharai_1_d25a8ac1-2722-4c76-a83c-e5c4c22fe4ba_600x400_v=1749653545.webp"
                        alt="">
                    </a>
                    <div class="wish-lbl-wrp">

                      <div class="pro-wishlist">
                        <label>
                          <span class="wishlist-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                              fill="none">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.1335 2.95108C16.73 4.16664 16.9557 6.44579 15.6274 7.93897L8.99983 15.3894L2.37233 7.93977C1.04381 6.44646 1.26946 4.167 2.86616 2.95128C4.50032 1.70704 6.87275 2.10393 7.99225 3.80885L8.36782 4.38082C8.59267 4.72325 9.05847 4.82238 9.40821 4.60224C9.51777 4.53328 9.60294 4.44117 9.66134 4.33666L10.0076 3.80914C11.1268 2.10394 13.4993 1.70679 15.1335 2.95108ZM8.99998 2.653C7.31724 0.526225 4.15516 0.102335 1.94184 1.78754C-0.33726 3.52284 -0.659353 6.77651 1.23696 8.90805L8.4334 16.9972C8.7065 17.3041 9.18204 17.3362 9.49557 17.0688C9.53631 17.0341 9.57231 16.996 9.60351 16.9553L16.7628 8.90721C18.6589 6.77579 18.3367 3.52246 16.0579 1.78734C13.8446 0.102142 10.6825 0.526185 8.99998 2.653Z"
                                fill=" #4F4632"></path>
                            </svg>
                          </span>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="aachi-tamarind-rice-powder-100g"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="pro-compare">
                        <label>
                          <span class="compare-label">
                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M9.80006 12.5C9.66163 12.5 9.52632 12.4585 9.41123 12.3809C9.29614 12.3033 9.20644 12.193 9.15347 12.0639C9.1005 11.9349 9.08664 11.7928 9.11364 11.6558C9.14064 11.5188 9.20728 11.393 9.30515 11.2942L11.6103 8.96804H2.79991C2.61426 8.96804 2.4362 8.89361 2.30493 8.76114C2.17365 8.62866 2.0999 8.44899 2.0999 8.26164C2.0999 8.0743 2.17365 7.89462 2.30493 7.76215C2.4362 7.62967 2.61426 7.55525 2.79991 7.55525H13.3001C13.4386 7.55528 13.5739 7.59672 13.689 7.67435C13.8041 7.75197 13.8938 7.86228 13.9467 7.99134C13.9997 8.1204 14.0136 8.2624 13.9866 8.39941C13.9596 8.53642 13.8929 8.66227 13.795 8.76106L10.295 12.293C10.1637 12.4255 9.9857 12.5 9.80006 12.5ZM11.9001 4.72968C11.9001 4.54233 11.8264 4.36266 11.6951 4.23018C11.5638 4.09771 11.3857 4.02328 11.2001 4.02328H2.3897L4.69485 1.69713C4.82236 1.56391 4.89292 1.38547 4.89133 1.20025C4.88973 1.01504 4.81611 0.837869 4.68632 0.706898C4.55654 0.575927 4.38096 0.501636 4.19742 0.500027C4.01388 0.498417 3.83705 0.569618 3.70503 0.698293L0.204955 4.23026C0.107087 4.32905 0.0404406 4.4549 0.0134427 4.59191C-0.0135551 4.72892 0.000307272 4.87092 0.0532774 4.99998C0.106248 5.12904 0.195947 5.23935 0.311036 5.31697C0.426126 5.3946 0.561438 5.43604 0.699866 5.43607H11.2001C11.3857 5.43607 11.5638 5.36165 11.6951 5.22917C11.8264 5.0967 11.9001 4.91703 11.9001 4.72968Z"
                                fill="#4F4632"></path>
                            </svg>
                          </span>
                          <a class="compare-now" href="/pages/compare" style="display:none;"> Compare Now </a>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="aachi-tamarind-rice-powder-100g"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="quickview-btn" id="quickview">
                        <a style="text-decoration:none" href="#aachi-tamarind-rice-powder-100g"
                          data-handle="aachi-tamarind-rice-powder-100g">
                          <svg width="14" height="11" viewBox="0 0 14 11" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M6.99996 3.15912C5.70988 3.15912 4.66016 4.20885 4.66016 5.49892C4.66016 6.789 5.70988 7.83873 6.99996 7.83873C8.29004 7.83873 9.33977 6.789 9.33977 5.49892C9.33977 4.20885 8.29004 3.15912 6.99996 3.15912ZM6.99996 6.8724C6.24254 6.8724 5.62648 6.25635 5.62648 5.49892C5.62648 4.7415 6.24254 4.12545 6.99996 4.12545C7.75738 4.12545 8.37344 4.7415 8.37344 5.49892C8.37344 6.25635 7.75738 6.8724 6.99996 6.8724Z"
                              fill="#4F4632"></path>
                            <path
                              d="M13.4184 4.21786C13.1537 3.8509 12.6889 3.28735 11.9785 2.68715C11.2954 2.10993 10.561 1.64782 9.79562 1.31368C8.87633 0.912544 7.9357 0.709106 7 0.709106C6.0643 0.709106 5.12367 0.912544 4.2041 1.31368C3.43875 1.64754 2.7043 2.10965 2.02125 2.68715C1.31086 3.28762 0.846016 3.8509 0.581328 4.21786C0.195781 4.7527 0 5.18418 0 5.5C0 5.81582 0.195508 6.24731 0.581602 6.78215C0.846289 7.14911 1.31113 7.71266 2.02152 8.31286C2.70457 8.89008 3.43902 9.35219 4.20437 9.68633C5.12367 10.0875 6.06457 10.2909 7.00027 10.2909C7.93598 10.2909 8.8766 10.0875 9.79617 9.68633C10.5615 9.35247 11.296 8.89036 11.979 8.31286C12.6894 7.71239 13.1543 7.14911 13.4189 6.78215C13.8045 6.24731 14 5.81582 14 5.5C14 5.18418 13.8045 4.7527 13.4184 4.21786ZM11.293 7.62653C10.3592 8.40118 8.85637 9.32457 7 9.32457C5.14363 9.32457 3.64109 8.40118 2.70703 7.62653C1.56406 6.67852 1.00816 5.73625 0.967422 5.5C1.00789 5.26375 1.56406 4.32149 2.70703 3.37348C3.64082 2.59883 5.14363 1.67543 7 1.67543C8.85609 1.67543 10.3589 2.59883 11.293 3.37348C12.4359 4.32149 12.9921 5.26375 13.0326 5.5C12.9918 5.73625 12.4359 6.67852 11.293 7.62653Z"
                              fill="#4F4632"></path>
                          </svg>
                        </a>
                      </div>

                    </div>

                  </div>
                  <div id="ProductInfo-template--17996521046172__collection_slider_CHHC4j" class="product-content">
                    <div class="product-content-top">

                      <div class="product-type">Spice Mixes</div>

                      <h3 class="product-title">
                        <a href="#aachi-tamarind-rice-powder-100g">Aachi Tamarind Rice Powder 100g
                          (Puliyodharai)</a>
                      </h3>

                      <!-- Start of Judge.me code -->
                      <div class="jdgm-widget jdgm-preview-badge">
                        <div style="display:none" class="jdgm-prev-badge" data-average-rating="0.00"
                          data-number-of-reviews="0" data-number-of-questions="0"> <span class="jdgm-prev-badge__stars"
                            data-score="0.00" tabindex="0" aria-label="0.00 stars" role="button"> <span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span> </span> <span class="jdgm-prev-badge__text"> No
                            reviews </span> </div>
                      </div>
                      <!-- End of Judge.me code -->

                    </div>
                    <div id="ProductInfo-template--17996521046172__collection_slider_CHHC4j-8446922391708"
                      class="product-content-bottom">
                      <div class="product-selectors">


                      </div>
                      <product-form class="product-form">
                        <div class="wbquicksuccess hidden" hidden="">Translation missing:
                          en.wbcustomlabel.wballtext.quicksuccessmsg</div>
                        <div class="product-form__error-message-wrapper" role="alert" hidden="">
                          <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-error"
                            viewBox="0 0 13 13" width="25" height="25">
                            <circle cx="6.5" cy="6.50049" r="5.5" stroke="white" stroke-width="2"></circle>
                            <circle cx="6.5" cy="6.5" r="5.5" fill="#EB001B" stroke="#EB001B" stroke-width="0.7">
                            </circle>
                            <path
                              d="M5.87413 3.52832L5.97439 7.57216H7.02713L7.12739 3.52832H5.87413ZM6.50076 9.66091C6.88091 9.66091 7.18169 9.37267 7.18169 9.00504C7.18169 8.63742 6.88091 8.34917 6.50076 8.34917C6.12061 8.34917 5.81982 8.63742 5.81982 9.00504C5.81982 9.37267 6.12061 9.66091 6.50076 9.66091Z"
                              fill="white"></path>
                            <path
                              d="M5.87413 3.17832H5.51535L5.52424 3.537L5.6245 7.58083L5.63296 7.92216H5.97439H7.02713H7.36856L7.37702 7.58083L7.47728 3.537L7.48617 3.17832H7.12739H5.87413ZM6.50076 10.0109C7.06121 10.0109 7.5317 9.57872 7.5317 9.00504C7.5317 8.43137 7.06121 7.99918 6.50076 7.99918C5.94031 7.99918 5.46982 8.43137 5.46982 9.00504C5.46982 9.57872 5.94031 10.0109 6.50076 10.0109Z"
                              fill="white" stroke="#EB001B" stroke-width="0.7">
                            </path>
                          </svg>
                          <span class="product-form__error-message"></span>
                        </div>
                        <form method="post" action="cart_add.php"
                          id="product-form-template--17996521046172__collection_slider_CHHC4j-8446922391708"
                          accept-charset="UTF-8" class="form" enctype="multipart/form-data" novalidate="novalidate"
                          data-type="add-to-cart-form"><input type="hidden" name="form_type" value="product"><input
                            type="hidden" name="utf8" value="✓"><input type="hidden" name="id" value="45040275947676"
                            disabled="">
                          <div class="product-card__bottom">
                            <div class="no-js-hidden price"
                              id="price-template--17996521046172__collection_slider_CHHC4j-8446922391708" role="status">

                              <ins class="price-item--regular"><span class="money"> Lei5.00</span></ins>






                            </div>
                            <button type="submit" name="add" class="btn btn--secondary product-form__submit"
                              aria-label="Add to Cart"><span>Add to Cart</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"
                                fill="none">
                                <path
                                  d="M3.22708 14.1828L2.22412 8.19984C2.07247 7.29523 1.99665 6.84293 2.23945 6.54647C2.48226 6.25 2.92852 6.25 3.82104 6.25H16.1783C17.0708 6.25 17.5171 6.25 17.7599 6.54647C18.0027 6.84293 17.9268 7.29523 17.7753 8.19984L16.7723 14.1828C16.4398 16.1659 16.2736 17.1574 15.5949 17.7454C14.9163 18.3333 13.938 18.3333 11.9815 18.3333H8.01786C6.06131 18.3333 5.08303 18.3333 4.40438 17.7454C3.72573 17.1574 3.55952 16.1659 3.22708 14.1828Z"
                                  stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                  d="M14.5837 6.25008C14.5837 3.71877 12.5317 1.66675 10.0003 1.66675C7.46902 1.66675 5.41699 3.71877 5.41699 6.25008"
                                  stroke="currentColor" stroke-width="1.5"></path>
                              </svg>

                              <div class="loading-overlay__spinner hidden">

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                  version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 511.494 511.494"
                                  style="enable-background:new 0 0 511.494 511.494;" xml:space="preserve" width="20"
                                  height="20">
                                  <g>
                                    <path
                                      d="M478.291,255.492c-16.133,0.143-29.689,12.161-31.765,28.16c-15.37,105.014-112.961,177.685-217.975,162.315 S50.866,333.006,66.236,227.992S179.197,50.307,284.211,65.677c35.796,5.239,69.386,20.476,96.907,43.959l-24.107,24.107   c-8.33,8.332-8.328,21.84,0.004,30.17c4.015,4.014,9.465,6.262,15.142,6.246h97.835c11.782,0,21.333-9.551,21.333-21.333V50.991   c-0.003-11.782-9.556-21.331-21.338-21.329c-5.655,0.001-11.079,2.248-15.078,6.246l-28.416,28.416   C320.774-29.34,159.141-19.568,65.476,86.152S-18.415,353.505,87.304,447.17s267.353,83.892,361.017-21.828   c32.972-37.216,54.381-83.237,61.607-132.431c2.828-17.612-9.157-34.183-26.769-37.011   C481.549,255.641,479.922,255.505,478.291,255.492z">
                                    </path>
                                  </g>
                                </svg>

                              </div>
                            </button>
                          </div><input type="hidden" name="product-id" value="8446922391708"><input type="hidden"
                            name="section-id" value="template--17996521046172__collection_slider_CHHC4j">
                        </form>
                      </product-form>
                    </div>
                  </div>
                </div>

              </div>

            </div>
          </div>
        </div>
      </div>

      <script>
        document.addEventListener('DOMContentLoaded', function () {
          const swiper = new Swiper('.collection-slider__swiper', {
            speed: 400,
            spaceBetween: 18,
            slidesPerView: 'auto',
            slidesPerGroup: 1,
            slideShadows: true,
            breakpoints: {
              1200: {
                slidesPerView: 4,
                spaceBetween: 40,
              },
              767: {
                slidesPerView: 3,
              },
            },
          });
        });
      </script>


    </div>
    <div id="shopify-section-template--17996521046172__collection_slider_c7fFVc" class="shopify-section">
      <style>
        .collection-slider__container {
          overflow: hidden;
        }

        .collection-slider__header {
          display: flex;
          flex-wrap: nowrap;
          justify-content: space-between;
          align-items: center;
          padding-bottom: 26px;
        }

        .collection-slider__swiper .collection-slide {
          max-width: 316px;
        }

        .collection-slider__swiper .collection-slide .product-card-inner.card-inner {
          height: 100%;
        }


        @media screen and (max-width: 767px) {
          .collection-slider__swiper .collection-slide {
            max-width: 265px;
          }
        }
      </style>

      <div class="collection-slider__wrap">
        <div class="collection-slider__container container padding-bottom">
          <div class="collection-slider__header">
            <h3 class="collection-slider__title">
              Best Sellers
            </h3>

            <a href="shop.php?category=best-sellers" class="btn btn--secondary btn--lg btn--arrow">
              Show more

              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round"></path>
                <path d="M15 17C15 17 20 13.3176 20 12C20 10.6824 15 7 15 7" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>

            </a>

          </div>
          <div class="collection-slider__swiper">
            <div class="swiper-wrapper">

              <div class="collection-slide swiper-slide">
                <div class="product-card-inner card-inner">
                  <div id="pro-template--17996521046172__collection_slider_c7fFVc-8326667403420"
                    class="product-card-image card__media"><a href="#double-horse-instant-idiyappam-white-200g"
                      title="Double Horse Instant Idiyappam White 200g" class="product__media-item"
                      data-media-id="template--17996521046172__collection_slider_c7fFVc-8326667403420-32766613291164"
                      tabindex="0">
                      <img loading="lazy" class=""
                        srcset="uploads/dhinstantidiyappamwhite-removebg_600x400_v=1738749188.png"
                        alt="A packaged product of Double Horse Instant Idiyappam White, which is a rice noodle mix, with branding and product information displayed on the box.">
                    </a>
                    <div class="wish-lbl-wrp">

                      <div class="pro-wishlist">
                        <label>
                          <span class="wishlist-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                              fill="none">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.1335 2.95108C16.73 4.16664 16.9557 6.44579 15.6274 7.93897L8.99983 15.3894L2.37233 7.93977C1.04381 6.44646 1.26946 4.167 2.86616 2.95128C4.50032 1.70704 6.87275 2.10393 7.99225 3.80885L8.36782 4.38082C8.59267 4.72325 9.05847 4.82238 9.40821 4.60224C9.51777 4.53328 9.60294 4.44117 9.66134 4.33666L10.0076 3.80914C11.1268 2.10394 13.4993 1.70679 15.1335 2.95108ZM8.99998 2.653C7.31724 0.526225 4.15516 0.102335 1.94184 1.78754C-0.33726 3.52284 -0.659353 6.77651 1.23696 8.90805L8.4334 16.9972C8.7065 17.3041 9.18204 17.3362 9.49557 17.0688C9.53631 17.0341 9.57231 16.996 9.60351 16.9553L16.7628 8.90721C18.6589 6.77579 18.3367 3.52246 16.0579 1.78734C13.8446 0.102142 10.6825 0.526185 8.99998 2.653Z"
                                fill=" #4F4632"></path>
                            </svg>
                          </span>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="double-horse-instant-idiyappam-white-200g"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="pro-compare">
                        <label>
                          <span class="compare-label">
                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M9.80006 12.5C9.66163 12.5 9.52632 12.4585 9.41123 12.3809C9.29614 12.3033 9.20644 12.193 9.15347 12.0639C9.1005 11.9349 9.08664 11.7928 9.11364 11.6558C9.14064 11.5188 9.20728 11.393 9.30515 11.2942L11.6103 8.96804H2.79991C2.61426 8.96804 2.4362 8.89361 2.30493 8.76114C2.17365 8.62866 2.0999 8.44899 2.0999 8.26164C2.0999 8.0743 2.17365 7.89462 2.30493 7.76215C2.4362 7.62967 2.61426 7.55525 2.79991 7.55525H13.3001C13.4386 7.55528 13.5739 7.59672 13.689 7.67435C13.8041 7.75197 13.8938 7.86228 13.9467 7.99134C13.9997 8.1204 14.0136 8.2624 13.9866 8.39941C13.9596 8.53642 13.8929 8.66227 13.795 8.76106L10.295 12.293C10.1637 12.4255 9.9857 12.5 9.80006 12.5ZM11.9001 4.72968C11.9001 4.54233 11.8264 4.36266 11.6951 4.23018C11.5638 4.09771 11.3857 4.02328 11.2001 4.02328H2.3897L4.69485 1.69713C4.82236 1.56391 4.89292 1.38547 4.89133 1.20025C4.88973 1.01504 4.81611 0.837869 4.68632 0.706898C4.55654 0.575927 4.38096 0.501636 4.19742 0.500027C4.01388 0.498417 3.83705 0.569618 3.70503 0.698293L0.204955 4.23026C0.107087 4.32905 0.0404406 4.4549 0.0134427 4.59191C-0.0135551 4.72892 0.000307272 4.87092 0.0532774 4.99998C0.106248 5.12904 0.195947 5.23935 0.311036 5.31697C0.426126 5.3946 0.561438 5.43604 0.699866 5.43607H11.2001C11.3857 5.43607 11.5638 5.36165 11.6951 5.22917C11.8264 5.0967 11.9001 4.91703 11.9001 4.72968Z"
                                fill="#4F4632"></path>
                            </svg>
                          </span>
                          <a class="compare-now" href="/pages/compare" style="display:none;"> Compare Now </a>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="double-horse-instant-idiyappam-white-200g"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="quickview-btn" id="quickview">
                        <a style="text-decoration:none" href="#double-horse-instant-idiyappam-white-200g"
                          data-handle="double-horse-instant-idiyappam-white-200g">
                          <svg width="14" height="11" viewBox="0 0 14 11" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M6.99996 3.15912C5.70988 3.15912 4.66016 4.20885 4.66016 5.49892C4.66016 6.789 5.70988 7.83873 6.99996 7.83873C8.29004 7.83873 9.33977 6.789 9.33977 5.49892C9.33977 4.20885 8.29004 3.15912 6.99996 3.15912ZM6.99996 6.8724C6.24254 6.8724 5.62648 6.25635 5.62648 5.49892C5.62648 4.7415 6.24254 4.12545 6.99996 4.12545C7.75738 4.12545 8.37344 4.7415 8.37344 5.49892C8.37344 6.25635 7.75738 6.8724 6.99996 6.8724Z"
                              fill="#4F4632"></path>
                            <path
                              d="M13.4184 4.21786C13.1537 3.8509 12.6889 3.28735 11.9785 2.68715C11.2954 2.10993 10.561 1.64782 9.79562 1.31368C8.87633 0.912544 7.9357 0.709106 7 0.709106C6.0643 0.709106 5.12367 0.912544 4.2041 1.31368C3.43875 1.64754 2.7043 2.10965 2.02125 2.68715C1.31086 3.28762 0.846016 3.8509 0.581328 4.21786C0.195781 4.7527 0 5.18418 0 5.5C0 5.81582 0.195508 6.24731 0.581602 6.78215C0.846289 7.14911 1.31113 7.71266 2.02152 8.31286C2.70457 8.89008 3.43902 9.35219 4.20437 9.68633C5.12367 10.0875 6.06457 10.2909 7.00027 10.2909C7.93598 10.2909 8.8766 10.0875 9.79617 9.68633C10.5615 9.35247 11.296 8.89036 11.979 8.31286C12.6894 7.71239 13.1543 7.14911 13.4189 6.78215C13.8045 6.24731 14 5.81582 14 5.5C14 5.18418 13.8045 4.7527 13.4184 4.21786ZM11.293 7.62653C10.3592 8.40118 8.85637 9.32457 7 9.32457C5.14363 9.32457 3.64109 8.40118 2.70703 7.62653C1.56406 6.67852 1.00816 5.73625 0.967422 5.5C1.00789 5.26375 1.56406 4.32149 2.70703 3.37348C3.64082 2.59883 5.14363 1.67543 7 1.67543C8.85609 1.67543 10.3589 2.59883 11.293 3.37348C12.4359 4.32149 12.9921 5.26375 13.0326 5.5C12.9918 5.73625 12.4359 6.67852 11.293 7.62653Z"
                              fill="#4F4632"></path>
                          </svg>
                        </a>
                      </div>

                    </div>

                  </div>
                  <div id="ProductInfo-template--17996521046172__collection_slider_c7fFVc" class="product-content">
                    <div class="product-content-top">

                      <div class="product-type"></div>

                      <h3 class="product-title">
                        <a href="#double-horse-instant-idiyappam-white-200g">Double Horse Instant Idiyappam
                          White 200g</a>
                      </h3>

                      <!-- Start of Judge.me code -->
                      <div class="jdgm-widget jdgm-preview-badge">
                        <div style="display:none" class="jdgm-prev-badge" data-average-rating="0.00"
                          data-number-of-reviews="0" data-number-of-questions="0"> <span class="jdgm-prev-badge__stars"
                            data-score="0.00" tabindex="0" aria-label="0.00 stars" role="button"> <span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span> </span> <span class="jdgm-prev-badge__text"> No
                            reviews </span> </div>
                      </div>
                      <!-- End of Judge.me code -->

                    </div>
                    <div id="ProductInfo-template--17996521046172__collection_slider_c7fFVc-8326667403420"
                      class="product-content-bottom">
                      <div class="product-selectors">


                      </div>
                      <product-form class="product-form">
                        <div class="wbquicksuccess hidden" hidden="">Translation missing:
                          en.wbcustomlabel.wballtext.quicksuccessmsg</div>
                        <div class="product-form__error-message-wrapper" role="alert" hidden="">
                          <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-error"
                            viewBox="0 0 13 13" width="25" height="25">
                            <circle cx="6.5" cy="6.50049" r="5.5" stroke="white" stroke-width="2"></circle>
                            <circle cx="6.5" cy="6.5" r="5.5" fill="#EB001B" stroke="#EB001B" stroke-width="0.7">
                            </circle>
                            <path
                              d="M5.87413 3.52832L5.97439 7.57216H7.02713L7.12739 3.52832H5.87413ZM6.50076 9.66091C6.88091 9.66091 7.18169 9.37267 7.18169 9.00504C7.18169 8.63742 6.88091 8.34917 6.50076 8.34917C6.12061 8.34917 5.81982 8.63742 5.81982 9.00504C5.81982 9.37267 6.12061 9.66091 6.50076 9.66091Z"
                              fill="white"></path>
                            <path
                              d="M5.87413 3.17832H5.51535L5.52424 3.537L5.6245 7.58083L5.63296 7.92216H5.97439H7.02713H7.36856L7.37702 7.58083L7.47728 3.537L7.48617 3.17832H7.12739H5.87413ZM6.50076 10.0109C7.06121 10.0109 7.5317 9.57872 7.5317 9.00504C7.5317 8.43137 7.06121 7.99918 6.50076 7.99918C5.94031 7.99918 5.46982 8.43137 5.46982 9.00504C5.46982 9.57872 5.94031 10.0109 6.50076 10.0109Z"
                              fill="white" stroke="#EB001B" stroke-width="0.7">
                            </path>
                          </svg>
                          <span class="product-form__error-message"></span>
                        </div>
                        <form method="post" action="cart_add.php"
                          id="product-form-template--17996521046172__collection_slider_c7fFVc-8326667403420"
                          accept-charset="UTF-8" class="form" enctype="multipart/form-data" novalidate="novalidate"
                          data-type="add-to-cart-form"><input type="hidden" name="form_type" value="product"><input
                            type="hidden" name="utf8" value="✓"><input type="hidden" name="id" value="44683026038940"
                            disabled="">
                          <div class="product-card__bottom">
                            <div class="no-js-hidden price"
                              id="price-template--17996521046172__collection_slider_c7fFVc-8326667403420" role="status">

                              <ins class="price-item--regular"><span class="money"> Lei11.19</span></ins>

                              <del class="price-item--sale">

                                <span class="money"> Lei15.99</span>

                              </del>




                              <span class="price-item--discount">
                                30% off
                              </span>



                            </div>
                            <button type="submit" name="add" class="btn btn--secondary product-form__submit"
                              aria-label="Add to Cart"><span>Add to Cart</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"
                                fill="none">
                                <path
                                  d="M3.22708 14.1828L2.22412 8.19984C2.07247 7.29523 1.99665 6.84293 2.23945 6.54647C2.48226 6.25 2.92852 6.25 3.82104 6.25H16.1783C17.0708 6.25 17.5171 6.25 17.7599 6.54647C18.0027 6.84293 17.9268 7.29523 17.7753 8.19984L16.7723 14.1828C16.4398 16.1659 16.2736 17.1574 15.5949 17.7454C14.9163 18.3333 13.938 18.3333 11.9815 18.3333H8.01786C6.06131 18.3333 5.08303 18.3333 4.40438 17.7454C3.72573 17.1574 3.55952 16.1659 3.22708 14.1828Z"
                                  stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                  d="M14.5837 6.25008C14.5837 3.71877 12.5317 1.66675 10.0003 1.66675C7.46902 1.66675 5.41699 3.71877 5.41699 6.25008"
                                  stroke="currentColor" stroke-width="1.5"></path>
                              </svg>

                              <div class="loading-overlay__spinner hidden">

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                  version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 511.494 511.494"
                                  style="enable-background:new 0 0 511.494 511.494;" xml:space="preserve" width="20"
                                  height="20">
                                  <g>
                                    <path
                                      d="M478.291,255.492c-16.133,0.143-29.689,12.161-31.765,28.16c-15.37,105.014-112.961,177.685-217.975,162.315 S50.866,333.006,66.236,227.992S179.197,50.307,284.211,65.677c35.796,5.239,69.386,20.476,96.907,43.959l-24.107,24.107   c-8.33,8.332-8.328,21.84,0.004,30.17c4.015,4.014,9.465,6.262,15.142,6.246h97.835c11.782,0,21.333-9.551,21.333-21.333V50.991   c-0.003-11.782-9.556-21.331-21.338-21.329c-5.655,0.001-11.079,2.248-15.078,6.246l-28.416,28.416   C320.774-29.34,159.141-19.568,65.476,86.152S-18.415,353.505,87.304,447.17s267.353,83.892,361.017-21.828   c32.972-37.216,54.381-83.237,61.607-132.431c2.828-17.612-9.157-34.183-26.769-37.011   C481.549,255.641,479.922,255.505,478.291,255.492z">
                                    </path>
                                  </g>
                                </svg>

                              </div>
                            </button>
                          </div><input type="hidden" name="product-id" value="8326667403420"><input type="hidden"
                            name="section-id" value="template--17996521046172__collection_slider_c7fFVc">
                        </form>
                      </product-form>
                    </div>
                  </div>
                </div>

              </div>

              <div class="collection-slide swiper-slide">
                <div class="product-card-inner card-inner">
                  <div id="pro-template--17996521046172__collection_slider_c7fFVc-8263802224796"
                    class="product-card-image card__media"><a href="#sweekar-soya-chunks-big-250g"
                      title="Sweekar Soya Chunks Big 250g" class="product__media-item"
                      data-media-id="template--17996521046172__collection_slider_c7fFVc-8263802224796-32086218244252"
                      tabindex="0">
                      <img loading="lazy" class=""
                        srcset="uploads/soyachunks250g_f8a96a80-2553-4515-bbe2-66a0953521b5_600x400_v=1726481469.png"
                        alt="">
                    </a>
                    <div class="wish-lbl-wrp">

                      <div class="pro-wishlist">
                        <label>
                          <span class="wishlist-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                              fill="none">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.1335 2.95108C16.73 4.16664 16.9557 6.44579 15.6274 7.93897L8.99983 15.3894L2.37233 7.93977C1.04381 6.44646 1.26946 4.167 2.86616 2.95128C4.50032 1.70704 6.87275 2.10393 7.99225 3.80885L8.36782 4.38082C8.59267 4.72325 9.05847 4.82238 9.40821 4.60224C9.51777 4.53328 9.60294 4.44117 9.66134 4.33666L10.0076 3.80914C11.1268 2.10394 13.4993 1.70679 15.1335 2.95108ZM8.99998 2.653C7.31724 0.526225 4.15516 0.102335 1.94184 1.78754C-0.33726 3.52284 -0.659353 6.77651 1.23696 8.90805L8.4334 16.9972C8.7065 17.3041 9.18204 17.3362 9.49557 17.0688C9.53631 17.0341 9.57231 16.996 9.60351 16.9553L16.7628 8.90721C18.6589 6.77579 18.3367 3.52246 16.0579 1.78734C13.8446 0.102142 10.6825 0.526185 8.99998 2.653Z"
                                fill=" #4F4632"></path>
                            </svg>
                          </span>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="sweekar-soya-chunks-big-250g"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="pro-compare">
                        <label>
                          <span class="compare-label">
                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M9.80006 12.5C9.66163 12.5 9.52632 12.4585 9.41123 12.3809C9.29614 12.3033 9.20644 12.193 9.15347 12.0639C9.1005 11.9349 9.08664 11.7928 9.11364 11.6558C9.14064 11.5188 9.20728 11.393 9.30515 11.2942L11.6103 8.96804H2.79991C2.61426 8.96804 2.4362 8.89361 2.30493 8.76114C2.17365 8.62866 2.0999 8.44899 2.0999 8.26164C2.0999 8.0743 2.17365 7.89462 2.30493 7.76215C2.4362 7.62967 2.61426 7.55525 2.79991 7.55525H13.3001C13.4386 7.55528 13.5739 7.59672 13.689 7.67435C13.8041 7.75197 13.8938 7.86228 13.9467 7.99134C13.9997 8.1204 14.0136 8.2624 13.9866 8.39941C13.9596 8.53642 13.8929 8.66227 13.795 8.76106L10.295 12.293C10.1637 12.4255 9.9857 12.5 9.80006 12.5ZM11.9001 4.72968C11.9001 4.54233 11.8264 4.36266 11.6951 4.23018C11.5638 4.09771 11.3857 4.02328 11.2001 4.02328H2.3897L4.69485 1.69713C4.82236 1.56391 4.89292 1.38547 4.89133 1.20025C4.88973 1.01504 4.81611 0.837869 4.68632 0.706898C4.55654 0.575927 4.38096 0.501636 4.19742 0.500027C4.01388 0.498417 3.83705 0.569618 3.70503 0.698293L0.204955 4.23026C0.107087 4.32905 0.0404406 4.4549 0.0134427 4.59191C-0.0135551 4.72892 0.000307272 4.87092 0.0532774 4.99998C0.106248 5.12904 0.195947 5.23935 0.311036 5.31697C0.426126 5.3946 0.561438 5.43604 0.699866 5.43607H11.2001C11.3857 5.43607 11.5638 5.36165 11.6951 5.22917C11.8264 5.0967 11.9001 4.91703 11.9001 4.72968Z"
                                fill="#4F4632"></path>
                            </svg>
                          </span>
                          <a class="compare-now" href="/pages/compare" style="display:none;"> Compare Now </a>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="sweekar-soya-chunks-big-250g"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="quickview-btn" id="quickview">
                        <a style="text-decoration:none" href="#sweekar-soya-chunks-big-250g"
                          data-handle="sweekar-soya-chunks-big-250g">
                          <svg width="14" height="11" viewBox="0 0 14 11" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M6.99996 3.15912C5.70988 3.15912 4.66016 4.20885 4.66016 5.49892C4.66016 6.789 5.70988 7.83873 6.99996 7.83873C8.29004 7.83873 9.33977 6.789 9.33977 5.49892C9.33977 4.20885 8.29004 3.15912 6.99996 3.15912ZM6.99996 6.8724C6.24254 6.8724 5.62648 6.25635 5.62648 5.49892C5.62648 4.7415 6.24254 4.12545 6.99996 4.12545C7.75738 4.12545 8.37344 4.7415 8.37344 5.49892C8.37344 6.25635 7.75738 6.8724 6.99996 6.8724Z"
                              fill="#4F4632"></path>
                            <path
                              d="M13.4184 4.21786C13.1537 3.8509 12.6889 3.28735 11.9785 2.68715C11.2954 2.10993 10.561 1.64782 9.79562 1.31368C8.87633 0.912544 7.9357 0.709106 7 0.709106C6.0643 0.709106 5.12367 0.912544 4.2041 1.31368C3.43875 1.64754 2.7043 2.10965 2.02125 2.68715C1.31086 3.28762 0.846016 3.8509 0.581328 4.21786C0.195781 4.7527 0 5.18418 0 5.5C0 5.81582 0.195508 6.24731 0.581602 6.78215C0.846289 7.14911 1.31113 7.71266 2.02152 8.31286C2.70457 8.89008 3.43902 9.35219 4.20437 9.68633C5.12367 10.0875 6.06457 10.2909 7.00027 10.2909C7.93598 10.2909 8.8766 10.0875 9.79617 9.68633C10.5615 9.35247 11.296 8.89036 11.979 8.31286C12.6894 7.71239 13.1543 7.14911 13.4189 6.78215C13.8045 6.24731 14 5.81582 14 5.5C14 5.18418 13.8045 4.7527 13.4184 4.21786ZM11.293 7.62653C10.3592 8.40118 8.85637 9.32457 7 9.32457C5.14363 9.32457 3.64109 8.40118 2.70703 7.62653C1.56406 6.67852 1.00816 5.73625 0.967422 5.5C1.00789 5.26375 1.56406 4.32149 2.70703 3.37348C3.64082 2.59883 5.14363 1.67543 7 1.67543C8.85609 1.67543 10.3589 2.59883 11.293 3.37348C12.4359 4.32149 12.9921 5.26375 13.0326 5.5C12.9918 5.73625 12.4359 6.67852 11.293 7.62653Z"
                              fill="#4F4632"></path>
                          </svg>
                        </a>
                      </div>

                    </div>

                  </div>
                  <div id="ProductInfo-template--17996521046172__collection_slider_c7fFVc" class="product-content">
                    <div class="product-content-top">

                      <div class="product-type">Soya</div>

                      <h3 class="product-title">
                        <a href="#sweekar-soya-chunks-big-250g">Sweekar Soya Chunks Big 250g</a>
                      </h3>

                      <!-- Start of Judge.me code -->
                      <div class="jdgm-widget jdgm-preview-badge">
                        <div style="display:none" class="jdgm-prev-badge" data-average-rating="0.00"
                          data-number-of-reviews="0" data-number-of-questions="0"> <span class="jdgm-prev-badge__stars"
                            data-score="0.00" tabindex="0" aria-label="0.00 stars" role="button"> <span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span> </span> <span class="jdgm-prev-badge__text"> No
                            reviews </span> </div>
                      </div>
                      <!-- End of Judge.me code -->

                    </div>
                    <div id="ProductInfo-template--17996521046172__collection_slider_c7fFVc-8263802224796"
                      class="product-content-bottom">
                      <div class="product-selectors">


                      </div>
                      <product-form class="product-form">
                        <div class="wbquicksuccess hidden" hidden="">Translation missing:
                          en.wbcustomlabel.wballtext.quicksuccessmsg</div>
                        <div class="product-form__error-message-wrapper" role="alert" hidden="">
                          <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-error"
                            viewBox="0 0 13 13" width="25" height="25">
                            <circle cx="6.5" cy="6.50049" r="5.5" stroke="white" stroke-width="2"></circle>
                            <circle cx="6.5" cy="6.5" r="5.5" fill="#EB001B" stroke="#EB001B" stroke-width="0.7">
                            </circle>
                            <path
                              d="M5.87413 3.52832L5.97439 7.57216H7.02713L7.12739 3.52832H5.87413ZM6.50076 9.66091C6.88091 9.66091 7.18169 9.37267 7.18169 9.00504C7.18169 8.63742 6.88091 8.34917 6.50076 8.34917C6.12061 8.34917 5.81982 8.63742 5.81982 9.00504C5.81982 9.37267 6.12061 9.66091 6.50076 9.66091Z"
                              fill="white"></path>
                            <path
                              d="M5.87413 3.17832H5.51535L5.52424 3.537L5.6245 7.58083L5.63296 7.92216H5.97439H7.02713H7.36856L7.37702 7.58083L7.47728 3.537L7.48617 3.17832H7.12739H5.87413ZM6.50076 10.0109C7.06121 10.0109 7.5317 9.57872 7.5317 9.00504C7.5317 8.43137 7.06121 7.99918 6.50076 7.99918C5.94031 7.99918 5.46982 8.43137 5.46982 9.00504C5.46982 9.57872 5.94031 10.0109 6.50076 10.0109Z"
                              fill="white" stroke="#EB001B" stroke-width="0.7">
                            </path>
                          </svg>
                          <span class="product-form__error-message"></span>
                        </div>
                        <form method="post" action="cart_add.php"
                          id="product-form-template--17996521046172__collection_slider_c7fFVc-8263802224796"
                          accept-charset="UTF-8" class="form" enctype="multipart/form-data" novalidate="novalidate"
                          data-type="add-to-cart-form"><input type="hidden" name="form_type" value="product"><input
                            type="hidden" name="utf8" value="✓"><input type="hidden" name="id" value="44459682398364"
                            disabled="">
                          <div class="product-card__bottom">
                            <div class="no-js-hidden price"
                              id="price-template--17996521046172__collection_slider_c7fFVc-8263802224796" role="status">

                              <ins class="price-item--regular"><span class="money"> Lei5.99</span></ins>

                              <del class="price-item--sale">

                                <span class="money"> Lei9.99</span>

                              </del>




                              <span class="price-item--discount">
                                40% off
                              </span>



                            </div>
                            <button type="submit" name="add" class="btn btn--secondary product-form__submit"
                              aria-label="Add to Cart"><span>Add to Cart</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"
                                fill="none">
                                <path
                                  d="M3.22708 14.1828L2.22412 8.19984C2.07247 7.29523 1.99665 6.84293 2.23945 6.54647C2.48226 6.25 2.92852 6.25 3.82104 6.25H16.1783C17.0708 6.25 17.5171 6.25 17.7599 6.54647C18.0027 6.84293 17.9268 7.29523 17.7753 8.19984L16.7723 14.1828C16.4398 16.1659 16.2736 17.1574 15.5949 17.7454C14.9163 18.3333 13.938 18.3333 11.9815 18.3333H8.01786C6.06131 18.3333 5.08303 18.3333 4.40438 17.7454C3.72573 17.1574 3.55952 16.1659 3.22708 14.1828Z"
                                  stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                  d="M14.5837 6.25008C14.5837 3.71877 12.5317 1.66675 10.0003 1.66675C7.46902 1.66675 5.41699 3.71877 5.41699 6.25008"
                                  stroke="currentColor" stroke-width="1.5"></path>
                              </svg>

                              <div class="loading-overlay__spinner hidden">

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                  version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 511.494 511.494"
                                  style="enable-background:new 0 0 511.494 511.494;" xml:space="preserve" width="20"
                                  height="20">
                                  <g>
                                    <path
                                      d="M478.291,255.492c-16.133,0.143-29.689,12.161-31.765,28.16c-15.37,105.014-112.961,177.685-217.975,162.315 S50.866,333.006,66.236,227.992S179.197,50.307,284.211,65.677c35.796,5.239,69.386,20.476,96.907,43.959l-24.107,24.107   c-8.33,8.332-8.328,21.84,0.004,30.17c4.015,4.014,9.465,6.262,15.142,6.246h97.835c11.782,0,21.333-9.551,21.333-21.333V50.991   c-0.003-11.782-9.556-21.331-21.338-21.329c-5.655,0.001-11.079,2.248-15.078,6.246l-28.416,28.416   C320.774-29.34,159.141-19.568,65.476,86.152S-18.415,353.505,87.304,447.17s267.353,83.892,361.017-21.828   c32.972-37.216,54.381-83.237,61.607-132.431c2.828-17.612-9.157-34.183-26.769-37.011   C481.549,255.641,479.922,255.505,478.291,255.492z">
                                    </path>
                                  </g>
                                </svg>

                              </div>
                            </button>
                          </div><input type="hidden" name="product-id" value="8263802224796"><input type="hidden"
                            name="section-id" value="template--17996521046172__collection_slider_c7fFVc">
                        </form>
                      </product-form>
                    </div>
                  </div>
                </div>

              </div>

              <div class="collection-slide swiper-slide">
                <div class="product-card-inner card-inner">
                  <div id="pro-template--17996521046172__collection_slider_c7fFVc-8263802519708"
                    class="product-card-image card__media"><a href="#sweekar-puffed-rice-murmura-500g"
                      title="Sweekar Puffed Rice (Murmura) 500g" class="product__media-item"
                      data-media-id="template--17996521046172__collection_slider_c7fFVc-8263802519708-32086218834076"
                      tabindex="0">
                      <img loading="lazy" class=""
                        srcset="uploads/puffedrice_bb99e095-8500-42fa-b3c7-d77a8425cc2f_600x400_v=1726737705.jpg"
                        alt="">
                    </a>
                    <div class="wish-lbl-wrp">

                      <div class="pro-wishlist">
                        <label>
                          <span class="wishlist-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                              fill="none">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.1335 2.95108C16.73 4.16664 16.9557 6.44579 15.6274 7.93897L8.99983 15.3894L2.37233 7.93977C1.04381 6.44646 1.26946 4.167 2.86616 2.95128C4.50032 1.70704 6.87275 2.10393 7.99225 3.80885L8.36782 4.38082C8.59267 4.72325 9.05847 4.82238 9.40821 4.60224C9.51777 4.53328 9.60294 4.44117 9.66134 4.33666L10.0076 3.80914C11.1268 2.10394 13.4993 1.70679 15.1335 2.95108ZM8.99998 2.653C7.31724 0.526225 4.15516 0.102335 1.94184 1.78754C-0.33726 3.52284 -0.659353 6.77651 1.23696 8.90805L8.4334 16.9972C8.7065 17.3041 9.18204 17.3362 9.49557 17.0688C9.53631 17.0341 9.57231 16.996 9.60351 16.9553L16.7628 8.90721C18.6589 6.77579 18.3367 3.52246 16.0579 1.78734C13.8446 0.102142 10.6825 0.526185 8.99998 2.653Z"
                                fill=" #4F4632"></path>
                            </svg>
                          </span>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="sweekar-puffed-rice-murmura-500g"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="pro-compare">
                        <label>
                          <span class="compare-label">
                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M9.80006 12.5C9.66163 12.5 9.52632 12.4585 9.41123 12.3809C9.29614 12.3033 9.20644 12.193 9.15347 12.0639C9.1005 11.9349 9.08664 11.7928 9.11364 11.6558C9.14064 11.5188 9.20728 11.393 9.30515 11.2942L11.6103 8.96804H2.79991C2.61426 8.96804 2.4362 8.89361 2.30493 8.76114C2.17365 8.62866 2.0999 8.44899 2.0999 8.26164C2.0999 8.0743 2.17365 7.89462 2.30493 7.76215C2.4362 7.62967 2.61426 7.55525 2.79991 7.55525H13.3001C13.4386 7.55528 13.5739 7.59672 13.689 7.67435C13.8041 7.75197 13.8938 7.86228 13.9467 7.99134C13.9997 8.1204 14.0136 8.2624 13.9866 8.39941C13.9596 8.53642 13.8929 8.66227 13.795 8.76106L10.295 12.293C10.1637 12.4255 9.9857 12.5 9.80006 12.5ZM11.9001 4.72968C11.9001 4.54233 11.8264 4.36266 11.6951 4.23018C11.5638 4.09771 11.3857 4.02328 11.2001 4.02328H2.3897L4.69485 1.69713C4.82236 1.56391 4.89292 1.38547 4.89133 1.20025C4.88973 1.01504 4.81611 0.837869 4.68632 0.706898C4.55654 0.575927 4.38096 0.501636 4.19742 0.500027C4.01388 0.498417 3.83705 0.569618 3.70503 0.698293L0.204955 4.23026C0.107087 4.32905 0.0404406 4.4549 0.0134427 4.59191C-0.0135551 4.72892 0.000307272 4.87092 0.0532774 4.99998C0.106248 5.12904 0.195947 5.23935 0.311036 5.31697C0.426126 5.3946 0.561438 5.43604 0.699866 5.43607H11.2001C11.3857 5.43607 11.5638 5.36165 11.6951 5.22917C11.8264 5.0967 11.9001 4.91703 11.9001 4.72968Z"
                                fill="#4F4632"></path>
                            </svg>
                          </span>
                          <a class="compare-now" href="/pages/compare" style="display:none;"> Compare Now </a>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="sweekar-puffed-rice-murmura-500g"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="quickview-btn" id="quickview">
                        <a style="text-decoration:none" href="#sweekar-puffed-rice-murmura-500g"
                          data-handle="sweekar-puffed-rice-murmura-500g">
                          <svg width="14" height="11" viewBox="0 0 14 11" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M6.99996 3.15912C5.70988 3.15912 4.66016 4.20885 4.66016 5.49892C4.66016 6.789 5.70988 7.83873 6.99996 7.83873C8.29004 7.83873 9.33977 6.789 9.33977 5.49892C9.33977 4.20885 8.29004 3.15912 6.99996 3.15912ZM6.99996 6.8724C6.24254 6.8724 5.62648 6.25635 5.62648 5.49892C5.62648 4.7415 6.24254 4.12545 6.99996 4.12545C7.75738 4.12545 8.37344 4.7415 8.37344 5.49892C8.37344 6.25635 7.75738 6.8724 6.99996 6.8724Z"
                              fill="#4F4632"></path>
                            <path
                              d="M13.4184 4.21786C13.1537 3.8509 12.6889 3.28735 11.9785 2.68715C11.2954 2.10993 10.561 1.64782 9.79562 1.31368C8.87633 0.912544 7.9357 0.709106 7 0.709106C6.0643 0.709106 5.12367 0.912544 4.2041 1.31368C3.43875 1.64754 2.7043 2.10965 2.02125 2.68715C1.31086 3.28762 0.846016 3.8509 0.581328 4.21786C0.195781 4.7527 0 5.18418 0 5.5C0 5.81582 0.195508 6.24731 0.581602 6.78215C0.846289 7.14911 1.31113 7.71266 2.02152 8.31286C2.70457 8.89008 3.43902 9.35219 4.20437 9.68633C5.12367 10.0875 6.06457 10.2909 7.00027 10.2909C7.93598 10.2909 8.8766 10.0875 9.79617 9.68633C10.5615 9.35247 11.296 8.89036 11.979 8.31286C12.6894 7.71239 13.1543 7.14911 13.4189 6.78215C13.8045 6.24731 14 5.81582 14 5.5C14 5.18418 13.8045 4.7527 13.4184 4.21786ZM11.293 7.62653C10.3592 8.40118 8.85637 9.32457 7 9.32457C5.14363 9.32457 3.64109 8.40118 2.70703 7.62653C1.56406 6.67852 1.00816 5.73625 0.967422 5.5C1.00789 5.26375 1.56406 4.32149 2.70703 3.37348C3.64082 2.59883 5.14363 1.67543 7 1.67543C8.85609 1.67543 10.3589 2.59883 11.293 3.37348C12.4359 4.32149 12.9921 5.26375 13.0326 5.5C12.9918 5.73625 12.4359 6.67852 11.293 7.62653Z"
                              fill="#4F4632"></path>
                          </svg>
                        </a>
                      </div>

                    </div>

                  </div>
                  <div id="ProductInfo-template--17996521046172__collection_slider_c7fFVc" class="product-content">
                    <div class="product-content-top">

                      <div class="product-type">Puffed Rice</div>

                      <h3 class="product-title">
                        <a href="#sweekar-puffed-rice-murmura-500g">Sweekar Puffed Rice (Murmura) 500g</a>
                      </h3>

                      <!-- Start of Judge.me code -->
                      <div class="jdgm-widget jdgm-preview-badge">
                        <div style="display:none" class="jdgm-prev-badge" data-average-rating="0.00"
                          data-number-of-reviews="0" data-number-of-questions="0"> <span class="jdgm-prev-badge__stars"
                            data-score="0.00" tabindex="0" aria-label="0.00 stars" role="button"> <span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span> </span> <span class="jdgm-prev-badge__text"> No
                            reviews </span> </div>
                      </div>
                      <!-- End of Judge.me code -->

                    </div>
                    <div id="ProductInfo-template--17996521046172__collection_slider_c7fFVc-8263802519708"
                      class="product-content-bottom">
                      <div class="product-selectors">


                      </div>
                      <product-form class="product-form">
                        <div class="wbquicksuccess hidden" hidden="">Translation missing:
                          en.wbcustomlabel.wballtext.quicksuccessmsg</div>
                        <div class="product-form__error-message-wrapper" role="alert" hidden="">
                          <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-error"
                            viewBox="0 0 13 13" width="25" height="25">
                            <circle cx="6.5" cy="6.50049" r="5.5" stroke="white" stroke-width="2"></circle>
                            <circle cx="6.5" cy="6.5" r="5.5" fill="#EB001B" stroke="#EB001B" stroke-width="0.7">
                            </circle>
                            <path
                              d="M5.87413 3.52832L5.97439 7.57216H7.02713L7.12739 3.52832H5.87413ZM6.50076 9.66091C6.88091 9.66091 7.18169 9.37267 7.18169 9.00504C7.18169 8.63742 6.88091 8.34917 6.50076 8.34917C6.12061 8.34917 5.81982 8.63742 5.81982 9.00504C5.81982 9.37267 6.12061 9.66091 6.50076 9.66091Z"
                              fill="white"></path>
                            <path
                              d="M5.87413 3.17832H5.51535L5.52424 3.537L5.6245 7.58083L5.63296 7.92216H5.97439H7.02713H7.36856L7.37702 7.58083L7.47728 3.537L7.48617 3.17832H7.12739H5.87413ZM6.50076 10.0109C7.06121 10.0109 7.5317 9.57872 7.5317 9.00504C7.5317 8.43137 7.06121 7.99918 6.50076 7.99918C5.94031 7.99918 5.46982 8.43137 5.46982 9.00504C5.46982 9.57872 5.94031 10.0109 6.50076 10.0109Z"
                              fill="white" stroke="#EB001B" stroke-width="0.7">
                            </path>
                          </svg>
                          <span class="product-form__error-message"></span>
                        </div>
                        <form method="post" action="cart_add.php"
                          id="product-form-template--17996521046172__collection_slider_c7fFVc-8263802519708"
                          accept-charset="UTF-8" class="form" enctype="multipart/form-data" novalidate="novalidate"
                          data-type="add-to-cart-form"><input type="hidden" name="form_type" value="product"><input
                            type="hidden" name="utf8" value="✓"><input type="hidden" name="id" value="44459682693276"
                            disabled="">
                          <div class="product-card__bottom">
                            <div class="no-js-hidden price"
                              id="price-template--17996521046172__collection_slider_c7fFVc-8263802519708" role="status">

                              <ins class="price-item--regular"><span class="money"> Lei7.19</span></ins>

                              <del class="price-item--sale">

                                <span class="money"> Lei11.99</span>

                              </del>




                              <span class="price-item--discount">
                                40% off
                              </span>



                            </div>
                            <button type="submit" name="add" class="btn btn--secondary product-form__submit"
                              aria-label="Add to Cart"><span>Add to Cart</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"
                                fill="none">
                                <path
                                  d="M3.22708 14.1828L2.22412 8.19984C2.07247 7.29523 1.99665 6.84293 2.23945 6.54647C2.48226 6.25 2.92852 6.25 3.82104 6.25H16.1783C17.0708 6.25 17.5171 6.25 17.7599 6.54647C18.0027 6.84293 17.9268 7.29523 17.7753 8.19984L16.7723 14.1828C16.4398 16.1659 16.2736 17.1574 15.5949 17.7454C14.9163 18.3333 13.938 18.3333 11.9815 18.3333H8.01786C6.06131 18.3333 5.08303 18.3333 4.40438 17.7454C3.72573 17.1574 3.55952 16.1659 3.22708 14.1828Z"
                                  stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                  d="M14.5837 6.25008C14.5837 3.71877 12.5317 1.66675 10.0003 1.66675C7.46902 1.66675 5.41699 3.71877 5.41699 6.25008"
                                  stroke="currentColor" stroke-width="1.5"></path>
                              </svg>

                              <div class="loading-overlay__spinner hidden">

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                  version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 511.494 511.494"
                                  style="enable-background:new 0 0 511.494 511.494;" xml:space="preserve" width="20"
                                  height="20">
                                  <g>
                                    <path
                                      d="M478.291,255.492c-16.133,0.143-29.689,12.161-31.765,28.16c-15.37,105.014-112.961,177.685-217.975,162.315 S50.866,333.006,66.236,227.992S179.197,50.307,284.211,65.677c35.796,5.239,69.386,20.476,96.907,43.959l-24.107,24.107   c-8.33,8.332-8.328,21.84,0.004,30.17c4.015,4.014,9.465,6.262,15.142,6.246h97.835c11.782,0,21.333-9.551,21.333-21.333V50.991   c-0.003-11.782-9.556-21.331-21.338-21.329c-5.655,0.001-11.079,2.248-15.078,6.246l-28.416,28.416   C320.774-29.34,159.141-19.568,65.476,86.152S-18.415,353.505,87.304,447.17s267.353,83.892,361.017-21.828   c32.972-37.216,54.381-83.237,61.607-132.431c2.828-17.612-9.157-34.183-26.769-37.011   C481.549,255.641,479.922,255.505,478.291,255.492z">
                                    </path>
                                  </g>
                                </svg>

                              </div>
                            </button>
                          </div><input type="hidden" name="product-id" value="8263802519708"><input type="hidden"
                            name="section-id" value="template--17996521046172__collection_slider_c7fFVc">
                        </form>
                      </product-form>
                    </div>
                  </div>
                </div>

              </div>

              <div class="collection-slide swiper-slide">
                <div class="product-card-inner card-inner">
                  <div id="pro-template--17996521046172__collection_slider_c7fFVc-8425197011100"
                    class="product-card-image card__media"><a href="#fresh-green-chillies" title="Fresh Green Chillies"
                      class="product__media-item"
                      data-media-id="template--17996521046172__collection_slider_c7fFVc-8425197011100-33441200046236"
                      tabindex="0">
                      <img loading="lazy" class=""
                        srcset="uploads/green-chilli-200-g-product-images-o590000187-p590000187-1-202409251830_600x400_v=1747139257.webp"
                        alt="">
                    </a>
                    <div class="wish-lbl-wrp">

                      <div class="pro-wishlist">
                        <label>
                          <span class="wishlist-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                              fill="none">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.1335 2.95108C16.73 4.16664 16.9557 6.44579 15.6274 7.93897L8.99983 15.3894L2.37233 7.93977C1.04381 6.44646 1.26946 4.167 2.86616 2.95128C4.50032 1.70704 6.87275 2.10393 7.99225 3.80885L8.36782 4.38082C8.59267 4.72325 9.05847 4.82238 9.40821 4.60224C9.51777 4.53328 9.60294 4.44117 9.66134 4.33666L10.0076 3.80914C11.1268 2.10394 13.4993 1.70679 15.1335 2.95108ZM8.99998 2.653C7.31724 0.526225 4.15516 0.102335 1.94184 1.78754C-0.33726 3.52284 -0.659353 6.77651 1.23696 8.90805L8.4334 16.9972C8.7065 17.3041 9.18204 17.3362 9.49557 17.0688C9.53631 17.0341 9.57231 16.996 9.60351 16.9553L16.7628 8.90721C18.6589 6.77579 18.3367 3.52246 16.0579 1.78734C13.8446 0.102142 10.6825 0.526185 8.99998 2.653Z"
                                fill=" #4F4632"></path>
                            </svg>
                          </span>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="fresh-green-chillies"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="pro-compare">
                        <label>
                          <span class="compare-label">
                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M9.80006 12.5C9.66163 12.5 9.52632 12.4585 9.41123 12.3809C9.29614 12.3033 9.20644 12.193 9.15347 12.0639C9.1005 11.9349 9.08664 11.7928 9.11364 11.6558C9.14064 11.5188 9.20728 11.393 9.30515 11.2942L11.6103 8.96804H2.79991C2.61426 8.96804 2.4362 8.89361 2.30493 8.76114C2.17365 8.62866 2.0999 8.44899 2.0999 8.26164C2.0999 8.0743 2.17365 7.89462 2.30493 7.76215C2.4362 7.62967 2.61426 7.55525 2.79991 7.55525H13.3001C13.4386 7.55528 13.5739 7.59672 13.689 7.67435C13.8041 7.75197 13.8938 7.86228 13.9467 7.99134C13.9997 8.1204 14.0136 8.2624 13.9866 8.39941C13.9596 8.53642 13.8929 8.66227 13.795 8.76106L10.295 12.293C10.1637 12.4255 9.9857 12.5 9.80006 12.5ZM11.9001 4.72968C11.9001 4.54233 11.8264 4.36266 11.6951 4.23018C11.5638 4.09771 11.3857 4.02328 11.2001 4.02328H2.3897L4.69485 1.69713C4.82236 1.56391 4.89292 1.38547 4.89133 1.20025C4.88973 1.01504 4.81611 0.837869 4.68632 0.706898C4.55654 0.575927 4.38096 0.501636 4.19742 0.500027C4.01388 0.498417 3.83705 0.569618 3.70503 0.698293L0.204955 4.23026C0.107087 4.32905 0.0404406 4.4549 0.0134427 4.59191C-0.0135551 4.72892 0.000307272 4.87092 0.0532774 4.99998C0.106248 5.12904 0.195947 5.23935 0.311036 5.31697C0.426126 5.3946 0.561438 5.43604 0.699866 5.43607H11.2001C11.3857 5.43607 11.5638 5.36165 11.6951 5.22917C11.8264 5.0967 11.9001 4.91703 11.9001 4.72968Z"
                                fill="#4F4632"></path>
                            </svg>
                          </span>
                          <a class="compare-now" href="/pages/compare" style="display:none;"> Compare Now </a>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="fresh-green-chillies"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="quickview-btn" id="quickview">
                        <a style="text-decoration:none" href="#fresh-green-chillies" data-handle="fresh-green-chillies">
                          <svg width="14" height="11" viewBox="0 0 14 11" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M6.99996 3.15912C5.70988 3.15912 4.66016 4.20885 4.66016 5.49892C4.66016 6.789 5.70988 7.83873 6.99996 7.83873C8.29004 7.83873 9.33977 6.789 9.33977 5.49892C9.33977 4.20885 8.29004 3.15912 6.99996 3.15912ZM6.99996 6.8724C6.24254 6.8724 5.62648 6.25635 5.62648 5.49892C5.62648 4.7415 6.24254 4.12545 6.99996 4.12545C7.75738 4.12545 8.37344 4.7415 8.37344 5.49892C8.37344 6.25635 7.75738 6.8724 6.99996 6.8724Z"
                              fill="#4F4632"></path>
                            <path
                              d="M13.4184 4.21786C13.1537 3.8509 12.6889 3.28735 11.9785 2.68715C11.2954 2.10993 10.561 1.64782 9.79562 1.31368C8.87633 0.912544 7.9357 0.709106 7 0.709106C6.0643 0.709106 5.12367 0.912544 4.2041 1.31368C3.43875 1.64754 2.7043 2.10965 2.02125 2.68715C1.31086 3.28762 0.846016 3.8509 0.581328 4.21786C0.195781 4.7527 0 5.18418 0 5.5C0 5.81582 0.195508 6.24731 0.581602 6.78215C0.846289 7.14911 1.31113 7.71266 2.02152 8.31286C2.70457 8.89008 3.43902 9.35219 4.20437 9.68633C5.12367 10.0875 6.06457 10.2909 7.00027 10.2909C7.93598 10.2909 8.8766 10.0875 9.79617 9.68633C10.5615 9.35247 11.296 8.89036 11.979 8.31286C12.6894 7.71239 13.1543 7.14911 13.4189 6.78215C13.8045 6.24731 14 5.81582 14 5.5C14 5.18418 13.8045 4.7527 13.4184 4.21786ZM11.293 7.62653C10.3592 8.40118 8.85637 9.32457 7 9.32457C5.14363 9.32457 3.64109 8.40118 2.70703 7.62653C1.56406 6.67852 1.00816 5.73625 0.967422 5.5C1.00789 5.26375 1.56406 4.32149 2.70703 3.37348C3.64082 2.59883 5.14363 1.67543 7 1.67543C8.85609 1.67543 10.3589 2.59883 11.293 3.37348C12.4359 4.32149 12.9921 5.26375 13.0326 5.5C12.9918 5.73625 12.4359 6.67852 11.293 7.62653Z"
                              fill="#4F4632"></path>
                          </svg>
                        </a>
                      </div>

                    </div>

                  </div>
                  <div id="ProductInfo-template--17996521046172__collection_slider_c7fFVc" class="product-content">
                    <div class="product-content-top">

                      <div class="product-type"></div>

                      <h3 class="product-title">
                        <a href="#fresh-green-chillies">Fresh Green Chillies</a>
                      </h3>

                      <!-- Start of Judge.me code -->
                      <div class="jdgm-widget jdgm-preview-badge">
                        <div style="display:none" class="jdgm-prev-badge" data-average-rating="0.00"
                          data-number-of-reviews="0" data-number-of-questions="0"> <span class="jdgm-prev-badge__stars"
                            data-score="0.00" tabindex="0" aria-label="0.00 stars" role="button"> <span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span> </span> <span class="jdgm-prev-badge__text"> No
                            reviews </span> </div>
                      </div>
                      <!-- End of Judge.me code -->

                    </div>
                    <div id="ProductInfo-template--17996521046172__collection_slider_c7fFVc-8425197011100"
                      class="product-content-bottom">
                      <div class="product-selectors">


                        <variant-selects class="size-select no-js-hidden"
                          data-section="template--17996521046172__collection_slider_c7fFVc" data-product="8425197011100"
                          data-url="" data-update-url="false" data-layout="card"><label class="lbl">Weight:</label>
                          <select id="Option-template--17996521046172__collection_slider_c7fFVc-8425197011100-0"
                            class="nice-select select__select product-form__input product-form__input--dropdown"
                            name="options[Weight]"
                            form="product-form-template--17996521046172__collection_slider_c7fFVc-8425197011100">
                            <option data-val="250g" value="250g" selected="selected">
                              250g
                            </option>
                            <option data-val="500g" value="500g">
                              500g
                            </option>
                            <option data-val="1kg" value="1kg">
                              1kg
                            </option>
                          </select>
                          <script type="application/json">
                [{"id":44980175011996,"title":"250g","option1":"250g","option2":null,"option3":null,"sku":"F-M00033","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"Fresh Green Chillies - 250g","public_title":"250g","options":["250g"],"price":899,"weight":250,"compare_at_price":null,"inventory_management":"shopify","barcode":null,"requires_selling_plan":false,"selling_plan_allocations":[]},{"id":44980175044764,"title":"500g","option1":"500g","option2":null,"option3":null,"sku":"F-M00006","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"Fresh Green Chillies - 500g","public_title":"500g","options":["500g"],"price":1699,"weight":500,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[]},{"id":44980175077532,"title":"1kg","option1":"1kg","option2":null,"option3":null,"sku":"F-M00126","requires_shipping":true,"taxable":true,"featured_image":null,"available":true,"name":"Fresh Green Chillies - 1kg","public_title":"1kg","options":["1kg"],"price":2899,"weight":1000,"compare_at_price":null,"inventory_management":"shopify","barcode":"","requires_selling_plan":false,"selling_plan_allocations":[]}]
              </script>
                        </variant-selects>

                        <select id="Variants-template--17996521046172__collection_slider_c7fFVc-8425197011100"
                          class="nice-select select__select no-js"
                          form="product-form-template--17996521046172__collection_slider_c7fFVc-8425197011100">
                          <option data-v-title="250g" data-price="<span class=money> Lei8.99</span>" data-cprice=""
                            selected="selected" value="44980175011996">
                            250g

                            - Lei8.99
                          </option>
                          <option data-v-title="500g" data-price="<span class=money> Lei16.99</span>" data-cprice=""
                            value="44980175044764">
                            500g

                            - Lei16.99
                          </option>
                          <option data-v-title="1kg" data-price="<span class=money> Lei28.99</span>" data-cprice=""
                            value="44980175077532">
                            1kg

                            - Lei28.99
                          </option>
                        </select>


                      </div>
                      <product-form class="product-form">
                        <div class="wbquicksuccess hidden" hidden="">Translation missing:
                          en.wbcustomlabel.wballtext.quicksuccessmsg</div>
                        <div class="product-form__error-message-wrapper" role="alert" hidden="">
                          <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-error"
                            viewBox="0 0 13 13" width="25" height="25">
                            <circle cx="6.5" cy="6.50049" r="5.5" stroke="white" stroke-width="2"></circle>
                            <circle cx="6.5" cy="6.5" r="5.5" fill="#EB001B" stroke="#EB001B" stroke-width="0.7">
                            </circle>
                            <path
                              d="M5.87413 3.52832L5.97439 7.57216H7.02713L7.12739 3.52832H5.87413ZM6.50076 9.66091C6.88091 9.66091 7.18169 9.37267 7.18169 9.00504C7.18169 8.63742 6.88091 8.34917 6.50076 8.34917C6.12061 8.34917 5.81982 8.63742 5.81982 9.00504C5.81982 9.37267 6.12061 9.66091 6.50076 9.66091Z"
                              fill="white"></path>
                            <path
                              d="M5.87413 3.17832H5.51535L5.52424 3.537L5.6245 7.58083L5.63296 7.92216H5.97439H7.02713H7.36856L7.37702 7.58083L7.47728 3.537L7.48617 3.17832H7.12739H5.87413ZM6.50076 10.0109C7.06121 10.0109 7.5317 9.57872 7.5317 9.00504C7.5317 8.43137 7.06121 7.99918 6.50076 7.99918C5.94031 7.99918 5.46982 8.43137 5.46982 9.00504C5.46982 9.57872 5.94031 10.0109 6.50076 10.0109Z"
                              fill="white" stroke="#EB001B" stroke-width="0.7">
                            </path>
                          </svg>
                          <span class="product-form__error-message"></span>
                        </div>
                        <form method="post" action="cart_add.php"
                          id="product-form-template--17996521046172__collection_slider_c7fFVc-8425197011100"
                          accept-charset="UTF-8" class="form" enctype="multipart/form-data" novalidate="novalidate"
                          data-type="add-to-cart-form"><input type="hidden" name="form_type" value="product"><input
                            type="hidden" name="utf8" value="✓"><input type="hidden" name="id" value="44980175011996"
                            disabled="">
                          <div class="product-card__bottom">
                            <div class="no-js-hidden price"
                              id="price-template--17996521046172__collection_slider_c7fFVc-8425197011100" role="status">

                              <ins class="price-item--regular"><span class="money"> Lei8.99</span></ins>






                            </div>
                            <button type="submit" name="add" class="btn btn--secondary product-form__submit"
                              aria-label="Add to Cart"><span>Add to Cart</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"
                                fill="none">
                                <path
                                  d="M3.22708 14.1828L2.22412 8.19984C2.07247 7.29523 1.99665 6.84293 2.23945 6.54647C2.48226 6.25 2.92852 6.25 3.82104 6.25H16.1783C17.0708 6.25 17.5171 6.25 17.7599 6.54647C18.0027 6.84293 17.9268 7.29523 17.7753 8.19984L16.7723 14.1828C16.4398 16.1659 16.2736 17.1574 15.5949 17.7454C14.9163 18.3333 13.938 18.3333 11.9815 18.3333H8.01786C6.06131 18.3333 5.08303 18.3333 4.40438 17.7454C3.72573 17.1574 3.55952 16.1659 3.22708 14.1828Z"
                                  stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                  d="M14.5837 6.25008C14.5837 3.71877 12.5317 1.66675 10.0003 1.66675C7.46902 1.66675 5.41699 3.71877 5.41699 6.25008"
                                  stroke="currentColor" stroke-width="1.5"></path>
                              </svg>

                              <div class="loading-overlay__spinner hidden">

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                  version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 511.494 511.494"
                                  style="enable-background:new 0 0 511.494 511.494;" xml:space="preserve" width="20"
                                  height="20">
                                  <g>
                                    <path
                                      d="M478.291,255.492c-16.133,0.143-29.689,12.161-31.765,28.16c-15.37,105.014-112.961,177.685-217.975,162.315 S50.866,333.006,66.236,227.992S179.197,50.307,284.211,65.677c35.796,5.239,69.386,20.476,96.907,43.959l-24.107,24.107   c-8.33,8.332-8.328,21.84,0.004,30.17c4.015,4.014,9.465,6.262,15.142,6.246h97.835c11.782,0,21.333-9.551,21.333-21.333V50.991   c-0.003-11.782-9.556-21.331-21.338-21.329c-5.655,0.001-11.079,2.248-15.078,6.246l-28.416,28.416   C320.774-29.34,159.141-19.568,65.476,86.152S-18.415,353.505,87.304,447.17s267.353,83.892,361.017-21.828   c32.972-37.216,54.381-83.237,61.607-132.431c2.828-17.612-9.157-34.183-26.769-37.011   C481.549,255.641,479.922,255.505,478.291,255.492z">
                                    </path>
                                  </g>
                                </svg>

                              </div>
                            </button>
                          </div><input type="hidden" name="product-id" value="8425197011100"><input type="hidden"
                            name="section-id" value="template--17996521046172__collection_slider_c7fFVc">
                        </form>
                      </product-form>
                    </div>
                  </div>
                </div>

              </div>

              <div class="collection-slide swiper-slide">
                <div class="product-card-inner card-inner">
                  <div id="pro-template--17996521046172__collection_slider_c7fFVc-8446919475356"
                    class="product-card-image card__media"><a href="#fresh-coconut" title="Fresh Coconut"
                      class="product__media-item"
                      data-media-id="template--17996521046172__collection_slider_c7fFVc-8446919475356-33639945830556"
                      tabindex="0">
                      <img loading="lazy" class=""
                        srcset="uploads/pooja_coconut_7c663ff4-b79c-4b1a-9616-78db9eee4e8f_600x400_v=1749653363.webp"
                        alt="">
                    </a>
                    <div class="wish-lbl-wrp">

                      <div class="pro-wishlist">
                        <label>
                          <span class="wishlist-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                              fill="none">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.1335 2.95108C16.73 4.16664 16.9557 6.44579 15.6274 7.93897L8.99983 15.3894L2.37233 7.93977C1.04381 6.44646 1.26946 4.167 2.86616 2.95128C4.50032 1.70704 6.87275 2.10393 7.99225 3.80885L8.36782 4.38082C8.59267 4.72325 9.05847 4.82238 9.40821 4.60224C9.51777 4.53328 9.60294 4.44117 9.66134 4.33666L10.0076 3.80914C11.1268 2.10394 13.4993 1.70679 15.1335 2.95108ZM8.99998 2.653C7.31724 0.526225 4.15516 0.102335 1.94184 1.78754C-0.33726 3.52284 -0.659353 6.77651 1.23696 8.90805L8.4334 16.9972C8.7065 17.3041 9.18204 17.3362 9.49557 17.0688C9.53631 17.0341 9.57231 16.996 9.60351 16.9553L16.7628 8.90721C18.6589 6.77579 18.3367 3.52246 16.0579 1.78734C13.8446 0.102142 10.6825 0.526185 8.99998 2.653Z"
                                fill=" #4F4632"></path>
                            </svg>
                          </span>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="fresh-coconut"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="pro-compare">
                        <label>
                          <span class="compare-label">
                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M9.80006 12.5C9.66163 12.5 9.52632 12.4585 9.41123 12.3809C9.29614 12.3033 9.20644 12.193 9.15347 12.0639C9.1005 11.9349 9.08664 11.7928 9.11364 11.6558C9.14064 11.5188 9.20728 11.393 9.30515 11.2942L11.6103 8.96804H2.79991C2.61426 8.96804 2.4362 8.89361 2.30493 8.76114C2.17365 8.62866 2.0999 8.44899 2.0999 8.26164C2.0999 8.0743 2.17365 7.89462 2.30493 7.76215C2.4362 7.62967 2.61426 7.55525 2.79991 7.55525H13.3001C13.4386 7.55528 13.5739 7.59672 13.689 7.67435C13.8041 7.75197 13.8938 7.86228 13.9467 7.99134C13.9997 8.1204 14.0136 8.2624 13.9866 8.39941C13.9596 8.53642 13.8929 8.66227 13.795 8.76106L10.295 12.293C10.1637 12.4255 9.9857 12.5 9.80006 12.5ZM11.9001 4.72968C11.9001 4.54233 11.8264 4.36266 11.6951 4.23018C11.5638 4.09771 11.3857 4.02328 11.2001 4.02328H2.3897L4.69485 1.69713C4.82236 1.56391 4.89292 1.38547 4.89133 1.20025C4.88973 1.01504 4.81611 0.837869 4.68632 0.706898C4.55654 0.575927 4.38096 0.501636 4.19742 0.500027C4.01388 0.498417 3.83705 0.569618 3.70503 0.698293L0.204955 4.23026C0.107087 4.32905 0.0404406 4.4549 0.0134427 4.59191C-0.0135551 4.72892 0.000307272 4.87092 0.0532774 4.99998C0.106248 5.12904 0.195947 5.23935 0.311036 5.31697C0.426126 5.3946 0.561438 5.43604 0.699866 5.43607H11.2001C11.3857 5.43607 11.5638 5.36165 11.6951 5.22917C11.8264 5.0967 11.9001 4.91703 11.9001 4.72968Z"
                                fill="#4F4632"></path>
                            </svg>
                          </span>
                          <a class="compare-now" href="/pages/compare" style="display:none;"> Compare Now </a>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="fresh-coconut"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="quickview-btn" id="quickview">
                        <a style="text-decoration:none" href="#fresh-coconut" data-handle="fresh-coconut">
                          <svg width="14" height="11" viewBox="0 0 14 11" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M6.99996 3.15912C5.70988 3.15912 4.66016 4.20885 4.66016 5.49892C4.66016 6.789 5.70988 7.83873 6.99996 7.83873C8.29004 7.83873 9.33977 6.789 9.33977 5.49892C9.33977 4.20885 8.29004 3.15912 6.99996 3.15912ZM6.99996 6.8724C6.24254 6.8724 5.62648 6.25635 5.62648 5.49892C5.62648 4.7415 6.24254 4.12545 6.99996 4.12545C7.75738 4.12545 8.37344 4.7415 8.37344 5.49892C8.37344 6.25635 7.75738 6.8724 6.99996 6.8724Z"
                              fill="#4F4632"></path>
                            <path
                              d="M13.4184 4.21786C13.1537 3.8509 12.6889 3.28735 11.9785 2.68715C11.2954 2.10993 10.561 1.64782 9.79562 1.31368C8.87633 0.912544 7.9357 0.709106 7 0.709106C6.0643 0.709106 5.12367 0.912544 4.2041 1.31368C3.43875 1.64754 2.7043 2.10965 2.02125 2.68715C1.31086 3.28762 0.846016 3.8509 0.581328 4.21786C0.195781 4.7527 0 5.18418 0 5.5C0 5.81582 0.195508 6.24731 0.581602 6.78215C0.846289 7.14911 1.31113 7.71266 2.02152 8.31286C2.70457 8.89008 3.43902 9.35219 4.20437 9.68633C5.12367 10.0875 6.06457 10.2909 7.00027 10.2909C7.93598 10.2909 8.8766 10.0875 9.79617 9.68633C10.5615 9.35247 11.296 8.89036 11.979 8.31286C12.6894 7.71239 13.1543 7.14911 13.4189 6.78215C13.8045 6.24731 14 5.81582 14 5.5C14 5.18418 13.8045 4.7527 13.4184 4.21786ZM11.293 7.62653C10.3592 8.40118 8.85637 9.32457 7 9.32457C5.14363 9.32457 3.64109 8.40118 2.70703 7.62653C1.56406 6.67852 1.00816 5.73625 0.967422 5.5C1.00789 5.26375 1.56406 4.32149 2.70703 3.37348C3.64082 2.59883 5.14363 1.67543 7 1.67543C8.85609 1.67543 10.3589 2.59883 11.293 3.37348C12.4359 4.32149 12.9921 5.26375 13.0326 5.5C12.9918 5.73625 12.4359 6.67852 11.293 7.62653Z"
                              fill="#4F4632"></path>
                          </svg>
                        </a>
                      </div>

                    </div>

                  </div>
                  <div id="ProductInfo-template--17996521046172__collection_slider_c7fFVc" class="product-content">
                    <div class="product-content-top">

                      <div class="product-type"></div>

                      <h3 class="product-title">
                        <a href="#fresh-coconut">Fresh Coconut</a>
                      </h3>

                      <!-- Start of Judge.me code -->
                      <div class="jdgm-widget jdgm-preview-badge">
                        <div style="display:none" class="jdgm-prev-badge" data-average-rating="0.00"
                          data-number-of-reviews="0" data-number-of-questions="0"> <span class="jdgm-prev-badge__stars"
                            data-score="0.00" tabindex="0" aria-label="0.00 stars" role="button"> <span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span> </span> <span class="jdgm-prev-badge__text"> No
                            reviews </span> </div>
                      </div>
                      <!-- End of Judge.me code -->

                    </div>
                    <div id="ProductInfo-template--17996521046172__collection_slider_c7fFVc-8446919475356"
                      class="product-content-bottom">
                      <div class="product-selectors">


                      </div>
                      <product-form class="product-form">
                        <div class="wbquicksuccess hidden" hidden="">Translation missing:
                          en.wbcustomlabel.wballtext.quicksuccessmsg</div>
                        <div class="product-form__error-message-wrapper" role="alert" hidden="">
                          <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-error"
                            viewBox="0 0 13 13" width="25" height="25">
                            <circle cx="6.5" cy="6.50049" r="5.5" stroke="white" stroke-width="2"></circle>
                            <circle cx="6.5" cy="6.5" r="5.5" fill="#EB001B" stroke="#EB001B" stroke-width="0.7">
                            </circle>
                            <path
                              d="M5.87413 3.52832L5.97439 7.57216H7.02713L7.12739 3.52832H5.87413ZM6.50076 9.66091C6.88091 9.66091 7.18169 9.37267 7.18169 9.00504C7.18169 8.63742 6.88091 8.34917 6.50076 8.34917C6.12061 8.34917 5.81982 8.63742 5.81982 9.00504C5.81982 9.37267 6.12061 9.66091 6.50076 9.66091Z"
                              fill="white"></path>
                            <path
                              d="M5.87413 3.17832H5.51535L5.52424 3.537L5.6245 7.58083L5.63296 7.92216H5.97439H7.02713H7.36856L7.37702 7.58083L7.47728 3.537L7.48617 3.17832H7.12739H5.87413ZM6.50076 10.0109C7.06121 10.0109 7.5317 9.57872 7.5317 9.00504C7.5317 8.43137 7.06121 7.99918 6.50076 7.99918C5.94031 7.99918 5.46982 8.43137 5.46982 9.00504C5.46982 9.57872 5.94031 10.0109 6.50076 10.0109Z"
                              fill="white" stroke="#EB001B" stroke-width="0.7">
                            </path>
                          </svg>
                          <span class="product-form__error-message"></span>
                        </div>
                        <form method="post" action="cart_add.php"
                          id="product-form-template--17996521046172__collection_slider_c7fFVc-8446919475356"
                          accept-charset="UTF-8" class="form" enctype="multipart/form-data" novalidate="novalidate"
                          data-type="add-to-cart-form"><input type="hidden" name="form_type" value="product"><input
                            type="hidden" name="utf8" value="✓"><input type="hidden" name="id" value="45040272507036"
                            disabled="">
                          <div class="product-card__bottom">
                            <div class="no-js-hidden price"
                              id="price-template--17996521046172__collection_slider_c7fFVc-8446919475356" role="status">

                              <ins class="price-item--regular"><span class="money"> Lei10.00</span></ins>






                            </div>
                            <button type="submit" name="add" class="btn btn--secondary product-form__submit"
                              aria-label="Add to Cart"><span>Add to Cart</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"
                                fill="none">
                                <path
                                  d="M3.22708 14.1828L2.22412 8.19984C2.07247 7.29523 1.99665 6.84293 2.23945 6.54647C2.48226 6.25 2.92852 6.25 3.82104 6.25H16.1783C17.0708 6.25 17.5171 6.25 17.7599 6.54647C18.0027 6.84293 17.9268 7.29523 17.7753 8.19984L16.7723 14.1828C16.4398 16.1659 16.2736 17.1574 15.5949 17.7454C14.9163 18.3333 13.938 18.3333 11.9815 18.3333H8.01786C6.06131 18.3333 5.08303 18.3333 4.40438 17.7454C3.72573 17.1574 3.55952 16.1659 3.22708 14.1828Z"
                                  stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                  d="M14.5837 6.25008C14.5837 3.71877 12.5317 1.66675 10.0003 1.66675C7.46902 1.66675 5.41699 3.71877 5.41699 6.25008"
                                  stroke="currentColor" stroke-width="1.5"></path>
                              </svg>

                              <div class="loading-overlay__spinner hidden">

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                  version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 511.494 511.494"
                                  style="enable-background:new 0 0 511.494 511.494;" xml:space="preserve" width="20"
                                  height="20">
                                  <g>
                                    <path
                                      d="M478.291,255.492c-16.133,0.143-29.689,12.161-31.765,28.16c-15.37,105.014-112.961,177.685-217.975,162.315 S50.866,333.006,66.236,227.992S179.197,50.307,284.211,65.677c35.796,5.239,69.386,20.476,96.907,43.959l-24.107,24.107   c-8.33,8.332-8.328,21.84,0.004,30.17c4.015,4.014,9.465,6.262,15.142,6.246h97.835c11.782,0,21.333-9.551,21.333-21.333V50.991   c-0.003-11.782-9.556-21.331-21.338-21.329c-5.655,0.001-11.079,2.248-15.078,6.246l-28.416,28.416   C320.774-29.34,159.141-19.568,65.476,86.152S-18.415,353.505,87.304,447.17s267.353,83.892,361.017-21.828   c32.972-37.216,54.381-83.237,61.607-132.431c2.828-17.612-9.157-34.183-26.769-37.011   C481.549,255.641,479.922,255.505,478.291,255.492z">
                                    </path>
                                  </g>
                                </svg>

                              </div>
                            </button>
                          </div><input type="hidden" name="product-id" value="8446919475356"><input type="hidden"
                            name="section-id" value="template--17996521046172__collection_slider_c7fFVc">
                        </form>
                      </product-form>
                    </div>
                  </div>
                </div>

              </div>

              <div class="collection-slide swiper-slide">
                <div class="product-card-inner card-inner">
                  <div id="pro-template--17996521046172__collection_slider_c7fFVc-8275152076956"
                    class="product-card-image card__media"><a href="#fresh-okra" title="Fresh Okra (Ladies Finger)"
                      class="product__media-item"
                      data-media-id="template--17996521046172__collection_slider_c7fFVc-8275152076956-32173126549660"
                      tabindex="0">
                      <img loading="lazy" class=""
                        srcset="uploads/FreshOkra_600x400_v=1728243454.jpg"
                        alt="">
                    </a>
                    <div class="wish-lbl-wrp">

                      <div class="pro-wishlist">
                        <label>
                          <span class="wishlist-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                              fill="none">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.1335 2.95108C16.73 4.16664 16.9557 6.44579 15.6274 7.93897L8.99983 15.3894L2.37233 7.93977C1.04381 6.44646 1.26946 4.167 2.86616 2.95128C4.50032 1.70704 6.87275 2.10393 7.99225 3.80885L8.36782 4.38082C8.59267 4.72325 9.05847 4.82238 9.40821 4.60224C9.51777 4.53328 9.60294 4.44117 9.66134 4.33666L10.0076 3.80914C11.1268 2.10394 13.4993 1.70679 15.1335 2.95108ZM8.99998 2.653C7.31724 0.526225 4.15516 0.102335 1.94184 1.78754C-0.33726 3.52284 -0.659353 6.77651 1.23696 8.90805L8.4334 16.9972C8.7065 17.3041 9.18204 17.3362 9.49557 17.0688C9.53631 17.0341 9.57231 16.996 9.60351 16.9553L16.7628 8.90721C18.6589 6.77579 18.3367 3.52246 16.0579 1.78734C13.8446 0.102142 10.6825 0.526185 8.99998 2.653Z"
                                fill=" #4F4632"></path>
                            </svg>
                          </span>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="fresh-okra"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="pro-compare">
                        <label>
                          <span class="compare-label">
                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M9.80006 12.5C9.66163 12.5 9.52632 12.4585 9.41123 12.3809C9.29614 12.3033 9.20644 12.193 9.15347 12.0639C9.1005 11.9349 9.08664 11.7928 9.11364 11.6558C9.14064 11.5188 9.20728 11.393 9.30515 11.2942L11.6103 8.96804H2.79991C2.61426 8.96804 2.4362 8.89361 2.30493 8.76114C2.17365 8.62866 2.0999 8.44899 2.0999 8.26164C2.0999 8.0743 2.17365 7.89462 2.30493 7.76215C2.4362 7.62967 2.61426 7.55525 2.79991 7.55525H13.3001C13.4386 7.55528 13.5739 7.59672 13.689 7.67435C13.8041 7.75197 13.8938 7.86228 13.9467 7.99134C13.9997 8.1204 14.0136 8.2624 13.9866 8.39941C13.9596 8.53642 13.8929 8.66227 13.795 8.76106L10.295 12.293C10.1637 12.4255 9.9857 12.5 9.80006 12.5ZM11.9001 4.72968C11.9001 4.54233 11.8264 4.36266 11.6951 4.23018C11.5638 4.09771 11.3857 4.02328 11.2001 4.02328H2.3897L4.69485 1.69713C4.82236 1.56391 4.89292 1.38547 4.89133 1.20025C4.88973 1.01504 4.81611 0.837869 4.68632 0.706898C4.55654 0.575927 4.38096 0.501636 4.19742 0.500027C4.01388 0.498417 3.83705 0.569618 3.70503 0.698293L0.204955 4.23026C0.107087 4.32905 0.0404406 4.4549 0.0134427 4.59191C-0.0135551 4.72892 0.000307272 4.87092 0.0532774 4.99998C0.106248 5.12904 0.195947 5.23935 0.311036 5.31697C0.426126 5.3946 0.561438 5.43604 0.699866 5.43607H11.2001C11.3857 5.43607 11.5638 5.36165 11.6951 5.22917C11.8264 5.0967 11.9001 4.91703 11.9001 4.72968Z"
                                fill="#4F4632"></path>
                            </svg>
                          </span>
                          <a class="compare-now" href="/pages/compare" style="display:none;"> Compare Now </a>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="fresh-okra"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="quickview-btn" id="quickview">
                        <a style="text-decoration:none" href="#fresh-okra" data-handle="fresh-okra">
                          <svg width="14" height="11" viewBox="0 0 14 11" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M6.99996 3.15912C5.70988 3.15912 4.66016 4.20885 4.66016 5.49892C4.66016 6.789 5.70988 7.83873 6.99996 7.83873C8.29004 7.83873 9.33977 6.789 9.33977 5.49892C9.33977 4.20885 8.29004 3.15912 6.99996 3.15912ZM6.99996 6.8724C6.24254 6.8724 5.62648 6.25635 5.62648 5.49892C5.62648 4.7415 6.24254 4.12545 6.99996 4.12545C7.75738 4.12545 8.37344 4.7415 8.37344 5.49892C8.37344 6.25635 7.75738 6.8724 6.99996 6.8724Z"
                              fill="#4F4632"></path>
                            <path
                              d="M13.4184 4.21786C13.1537 3.8509 12.6889 3.28735 11.9785 2.68715C11.2954 2.10993 10.561 1.64782 9.79562 1.31368C8.87633 0.912544 7.9357 0.709106 7 0.709106C6.0643 0.709106 5.12367 0.912544 4.2041 1.31368C3.43875 1.64754 2.7043 2.10965 2.02125 2.68715C1.31086 3.28762 0.846016 3.8509 0.581328 4.21786C0.195781 4.7527 0 5.18418 0 5.5C0 5.81582 0.195508 6.24731 0.581602 6.78215C0.846289 7.14911 1.31113 7.71266 2.02152 8.31286C2.70457 8.89008 3.43902 9.35219 4.20437 9.68633C5.12367 10.0875 6.06457 10.2909 7.00027 10.2909C7.93598 10.2909 8.8766 10.0875 9.79617 9.68633C10.5615 9.35247 11.296 8.89036 11.979 8.31286C12.6894 7.71239 13.1543 7.14911 13.4189 6.78215C13.8045 6.24731 14 5.81582 14 5.5C14 5.18418 13.8045 4.7527 13.4184 4.21786ZM11.293 7.62653C10.3592 8.40118 8.85637 9.32457 7 9.32457C5.14363 9.32457 3.64109 8.40118 2.70703 7.62653C1.56406 6.67852 1.00816 5.73625 0.967422 5.5C1.00789 5.26375 1.56406 4.32149 2.70703 3.37348C3.64082 2.59883 5.14363 1.67543 7 1.67543C8.85609 1.67543 10.3589 2.59883 11.293 3.37348C12.4359 4.32149 12.9921 5.26375 13.0326 5.5C12.9918 5.73625 12.4359 6.67852 11.293 7.62653Z"
                              fill="#4F4632"></path>
                          </svg>
                        </a>
                      </div>

                    </div>

                  </div>
                  <div id="ProductInfo-template--17996521046172__collection_slider_c7fFVc" class="product-content">
                    <div class="product-content-top">

                      <div class="product-type"></div>

                      <h3 class="product-title">
                        <a href="#fresh-okra">Fresh Okra (Ladies Finger)</a>
                      </h3>

                      <!-- Start of Judge.me code -->
                      <div class="jdgm-widget jdgm-preview-badge">
                        <div style="display:none" class="jdgm-prev-badge" data-average-rating="5.00"
                          data-number-of-reviews="1" data-number-of-questions="0"> <span class="jdgm-prev-badge__stars"
                            data-score="5.00" tabindex="0" aria-label="5.00 stars" role="button"> <span
                              class="jdgm-star jdgm--on"></span><span class="jdgm-star jdgm--on"></span><span
                              class="jdgm-star jdgm--on"></span><span class="jdgm-star jdgm--on"></span><span
                              class="jdgm-star jdgm--on"></span> </span> <span class="jdgm-prev-badge__text"> 1 review
                          </span> </div>
                      </div>
                      <!-- End of Judge.me code -->

                    </div>
                    <div id="ProductInfo-template--17996521046172__collection_slider_c7fFVc-8275152076956"
                      class="product-content-bottom">
                      <div class="product-selectors">


                        <variant-selects class="size-select no-js-hidden"
                          data-section="template--17996521046172__collection_slider_c7fFVc" data-product="8275152076956"
                          data-url="" data-update-url="false" data-layout="card"><label class="lbl">Weight:</label>
                          <select id="Option-template--17996521046172__collection_slider_c7fFVc-8275152076956-0"
                            class="nice-select select__select product-form__input product-form__input--dropdown"
                            name="options[Weight]"
                            form="product-form-template--17996521046172__collection_slider_c7fFVc-8275152076956">
                            <option data-val="250g" value="250g" selected="selected">
                              250g
                            </option>
                            <option data-val="500g" value="500g">
                              500g
                            </option>
                            <option data-val="1kg" value="1kg">
                              1kg
                            </option>
                          </select>
                          <script type="application/json">
                [{"id":44501607055516,"title":"250g","option1":"250g","option2":null,"option3":null,"sku":"F-M00001","requires_shipping":true,"taxable":true,"featured_image":{"id":39964823453852,"product_id":8275152076956,"position":1,"created_at":"2024-10-06T21:37:32+02:00","updated_at":"2024-10-06T21:37:34+02:00","alt":null,"width":410,"height":253,"src":"\/\/maharajasupermarket.ro\/cdn\/shop\/files\/FreshOkra.jpg?v=1728243454","variant_ids":[44501607055516,44501607088284,44501607121052]},"available":true,"name":"Fresh Okra (Ladies Finger) - 250g","public_title":"250g","options":["250g"],"price":799,"weight":250,"compare_at_price":null,"inventory_management":"shopify","barcode":"","featured_media":{"alt":null,"id":32173126549660,"position":1,"preview_image":{"aspect_ratio":1.621,"height":253,"width":410,"src":"\/\/maharajasupermarket.ro\/cdn\/shop\/files\/FreshOkra.jpg?v=1728243454"}},"requires_selling_plan":false,"selling_plan_allocations":[]},{"id":44501607088284,"title":"500g","option1":"500g","option2":null,"option3":null,"sku":"F-M00002","requires_shipping":true,"taxable":true,"featured_image":{"id":39964823453852,"product_id":8275152076956,"position":1,"created_at":"2024-10-06T21:37:32+02:00","updated_at":"2024-10-06T21:37:34+02:00","alt":null,"width":410,"height":253,"src":"\/\/maharajasupermarket.ro\/cdn\/shop\/files\/FreshOkra.jpg?v=1728243454","variant_ids":[44501607055516,44501607088284,44501607121052]},"available":true,"name":"Fresh Okra (Ladies Finger) - 500g","public_title":"500g","options":["500g"],"price":1399,"weight":500,"compare_at_price":null,"inventory_management":"shopify","barcode":"","featured_media":{"alt":null,"id":32173126549660,"position":1,"preview_image":{"aspect_ratio":1.621,"height":253,"width":410,"src":"\/\/maharajasupermarket.ro\/cdn\/shop\/files\/FreshOkra.jpg?v=1728243454"}},"requires_selling_plan":false,"selling_plan_allocations":[]},{"id":44501607121052,"title":"1kg","option1":"1kg","option2":null,"option3":null,"sku":"F-M00003","requires_shipping":true,"taxable":true,"featured_image":{"id":39964823453852,"product_id":8275152076956,"position":1,"created_at":"2024-10-06T21:37:32+02:00","updated_at":"2024-10-06T21:37:34+02:00","alt":null,"width":410,"height":253,"src":"\/\/maharajasupermarket.ro\/cdn\/shop\/files\/FreshOkra.jpg?v=1728243454","variant_ids":[44501607055516,44501607088284,44501607121052]},"available":false,"name":"Fresh Okra (Ladies Finger) - 1kg","public_title":"1kg","options":["1kg"],"price":2799,"weight":1000,"compare_at_price":null,"inventory_management":"shopify","barcode":"","featured_media":{"alt":null,"id":32173126549660,"position":1,"preview_image":{"aspect_ratio":1.621,"height":253,"width":410,"src":"\/\/maharajasupermarket.ro\/cdn\/shop\/files\/FreshOkra.jpg?v=1728243454"}},"requires_selling_plan":false,"selling_plan_allocations":[]}]
              </script>
                        </variant-selects>

                        <select id="Variants-template--17996521046172__collection_slider_c7fFVc-8275152076956"
                          class="nice-select select__select no-js"
                          form="product-form-template--17996521046172__collection_slider_c7fFVc-8275152076956">
                          <option data-v-title="250g" data-price="<span class=money> Lei7.99</span>" data-cprice=""
                            selected="selected" value="44501607055516">
                            250g

                            - Lei7.99
                          </option>
                          <option data-v-title="500g" data-price="<span class=money> Lei13.99</span>" data-cprice=""
                            value="44501607088284">
                            500g

                            - Lei13.99
                          </option>
                          <option data-v-title="1kg" data-price="<span class=money> Lei27.99</span>" data-cprice=""
                            disabled="" value="44501607121052">
                            1kg
                            - Sold out
                            - Lei27.99
                          </option>
                        </select>


                      </div>
                      <product-form class="product-form">
                        <div class="wbquicksuccess hidden" hidden="">Translation missing:
                          en.wbcustomlabel.wballtext.quicksuccessmsg</div>
                        <div class="product-form__error-message-wrapper" role="alert" hidden="">
                          <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-error"
                            viewBox="0 0 13 13" width="25" height="25">
                            <circle cx="6.5" cy="6.50049" r="5.5" stroke="white" stroke-width="2"></circle>
                            <circle cx="6.5" cy="6.5" r="5.5" fill="#EB001B" stroke="#EB001B" stroke-width="0.7">
                            </circle>
                            <path
                              d="M5.87413 3.52832L5.97439 7.57216H7.02713L7.12739 3.52832H5.87413ZM6.50076 9.66091C6.88091 9.66091 7.18169 9.37267 7.18169 9.00504C7.18169 8.63742 6.88091 8.34917 6.50076 8.34917C6.12061 8.34917 5.81982 8.63742 5.81982 9.00504C5.81982 9.37267 6.12061 9.66091 6.50076 9.66091Z"
                              fill="white"></path>
                            <path
                              d="M5.87413 3.17832H5.51535L5.52424 3.537L5.6245 7.58083L5.63296 7.92216H5.97439H7.02713H7.36856L7.37702 7.58083L7.47728 3.537L7.48617 3.17832H7.12739H5.87413ZM6.50076 10.0109C7.06121 10.0109 7.5317 9.57872 7.5317 9.00504C7.5317 8.43137 7.06121 7.99918 6.50076 7.99918C5.94031 7.99918 5.46982 8.43137 5.46982 9.00504C5.46982 9.57872 5.94031 10.0109 6.50076 10.0109Z"
                              fill="white" stroke="#EB001B" stroke-width="0.7">
                            </path>
                          </svg>
                          <span class="product-form__error-message"></span>
                        </div>
                        <form method="post" action="cart_add.php"
                          id="product-form-template--17996521046172__collection_slider_c7fFVc-8275152076956"
                          accept-charset="UTF-8" class="form" enctype="multipart/form-data" novalidate="novalidate"
                          data-type="add-to-cart-form"><input type="hidden" name="form_type" value="product"><input
                            type="hidden" name="utf8" value="✓"><input type="hidden" name="id" value="44501607055516"
                            disabled="">
                          <div class="product-card__bottom">
                            <div class="no-js-hidden price"
                              id="price-template--17996521046172__collection_slider_c7fFVc-8275152076956" role="status">

                              <ins class="price-item--regular"><span class="money"> Lei7.99</span></ins>






                            </div>
                            <button type="submit" name="add" class="btn btn--secondary product-form__submit"
                              aria-label="Add to Cart"><span>Add to Cart</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"
                                fill="none">
                                <path
                                  d="M3.22708 14.1828L2.22412 8.19984C2.07247 7.29523 1.99665 6.84293 2.23945 6.54647C2.48226 6.25 2.92852 6.25 3.82104 6.25H16.1783C17.0708 6.25 17.5171 6.25 17.7599 6.54647C18.0027 6.84293 17.9268 7.29523 17.7753 8.19984L16.7723 14.1828C16.4398 16.1659 16.2736 17.1574 15.5949 17.7454C14.9163 18.3333 13.938 18.3333 11.9815 18.3333H8.01786C6.06131 18.3333 5.08303 18.3333 4.40438 17.7454C3.72573 17.1574 3.55952 16.1659 3.22708 14.1828Z"
                                  stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                  d="M14.5837 6.25008C14.5837 3.71877 12.5317 1.66675 10.0003 1.66675C7.46902 1.66675 5.41699 3.71877 5.41699 6.25008"
                                  stroke="currentColor" stroke-width="1.5"></path>
                              </svg>

                              <div class="loading-overlay__spinner hidden">

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                  version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 511.494 511.494"
                                  style="enable-background:new 0 0 511.494 511.494;" xml:space="preserve" width="20"
                                  height="20">
                                  <g>
                                    <path
                                      d="M478.291,255.492c-16.133,0.143-29.689,12.161-31.765,28.16c-15.37,105.014-112.961,177.685-217.975,162.315 S50.866,333.006,66.236,227.992S179.197,50.307,284.211,65.677c35.796,5.239,69.386,20.476,96.907,43.959l-24.107,24.107   c-8.33,8.332-8.328,21.84,0.004,30.17c4.015,4.014,9.465,6.262,15.142,6.246h97.835c11.782,0,21.333-9.551,21.333-21.333V50.991   c-0.003-11.782-9.556-21.331-21.338-21.329c-5.655,0.001-11.079,2.248-15.078,6.246l-28.416,28.416   C320.774-29.34,159.141-19.568,65.476,86.152S-18.415,353.505,87.304,447.17s267.353,83.892,361.017-21.828   c32.972-37.216,54.381-83.237,61.607-132.431c2.828-17.612-9.157-34.183-26.769-37.011   C481.549,255.641,479.922,255.505,478.291,255.492z">
                                    </path>
                                  </g>
                                </svg>

                              </div>
                            </button>
                          </div><input type="hidden" name="product-id" value="8275152076956"><input type="hidden"
                            name="section-id" value="template--17996521046172__collection_slider_c7fFVc">
                        </form>
                      </product-form>
                    </div>
                  </div>
                </div>

              </div>

            </div>
          </div>
        </div>
      </div>

      <script>
        document.addEventListener('DOMContentLoaded', function () {
          const swiper = new Swiper('.collection-slider__swiper', {
            speed: 400,
            spaceBetween: 18,
            slidesPerView: 'auto',
            slidesPerGroup: 1,
            slideShadows: true,
            breakpoints: {
              1200: {
                slidesPerView: 4,
                spaceBetween: 40,
              },
              767: {
                slidesPerView: 3,
              },
            },
          });
        });
      </script>


    </div>
    <div id="shopify-section-template--17996521046172__collection_slider_b6Hqnw" class="shopify-section">
      <style>
        .collection-slider__container {
          overflow: hidden;
        }

        .collection-slider__header {
          display: flex;
          flex-wrap: nowrap;
          justify-content: space-between;
          align-items: center;
          padding-bottom: 26px;
        }

        .collection-slider__swiper .collection-slide {
          max-width: 316px;
        }

        .collection-slider__swiper .collection-slide .product-card-inner.card-inner {
          height: 100%;
        }


        @media screen and (max-width: 767px) {
          .collection-slider__swiper .collection-slide {
            max-width: 265px;
          }
        }
      </style>

      <div class="collection-slider__wrap">
        <div class="collection-slider__container container padding-bottom">
          <div class="collection-slider__header">
            <h3 class="collection-slider__title">
              Kitchen and Dining
            </h3>

            <a href="shop.php?category=kitchen-appliances" class="btn btn--secondary btn--lg btn--arrow">
              Show more

              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M20 12H4" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round"></path>
                <path d="M15 17C15 17 20 13.3176 20 12C20 10.6824 15 7 15 7" stroke="currentColor" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>

            </a>

          </div>
          <div class="collection-slider__swiper">
            <div class="swiper-wrapper">

              <div class="collection-slide swiper-slide">
                <div class="product-card-inner card-inner">
                  <div id="pro-template--17996521046172__collection_slider_b6Hqnw-8446920163484"
                    class="product-card-image card__media"><a
                      href="#butterfly-matchless-mixer-grinder-food-processor-elektra-5-jars-1hp-powerful-motor"
                      title="Butterfly Matchless Mixer Grinder Food Processor Elektra 5 jars 1HP Powerful Motor"
                      class="product__media-item"
                      data-media-id="template--17996521046172__collection_slider_b6Hqnw-8446920163484-33639948451996"
                      tabindex="0">
                      <img loading="lazy" class=""
                        srcset="uploads/ell_91442620-7916-416e-bd0f-6b88bdebf263_600x400_v=1749653406.webp"
                        alt="">
                    </a>
                    <div class="wish-lbl-wrp">

                      <div class="pro-wishlist">
                        <label>
                          <span class="wishlist-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                              fill="none">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.1335 2.95108C16.73 4.16664 16.9557 6.44579 15.6274 7.93897L8.99983 15.3894L2.37233 7.93977C1.04381 6.44646 1.26946 4.167 2.86616 2.95128C4.50032 1.70704 6.87275 2.10393 7.99225 3.80885L8.36782 4.38082C8.59267 4.72325 9.05847 4.82238 9.40821 4.60224C9.51777 4.53328 9.60294 4.44117 9.66134 4.33666L10.0076 3.80914C11.1268 2.10394 13.4993 1.70679 15.1335 2.95108ZM8.99998 2.653C7.31724 0.526225 4.15516 0.102335 1.94184 1.78754C-0.33726 3.52284 -0.659353 6.77651 1.23696 8.90805L8.4334 16.9972C8.7065 17.3041 9.18204 17.3362 9.49557 17.0688C9.53631 17.0341 9.57231 16.996 9.60351 16.9553L16.7628 8.90721C18.6589 6.77579 18.3367 3.52246 16.0579 1.78734C13.8446 0.102142 10.6825 0.526185 8.99998 2.653Z"
                                fill=" #4F4632"></path>
                            </svg>
                          </span>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="butterfly-matchless-mixer-grinder-food-processor-elektra-5-jars-1hp-powerful-motor"><span
                            class="checkmark"></span>
                        </label>
                      </div>


                      <div class="pro-compare">
                        <label>
                          <span class="compare-label">
                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M9.80006 12.5C9.66163 12.5 9.52632 12.4585 9.41123 12.3809C9.29614 12.3033 9.20644 12.193 9.15347 12.0639C9.1005 11.9349 9.08664 11.7928 9.11364 11.6558C9.14064 11.5188 9.20728 11.393 9.30515 11.2942L11.6103 8.96804H2.79991C2.61426 8.96804 2.4362 8.89361 2.30493 8.76114C2.17365 8.62866 2.0999 8.44899 2.0999 8.26164C2.0999 8.0743 2.17365 7.89462 2.30493 7.76215C2.4362 7.62967 2.61426 7.55525 2.79991 7.55525H13.3001C13.4386 7.55528 13.5739 7.59672 13.689 7.67435C13.8041 7.75197 13.8938 7.86228 13.9467 7.99134C13.9997 8.1204 14.0136 8.2624 13.9866 8.39941C13.9596 8.53642 13.8929 8.66227 13.795 8.76106L10.295 12.293C10.1637 12.4255 9.9857 12.5 9.80006 12.5ZM11.9001 4.72968C11.9001 4.54233 11.8264 4.36266 11.6951 4.23018C11.5638 4.09771 11.3857 4.02328 11.2001 4.02328H2.3897L4.69485 1.69713C4.82236 1.56391 4.89292 1.38547 4.89133 1.20025C4.88973 1.01504 4.81611 0.837869 4.68632 0.706898C4.55654 0.575927 4.38096 0.501636 4.19742 0.500027C4.01388 0.498417 3.83705 0.569618 3.70503 0.698293L0.204955 4.23026C0.107087 4.32905 0.0404406 4.4549 0.0134427 4.59191C-0.0135551 4.72892 0.000307272 4.87092 0.0532774 4.99998C0.106248 5.12904 0.195947 5.23935 0.311036 5.31697C0.426126 5.3946 0.561438 5.43604 0.699866 5.43607H11.2001C11.3857 5.43607 11.5638 5.36165 11.6951 5.22917C11.8264 5.0967 11.9001 4.91703 11.9001 4.72968Z"
                                fill="#4F4632"></path>
                            </svg>
                          </span>
                          <a class="compare-now" href="/pages/compare" style="display:none;"> Compare Now </a>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="butterfly-matchless-mixer-grinder-food-processor-elektra-5-jars-1hp-powerful-motor"><span
                            class="checkmark"></span>
                        </label>
                      </div>


                      <div class="quickview-btn" id="quickview">
                        <a style="text-decoration:none"
                          href="#butterfly-matchless-mixer-grinder-food-processor-elektra-5-jars-1hp-powerful-motor"
                          data-handle="butterfly-matchless-mixer-grinder-food-processor-elektra-5-jars-1hp-powerful-motor">
                          <svg width="14" height="11" viewBox="0 0 14 11" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M6.99996 3.15912C5.70988 3.15912 4.66016 4.20885 4.66016 5.49892C4.66016 6.789 5.70988 7.83873 6.99996 7.83873C8.29004 7.83873 9.33977 6.789 9.33977 5.49892C9.33977 4.20885 8.29004 3.15912 6.99996 3.15912ZM6.99996 6.8724C6.24254 6.8724 5.62648 6.25635 5.62648 5.49892C5.62648 4.7415 6.24254 4.12545 6.99996 4.12545C7.75738 4.12545 8.37344 4.7415 8.37344 5.49892C8.37344 6.25635 7.75738 6.8724 6.99996 6.8724Z"
                              fill="#4F4632"></path>
                            <path
                              d="M13.4184 4.21786C13.1537 3.8509 12.6889 3.28735 11.9785 2.68715C11.2954 2.10993 10.561 1.64782 9.79562 1.31368C8.87633 0.912544 7.9357 0.709106 7 0.709106C6.0643 0.709106 5.12367 0.912544 4.2041 1.31368C3.43875 1.64754 2.7043 2.10965 2.02125 2.68715C1.31086 3.28762 0.846016 3.8509 0.581328 4.21786C0.195781 4.7527 0 5.18418 0 5.5C0 5.81582 0.195508 6.24731 0.581602 6.78215C0.846289 7.14911 1.31113 7.71266 2.02152 8.31286C2.70457 8.89008 3.43902 9.35219 4.20437 9.68633C5.12367 10.0875 6.06457 10.2909 7.00027 10.2909C7.93598 10.2909 8.8766 10.0875 9.79617 9.68633C10.5615 9.35247 11.296 8.89036 11.979 8.31286C12.6894 7.71239 13.1543 7.14911 13.4189 6.78215C13.8045 6.24731 14 5.81582 14 5.5C14 5.18418 13.8045 4.7527 13.4184 4.21786ZM11.293 7.62653C10.3592 8.40118 8.85637 9.32457 7 9.32457C5.14363 9.32457 3.64109 8.40118 2.70703 7.62653C1.56406 6.67852 1.00816 5.73625 0.967422 5.5C1.00789 5.26375 1.56406 4.32149 2.70703 3.37348C3.64082 2.59883 5.14363 1.67543 7 1.67543C8.85609 1.67543 10.3589 2.59883 11.293 3.37348C12.4359 4.32149 12.9921 5.26375 13.0326 5.5C12.9918 5.73625 12.4359 6.67852 11.293 7.62653Z"
                              fill="#4F4632"></path>
                          </svg>
                        </a>
                      </div>

                    </div>

                  </div>
                  <div id="ProductInfo-template--17996521046172__collection_slider_b6Hqnw" class="product-content">
                    <div class="product-content-top">

                      <div class="product-type"></div>

                      <h3 class="product-title">
                        <a href="#butterfly-matchless-mixer-grinder-food-processor-elektra-5-jars-1hp-powerful-motor">Butterfly
                          Matchless Mixer Grinder Food Processor Elektra 5 jars 1HP Powerful Motor</a>
                      </h3>

                      <!-- Start of Judge.me code -->
                      <div class="jdgm-widget jdgm-preview-badge">
                        <div style="display:none" class="jdgm-prev-badge" data-average-rating="0.00"
                          data-number-of-reviews="0" data-number-of-questions="0"> <span class="jdgm-prev-badge__stars"
                            data-score="0.00" tabindex="0" aria-label="0.00 stars" role="button"> <span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span> </span> <span class="jdgm-prev-badge__text"> No
                            reviews </span> </div>
                      </div>
                      <!-- End of Judge.me code -->

                    </div>
                    <div id="ProductInfo-template--17996521046172__collection_slider_b6Hqnw-8446920163484"
                      class="product-content-bottom">
                      <div class="product-selectors">


                      </div>
                      <product-form class="product-form">
                        <div class="wbquicksuccess hidden" hidden="">Translation missing:
                          en.wbcustomlabel.wballtext.quicksuccessmsg</div>
                        <div class="product-form__error-message-wrapper" role="alert" hidden="">
                          <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-error"
                            viewBox="0 0 13 13" width="25" height="25">
                            <circle cx="6.5" cy="6.50049" r="5.5" stroke="white" stroke-width="2"></circle>
                            <circle cx="6.5" cy="6.5" r="5.5" fill="#EB001B" stroke="#EB001B" stroke-width="0.7">
                            </circle>
                            <path
                              d="M5.87413 3.52832L5.97439 7.57216H7.02713L7.12739 3.52832H5.87413ZM6.50076 9.66091C6.88091 9.66091 7.18169 9.37267 7.18169 9.00504C7.18169 8.63742 6.88091 8.34917 6.50076 8.34917C6.12061 8.34917 5.81982 8.63742 5.81982 9.00504C5.81982 9.37267 6.12061 9.66091 6.50076 9.66091Z"
                              fill="white"></path>
                            <path
                              d="M5.87413 3.17832H5.51535L5.52424 3.537L5.6245 7.58083L5.63296 7.92216H5.97439H7.02713H7.36856L7.37702 7.58083L7.47728 3.537L7.48617 3.17832H7.12739H5.87413ZM6.50076 10.0109C7.06121 10.0109 7.5317 9.57872 7.5317 9.00504C7.5317 8.43137 7.06121 7.99918 6.50076 7.99918C5.94031 7.99918 5.46982 8.43137 5.46982 9.00504C5.46982 9.57872 5.94031 10.0109 6.50076 10.0109Z"
                              fill="white" stroke="#EB001B" stroke-width="0.7">
                            </path>
                          </svg>
                          <span class="product-form__error-message"></span>
                        </div>
                        <form method="post" action="cart_add.php"
                          id="product-form-template--17996521046172__collection_slider_b6Hqnw-8446920163484"
                          accept-charset="UTF-8" class="form" enctype="multipart/form-data" novalidate="novalidate"
                          data-type="add-to-cart-form"><input type="hidden" name="form_type" value="product"><input
                            type="hidden" name="utf8" value="✓"><input type="hidden" name="id" value="45040273260700"
                            disabled="">
                          <div class="product-card__bottom">
                            <div class="no-js-hidden price"
                              id="price-template--17996521046172__collection_slider_b6Hqnw-8446920163484" role="status">

                              <ins class="price-item--regular"><span class="money"> Lei550.00</span></ins>






                            </div>
                            <button type="submit" name="add" class="btn btn--secondary product-form__submit"
                              aria-label="Add to Cart"><span>Add to Cart</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"
                                fill="none">
                                <path
                                  d="M3.22708 14.1828L2.22412 8.19984C2.07247 7.29523 1.99665 6.84293 2.23945 6.54647C2.48226 6.25 2.92852 6.25 3.82104 6.25H16.1783C17.0708 6.25 17.5171 6.25 17.7599 6.54647C18.0027 6.84293 17.9268 7.29523 17.7753 8.19984L16.7723 14.1828C16.4398 16.1659 16.2736 17.1574 15.5949 17.7454C14.9163 18.3333 13.938 18.3333 11.9815 18.3333H8.01786C6.06131 18.3333 5.08303 18.3333 4.40438 17.7454C3.72573 17.1574 3.55952 16.1659 3.22708 14.1828Z"
                                  stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                  d="M14.5837 6.25008C14.5837 3.71877 12.5317 1.66675 10.0003 1.66675C7.46902 1.66675 5.41699 3.71877 5.41699 6.25008"
                                  stroke="currentColor" stroke-width="1.5"></path>
                              </svg>

                              <div class="loading-overlay__spinner hidden">

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                  version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 511.494 511.494"
                                  style="enable-background:new 0 0 511.494 511.494;" xml:space="preserve" width="20"
                                  height="20">
                                  <g>
                                    <path
                                      d="M478.291,255.492c-16.133,0.143-29.689,12.161-31.765,28.16c-15.37,105.014-112.961,177.685-217.975,162.315 S50.866,333.006,66.236,227.992S179.197,50.307,284.211,65.677c35.796,5.239,69.386,20.476,96.907,43.959l-24.107,24.107   c-8.33,8.332-8.328,21.84,0.004,30.17c4.015,4.014,9.465,6.262,15.142,6.246h97.835c11.782,0,21.333-9.551,21.333-21.333V50.991   c-0.003-11.782-9.556-21.331-21.338-21.329c-5.655,0.001-11.079,2.248-15.078,6.246l-28.416,28.416   C320.774-29.34,159.141-19.568,65.476,86.152S-18.415,353.505,87.304,447.17s267.353,83.892,361.017-21.828   c32.972-37.216,54.381-83.237,61.607-132.431c2.828-17.612-9.157-34.183-26.769-37.011   C481.549,255.641,479.922,255.505,478.291,255.492z">
                                    </path>
                                  </g>
                                </svg>

                              </div>
                            </button>
                          </div><input type="hidden" name="product-id" value="8446920163484"><input type="hidden"
                            name="section-id" value="template--17996521046172__collection_slider_b6Hqnw">
                        </form>
                      </product-form>
                    </div>
                  </div>
                </div>

              </div>

              <div class="collection-slide swiper-slide">
                <div class="product-card-inner card-inner">
                  <div id="pro-template--17996521046172__collection_slider_b6Hqnw-8446920327324"
                    class="product-card-image card__media"><a href="#copper-glass-1pc" title="Copper Glass 1pc"
                      class="product__media-item"
                      data-media-id="template--17996521046172__collection_slider_b6Hqnw-8446920327324-33639949631644"
                      tabindex="0">
                      <img loading="lazy" class=""
                        srcset="uploads/glassd_f539ed29-a7ff-4221-be9d-22cc6a716cbd_600x400_v=1749653418.webp"
                        alt="">
                    </a>
                    <div class="wish-lbl-wrp">

                      <div class="pro-wishlist">
                        <label>
                          <span class="wishlist-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                              fill="none">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.1335 2.95108C16.73 4.16664 16.9557 6.44579 15.6274 7.93897L8.99983 15.3894L2.37233 7.93977C1.04381 6.44646 1.26946 4.167 2.86616 2.95128C4.50032 1.70704 6.87275 2.10393 7.99225 3.80885L8.36782 4.38082C8.59267 4.72325 9.05847 4.82238 9.40821 4.60224C9.51777 4.53328 9.60294 4.44117 9.66134 4.33666L10.0076 3.80914C11.1268 2.10394 13.4993 1.70679 15.1335 2.95108ZM8.99998 2.653C7.31724 0.526225 4.15516 0.102335 1.94184 1.78754C-0.33726 3.52284 -0.659353 6.77651 1.23696 8.90805L8.4334 16.9972C8.7065 17.3041 9.18204 17.3362 9.49557 17.0688C9.53631 17.0341 9.57231 16.996 9.60351 16.9553L16.7628 8.90721C18.6589 6.77579 18.3367 3.52246 16.0579 1.78734C13.8446 0.102142 10.6825 0.526185 8.99998 2.653Z"
                                fill=" #4F4632"></path>
                            </svg>
                          </span>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="copper-glass-1pc"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="pro-compare">
                        <label>
                          <span class="compare-label">
                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M9.80006 12.5C9.66163 12.5 9.52632 12.4585 9.41123 12.3809C9.29614 12.3033 9.20644 12.193 9.15347 12.0639C9.1005 11.9349 9.08664 11.7928 9.11364 11.6558C9.14064 11.5188 9.20728 11.393 9.30515 11.2942L11.6103 8.96804H2.79991C2.61426 8.96804 2.4362 8.89361 2.30493 8.76114C2.17365 8.62866 2.0999 8.44899 2.0999 8.26164C2.0999 8.0743 2.17365 7.89462 2.30493 7.76215C2.4362 7.62967 2.61426 7.55525 2.79991 7.55525H13.3001C13.4386 7.55528 13.5739 7.59672 13.689 7.67435C13.8041 7.75197 13.8938 7.86228 13.9467 7.99134C13.9997 8.1204 14.0136 8.2624 13.9866 8.39941C13.9596 8.53642 13.8929 8.66227 13.795 8.76106L10.295 12.293C10.1637 12.4255 9.9857 12.5 9.80006 12.5ZM11.9001 4.72968C11.9001 4.54233 11.8264 4.36266 11.6951 4.23018C11.5638 4.09771 11.3857 4.02328 11.2001 4.02328H2.3897L4.69485 1.69713C4.82236 1.56391 4.89292 1.38547 4.89133 1.20025C4.88973 1.01504 4.81611 0.837869 4.68632 0.706898C4.55654 0.575927 4.38096 0.501636 4.19742 0.500027C4.01388 0.498417 3.83705 0.569618 3.70503 0.698293L0.204955 4.23026C0.107087 4.32905 0.0404406 4.4549 0.0134427 4.59191C-0.0135551 4.72892 0.000307272 4.87092 0.0532774 4.99998C0.106248 5.12904 0.195947 5.23935 0.311036 5.31697C0.426126 5.3946 0.561438 5.43604 0.699866 5.43607H11.2001C11.3857 5.43607 11.5638 5.36165 11.6951 5.22917C11.8264 5.0967 11.9001 4.91703 11.9001 4.72968Z"
                                fill="#4F4632"></path>
                            </svg>
                          </span>
                          <a class="compare-now" href="/pages/compare" style="display:none;"> Compare Now </a>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="copper-glass-1pc"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="quickview-btn" id="quickview">
                        <a style="text-decoration:none" href="#copper-glass-1pc" data-handle="copper-glass-1pc">
                          <svg width="14" height="11" viewBox="0 0 14 11" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M6.99996 3.15912C5.70988 3.15912 4.66016 4.20885 4.66016 5.49892C4.66016 6.789 5.70988 7.83873 6.99996 7.83873C8.29004 7.83873 9.33977 6.789 9.33977 5.49892C9.33977 4.20885 8.29004 3.15912 6.99996 3.15912ZM6.99996 6.8724C6.24254 6.8724 5.62648 6.25635 5.62648 5.49892C5.62648 4.7415 6.24254 4.12545 6.99996 4.12545C7.75738 4.12545 8.37344 4.7415 8.37344 5.49892C8.37344 6.25635 7.75738 6.8724 6.99996 6.8724Z"
                              fill="#4F4632"></path>
                            <path
                              d="M13.4184 4.21786C13.1537 3.8509 12.6889 3.28735 11.9785 2.68715C11.2954 2.10993 10.561 1.64782 9.79562 1.31368C8.87633 0.912544 7.9357 0.709106 7 0.709106C6.0643 0.709106 5.12367 0.912544 4.2041 1.31368C3.43875 1.64754 2.7043 2.10965 2.02125 2.68715C1.31086 3.28762 0.846016 3.8509 0.581328 4.21786C0.195781 4.7527 0 5.18418 0 5.5C0 5.81582 0.195508 6.24731 0.581602 6.78215C0.846289 7.14911 1.31113 7.71266 2.02152 8.31286C2.70457 8.89008 3.43902 9.35219 4.20437 9.68633C5.12367 10.0875 6.06457 10.2909 7.00027 10.2909C7.93598 10.2909 8.8766 10.0875 9.79617 9.68633C10.5615 9.35247 11.296 8.89036 11.979 8.31286C12.6894 7.71239 13.1543 7.14911 13.4189 6.78215C13.8045 6.24731 14 5.81582 14 5.5C14 5.18418 13.8045 4.7527 13.4184 4.21786ZM11.293 7.62653C10.3592 8.40118 8.85637 9.32457 7 9.32457C5.14363 9.32457 3.64109 8.40118 2.70703 7.62653C1.56406 6.67852 1.00816 5.73625 0.967422 5.5C1.00789 5.26375 1.56406 4.32149 2.70703 3.37348C3.64082 2.59883 5.14363 1.67543 7 1.67543C8.85609 1.67543 10.3589 2.59883 11.293 3.37348C12.4359 4.32149 12.9921 5.26375 13.0326 5.5C12.9918 5.73625 12.4359 6.67852 11.293 7.62653Z"
                              fill="#4F4632"></path>
                          </svg>
                        </a>
                      </div>

                    </div>

                  </div>
                  <div id="ProductInfo-template--17996521046172__collection_slider_b6Hqnw" class="product-content">
                    <div class="product-content-top">

                      <div class="product-type"></div>

                      <h3 class="product-title">
                        <a href="#copper-glass-1pc">Copper Glass 1pc</a>
                      </h3>

                      <!-- Start of Judge.me code -->
                      <div class="jdgm-widget jdgm-preview-badge">
                        <div style="display:none" class="jdgm-prev-badge" data-average-rating="0.00"
                          data-number-of-reviews="0" data-number-of-questions="0"> <span class="jdgm-prev-badge__stars"
                            data-score="0.00" tabindex="0" aria-label="0.00 stars" role="button"> <span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span> </span> <span class="jdgm-prev-badge__text"> No
                            reviews </span> </div>
                      </div>
                      <!-- End of Judge.me code -->

                    </div>
                    <div id="ProductInfo-template--17996521046172__collection_slider_b6Hqnw-8446920327324"
                      class="product-content-bottom">
                      <div class="product-selectors">


                      </div>
                      <product-form class="product-form">
                        <div class="wbquicksuccess hidden" hidden="">Translation missing:
                          en.wbcustomlabel.wballtext.quicksuccessmsg</div>
                        <div class="product-form__error-message-wrapper" role="alert" hidden="">
                          <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-error"
                            viewBox="0 0 13 13" width="25" height="25">
                            <circle cx="6.5" cy="6.50049" r="5.5" stroke="white" stroke-width="2"></circle>
                            <circle cx="6.5" cy="6.5" r="5.5" fill="#EB001B" stroke="#EB001B" stroke-width="0.7">
                            </circle>
                            <path
                              d="M5.87413 3.52832L5.97439 7.57216H7.02713L7.12739 3.52832H5.87413ZM6.50076 9.66091C6.88091 9.66091 7.18169 9.37267 7.18169 9.00504C7.18169 8.63742 6.88091 8.34917 6.50076 8.34917C6.12061 8.34917 5.81982 8.63742 5.81982 9.00504C5.81982 9.37267 6.12061 9.66091 6.50076 9.66091Z"
                              fill="white"></path>
                            <path
                              d="M5.87413 3.17832H5.51535L5.52424 3.537L5.6245 7.58083L5.63296 7.92216H5.97439H7.02713H7.36856L7.37702 7.58083L7.47728 3.537L7.48617 3.17832H7.12739H5.87413ZM6.50076 10.0109C7.06121 10.0109 7.5317 9.57872 7.5317 9.00504C7.5317 8.43137 7.06121 7.99918 6.50076 7.99918C5.94031 7.99918 5.46982 8.43137 5.46982 9.00504C5.46982 9.57872 5.94031 10.0109 6.50076 10.0109Z"
                              fill="white" stroke="#EB001B" stroke-width="0.7">
                            </path>
                          </svg>
                          <span class="product-form__error-message"></span>
                        </div>
                        <form method="post" action="cart_add.php"
                          id="product-form-template--17996521046172__collection_slider_b6Hqnw-8446920327324"
                          accept-charset="UTF-8" class="form" enctype="multipart/form-data" novalidate="novalidate"
                          data-type="add-to-cart-form"><input type="hidden" name="form_type" value="product"><input
                            type="hidden" name="utf8" value="✓"><input type="hidden" name="id" value="45040273522844"
                            disabled="">
                          <div class="product-card__bottom">
                            <div class="no-js-hidden price"
                              id="price-template--17996521046172__collection_slider_b6Hqnw-8446920327324" role="status">

                              <ins class="price-item--regular"><span class="money"> Lei45.00</span></ins>






                            </div>
                            <button type="submit" name="add" class="btn btn--secondary product-form__submit"
                              aria-label="Add to Cart"><span>Add to Cart</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"
                                fill="none">
                                <path
                                  d="M3.22708 14.1828L2.22412 8.19984C2.07247 7.29523 1.99665 6.84293 2.23945 6.54647C2.48226 6.25 2.92852 6.25 3.82104 6.25H16.1783C17.0708 6.25 17.5171 6.25 17.7599 6.54647C18.0027 6.84293 17.9268 7.29523 17.7753 8.19984L16.7723 14.1828C16.4398 16.1659 16.2736 17.1574 15.5949 17.7454C14.9163 18.3333 13.938 18.3333 11.9815 18.3333H8.01786C6.06131 18.3333 5.08303 18.3333 4.40438 17.7454C3.72573 17.1574 3.55952 16.1659 3.22708 14.1828Z"
                                  stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                  d="M14.5837 6.25008C14.5837 3.71877 12.5317 1.66675 10.0003 1.66675C7.46902 1.66675 5.41699 3.71877 5.41699 6.25008"
                                  stroke="currentColor" stroke-width="1.5"></path>
                              </svg>

                              <div class="loading-overlay__spinner hidden">

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                  version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 511.494 511.494"
                                  style="enable-background:new 0 0 511.494 511.494;" xml:space="preserve" width="20"
                                  height="20">
                                  <g>
                                    <path
                                      d="M478.291,255.492c-16.133,0.143-29.689,12.161-31.765,28.16c-15.37,105.014-112.961,177.685-217.975,162.315 S50.866,333.006,66.236,227.992S179.197,50.307,284.211,65.677c35.796,5.239,69.386,20.476,96.907,43.959l-24.107,24.107   c-8.33,8.332-8.328,21.84,0.004,30.17c4.015,4.014,9.465,6.262,15.142,6.246h97.835c11.782,0,21.333-9.551,21.333-21.333V50.991   c-0.003-11.782-9.556-21.331-21.338-21.329c-5.655,0.001-11.079,2.248-15.078,6.246l-28.416,28.416   C320.774-29.34,159.141-19.568,65.476,86.152S-18.415,353.505,87.304,447.17s267.353,83.892,361.017-21.828   c32.972-37.216,54.381-83.237,61.607-132.431c2.828-17.612-9.157-34.183-26.769-37.011   C481.549,255.641,479.922,255.505,478.291,255.492z">
                                    </path>
                                  </g>
                                </svg>

                              </div>
                            </button>
                          </div><input type="hidden" name="product-id" value="8446920327324"><input type="hidden"
                            name="section-id" value="template--17996521046172__collection_slider_b6Hqnw">
                        </form>
                      </product-form>
                    </div>
                  </div>
                </div>

              </div>

              <div class="collection-slide swiper-slide">
                <div class="product-card-inner card-inner">
                  <div id="pro-template--17996521046172__collection_slider_b6Hqnw-8496203071644"
                    class="product-card-image card__media"><a
                      href="#premier-cute-550w-mixer-grinder-food-processor-km512"
                      title="Premier Cute 550W Mixer Grinder Food Processor KM512" class="product__media-item"
                      data-media-id="template--17996521046172__collection_slider_b6Hqnw-8496203071644-33997049626780"
                      tabindex="0">
                      <img loading="lazy" class=""
                        srcset="uploads/premier550w_600x400_v=1756208621.webp"
                        alt="">
                    </a>
                    <div class="wish-lbl-wrp">

                      <div class="pro-wishlist">
                        <label>
                          <span class="wishlist-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                              fill="none">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.1335 2.95108C16.73 4.16664 16.9557 6.44579 15.6274 7.93897L8.99983 15.3894L2.37233 7.93977C1.04381 6.44646 1.26946 4.167 2.86616 2.95128C4.50032 1.70704 6.87275 2.10393 7.99225 3.80885L8.36782 4.38082C8.59267 4.72325 9.05847 4.82238 9.40821 4.60224C9.51777 4.53328 9.60294 4.44117 9.66134 4.33666L10.0076 3.80914C11.1268 2.10394 13.4993 1.70679 15.1335 2.95108ZM8.99998 2.653C7.31724 0.526225 4.15516 0.102335 1.94184 1.78754C-0.33726 3.52284 -0.659353 6.77651 1.23696 8.90805L8.4334 16.9972C8.7065 17.3041 9.18204 17.3362 9.49557 17.0688C9.53631 17.0341 9.57231 16.996 9.60351 16.9553L16.7628 8.90721C18.6589 6.77579 18.3367 3.52246 16.0579 1.78734C13.8446 0.102142 10.6825 0.526185 8.99998 2.653Z"
                                fill=" #4F4632"></path>
                            </svg>
                          </span>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="premier-cute-550w-mixer-grinder-food-processor-km512"><span
                            class="checkmark"></span>
                        </label>
                      </div>


                      <div class="pro-compare">
                        <label>
                          <span class="compare-label">
                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M9.80006 12.5C9.66163 12.5 9.52632 12.4585 9.41123 12.3809C9.29614 12.3033 9.20644 12.193 9.15347 12.0639C9.1005 11.9349 9.08664 11.7928 9.11364 11.6558C9.14064 11.5188 9.20728 11.393 9.30515 11.2942L11.6103 8.96804H2.79991C2.61426 8.96804 2.4362 8.89361 2.30493 8.76114C2.17365 8.62866 2.0999 8.44899 2.0999 8.26164C2.0999 8.0743 2.17365 7.89462 2.30493 7.76215C2.4362 7.62967 2.61426 7.55525 2.79991 7.55525H13.3001C13.4386 7.55528 13.5739 7.59672 13.689 7.67435C13.8041 7.75197 13.8938 7.86228 13.9467 7.99134C13.9997 8.1204 14.0136 8.2624 13.9866 8.39941C13.9596 8.53642 13.8929 8.66227 13.795 8.76106L10.295 12.293C10.1637 12.4255 9.9857 12.5 9.80006 12.5ZM11.9001 4.72968C11.9001 4.54233 11.8264 4.36266 11.6951 4.23018C11.5638 4.09771 11.3857 4.02328 11.2001 4.02328H2.3897L4.69485 1.69713C4.82236 1.56391 4.89292 1.38547 4.89133 1.20025C4.88973 1.01504 4.81611 0.837869 4.68632 0.706898C4.55654 0.575927 4.38096 0.501636 4.19742 0.500027C4.01388 0.498417 3.83705 0.569618 3.70503 0.698293L0.204955 4.23026C0.107087 4.32905 0.0404406 4.4549 0.0134427 4.59191C-0.0135551 4.72892 0.000307272 4.87092 0.0532774 4.99998C0.106248 5.12904 0.195947 5.23935 0.311036 5.31697C0.426126 5.3946 0.561438 5.43604 0.699866 5.43607H11.2001C11.3857 5.43607 11.5638 5.36165 11.6951 5.22917C11.8264 5.0967 11.9001 4.91703 11.9001 4.72968Z"
                                fill="#4F4632"></path>
                            </svg>
                          </span>
                          <a class="compare-now" href="/pages/compare" style="display:none;"> Compare Now </a>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="premier-cute-550w-mixer-grinder-food-processor-km512"><span
                            class="checkmark"></span>
                        </label>
                      </div>


                      <div class="quickview-btn" id="quickview">
                        <a style="text-decoration:none" href="#premier-cute-550w-mixer-grinder-food-processor-km512"
                          data-handle="premier-cute-550w-mixer-grinder-food-processor-km512">
                          <svg width="14" height="11" viewBox="0 0 14 11" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M6.99996 3.15912C5.70988 3.15912 4.66016 4.20885 4.66016 5.49892C4.66016 6.789 5.70988 7.83873 6.99996 7.83873C8.29004 7.83873 9.33977 6.789 9.33977 5.49892C9.33977 4.20885 8.29004 3.15912 6.99996 3.15912ZM6.99996 6.8724C6.24254 6.8724 5.62648 6.25635 5.62648 5.49892C5.62648 4.7415 6.24254 4.12545 6.99996 4.12545C7.75738 4.12545 8.37344 4.7415 8.37344 5.49892C8.37344 6.25635 7.75738 6.8724 6.99996 6.8724Z"
                              fill="#4F4632"></path>
                            <path
                              d="M13.4184 4.21786C13.1537 3.8509 12.6889 3.28735 11.9785 2.68715C11.2954 2.10993 10.561 1.64782 9.79562 1.31368C8.87633 0.912544 7.9357 0.709106 7 0.709106C6.0643 0.709106 5.12367 0.912544 4.2041 1.31368C3.43875 1.64754 2.7043 2.10965 2.02125 2.68715C1.31086 3.28762 0.846016 3.8509 0.581328 4.21786C0.195781 4.7527 0 5.18418 0 5.5C0 5.81582 0.195508 6.24731 0.581602 6.78215C0.846289 7.14911 1.31113 7.71266 2.02152 8.31286C2.70457 8.89008 3.43902 9.35219 4.20437 9.68633C5.12367 10.0875 6.06457 10.2909 7.00027 10.2909C7.93598 10.2909 8.8766 10.0875 9.79617 9.68633C10.5615 9.35247 11.296 8.89036 11.979 8.31286C12.6894 7.71239 13.1543 7.14911 13.4189 6.78215C13.8045 6.24731 14 5.81582 14 5.5C14 5.18418 13.8045 4.7527 13.4184 4.21786ZM11.293 7.62653C10.3592 8.40118 8.85637 9.32457 7 9.32457C5.14363 9.32457 3.64109 8.40118 2.70703 7.62653C1.56406 6.67852 1.00816 5.73625 0.967422 5.5C1.00789 5.26375 1.56406 4.32149 2.70703 3.37348C3.64082 2.59883 5.14363 1.67543 7 1.67543C8.85609 1.67543 10.3589 2.59883 11.293 3.37348C12.4359 4.32149 12.9921 5.26375 13.0326 5.5C12.9918 5.73625 12.4359 6.67852 11.293 7.62653Z"
                              fill="#4F4632"></path>
                          </svg>
                        </a>
                      </div>

                    </div>

                  </div>
                  <div id="ProductInfo-template--17996521046172__collection_slider_b6Hqnw" class="product-content">
                    <div class="product-content-top">

                      <div class="product-type"></div>

                      <h3 class="product-title">
                        <a href="#premier-cute-550w-mixer-grinder-food-processor-km512">Premier Cute 550W Mixer
                          Grinder Food Processor KM512</a>
                      </h3>

                      <!-- Start of Judge.me code -->
                      <div class="jdgm-widget jdgm-preview-badge">
                        <div style="display:none" class="jdgm-prev-badge" data-average-rating="0.00"
                          data-number-of-reviews="0" data-number-of-questions="0"> <span class="jdgm-prev-badge__stars"
                            data-score="0.00" tabindex="0" aria-label="0.00 stars" role="button"> <span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span> </span> <span class="jdgm-prev-badge__text"> No
                            reviews </span> </div>
                      </div>
                      <!-- End of Judge.me code -->

                    </div>
                    <div id="ProductInfo-template--17996521046172__collection_slider_b6Hqnw-8496203071644"
                      class="product-content-bottom">
                      <div class="product-selectors">


                      </div>
                      <product-form class="product-form">
                        <div class="wbquicksuccess hidden" hidden="">Translation missing:
                          en.wbcustomlabel.wballtext.quicksuccessmsg</div>
                        <div class="product-form__error-message-wrapper" role="alert" hidden="">
                          <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-error"
                            viewBox="0 0 13 13" width="25" height="25">
                            <circle cx="6.5" cy="6.50049" r="5.5" stroke="white" stroke-width="2"></circle>
                            <circle cx="6.5" cy="6.5" r="5.5" fill="#EB001B" stroke="#EB001B" stroke-width="0.7">
                            </circle>
                            <path
                              d="M5.87413 3.52832L5.97439 7.57216H7.02713L7.12739 3.52832H5.87413ZM6.50076 9.66091C6.88091 9.66091 7.18169 9.37267 7.18169 9.00504C7.18169 8.63742 6.88091 8.34917 6.50076 8.34917C6.12061 8.34917 5.81982 8.63742 5.81982 9.00504C5.81982 9.37267 6.12061 9.66091 6.50076 9.66091Z"
                              fill="white"></path>
                            <path
                              d="M5.87413 3.17832H5.51535L5.52424 3.537L5.6245 7.58083L5.63296 7.92216H5.97439H7.02713H7.36856L7.37702 7.58083L7.47728 3.537L7.48617 3.17832H7.12739H5.87413ZM6.50076 10.0109C7.06121 10.0109 7.5317 9.57872 7.5317 9.00504C7.5317 8.43137 7.06121 7.99918 6.50076 7.99918C5.94031 7.99918 5.46982 8.43137 5.46982 9.00504C5.46982 9.57872 5.94031 10.0109 6.50076 10.0109Z"
                              fill="white" stroke="#EB001B" stroke-width="0.7">
                            </path>
                          </svg>
                          <span class="product-form__error-message"></span>
                        </div>
                        <form method="post" action="cart_add.php"
                          id="product-form-template--17996521046172__collection_slider_b6Hqnw-8496203071644"
                          accept-charset="UTF-8" class="form" enctype="multipart/form-data" novalidate="novalidate"
                          data-type="add-to-cart-form"><input type="hidden" name="form_type" value="product"><input
                            type="hidden" name="utf8" value="✓"><input type="hidden" name="id" value="45227638522012"
                            disabled="">
                          <div class="product-card__bottom">
                            <div class="no-js-hidden price"
                              id="price-template--17996521046172__collection_slider_b6Hqnw-8496203071644" role="status">

                              <ins class="price-item--regular"><span class="money"> Lei499.00</span></ins>






                            </div>
                            <button type="submit" name="add" class="btn btn--secondary product-form__submit"
                              aria-label="Add to Cart"><span>Add to Cart</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"
                                fill="none">
                                <path
                                  d="M3.22708 14.1828L2.22412 8.19984C2.07247 7.29523 1.99665 6.84293 2.23945 6.54647C2.48226 6.25 2.92852 6.25 3.82104 6.25H16.1783C17.0708 6.25 17.5171 6.25 17.7599 6.54647C18.0027 6.84293 17.9268 7.29523 17.7753 8.19984L16.7723 14.1828C16.4398 16.1659 16.2736 17.1574 15.5949 17.7454C14.9163 18.3333 13.938 18.3333 11.9815 18.3333H8.01786C6.06131 18.3333 5.08303 18.3333 4.40438 17.7454C3.72573 17.1574 3.55952 16.1659 3.22708 14.1828Z"
                                  stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                  d="M14.5837 6.25008C14.5837 3.71877 12.5317 1.66675 10.0003 1.66675C7.46902 1.66675 5.41699 3.71877 5.41699 6.25008"
                                  stroke="currentColor" stroke-width="1.5"></path>
                              </svg>

                              <div class="loading-overlay__spinner hidden">

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                  version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 511.494 511.494"
                                  style="enable-background:new 0 0 511.494 511.494;" xml:space="preserve" width="20"
                                  height="20">
                                  <g>
                                    <path
                                      d="M478.291,255.492c-16.133,0.143-29.689,12.161-31.765,28.16c-15.37,105.014-112.961,177.685-217.975,162.315 S50.866,333.006,66.236,227.992S179.197,50.307,284.211,65.677c35.796,5.239,69.386,20.476,96.907,43.959l-24.107,24.107   c-8.33,8.332-8.328,21.84,0.004,30.17c4.015,4.014,9.465,6.262,15.142,6.246h97.835c11.782,0,21.333-9.551,21.333-21.333V50.991   c-0.003-11.782-9.556-21.331-21.338-21.329c-5.655,0.001-11.079,2.248-15.078,6.246l-28.416,28.416   C320.774-29.34,159.141-19.568,65.476,86.152S-18.415,353.505,87.304,447.17s267.353,83.892,361.017-21.828   c32.972-37.216,54.381-83.237,61.607-132.431c2.828-17.612-9.157-34.183-26.769-37.011   C481.549,255.641,479.922,255.505,478.291,255.492z">
                                    </path>
                                  </g>
                                </svg>

                              </div>
                            </button>
                          </div><input type="hidden" name="product-id" value="8496203071644"><input type="hidden"
                            name="section-id" value="template--17996521046172__collection_slider_b6Hqnw">
                        </form>
                      </product-form>
                    </div>
                  </div>
                </div>

              </div>

              <div class="collection-slide swiper-slide">
                <div class="product-card-inner card-inner">
                  <div id="pro-template--17996521046172__collection_slider_b6Hqnw-8446920261788"
                    class="product-card-image card__media"><a
                      href="#premium-copper-gift-set-1-copper-water-bottle-2pcs-copper-glass"
                      title="Premium Copper Gift Set(1 Copper Water Bottle & 2pcs Copper Glass)"
                      class="product__media-item"
                      data-media-id="template--17996521046172__collection_slider_b6Hqnw-8446920261788-33639948976284"
                      tabindex="0">
                      <img loading="lazy" class=""
                        srcset="uploads/giftset_3333b4b5-7440-4a0a-9a12-23d0303db9f8_600x400_v=1749653414.webp"
                        alt="">
                    </a>
                    <div class="wish-lbl-wrp">

                      <div class="pro-wishlist">
                        <label>
                          <span class="wishlist-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                              fill="none">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.1335 2.95108C16.73 4.16664 16.9557 6.44579 15.6274 7.93897L8.99983 15.3894L2.37233 7.93977C1.04381 6.44646 1.26946 4.167 2.86616 2.95128C4.50032 1.70704 6.87275 2.10393 7.99225 3.80885L8.36782 4.38082C8.59267 4.72325 9.05847 4.82238 9.40821 4.60224C9.51777 4.53328 9.60294 4.44117 9.66134 4.33666L10.0076 3.80914C11.1268 2.10394 13.4993 1.70679 15.1335 2.95108ZM8.99998 2.653C7.31724 0.526225 4.15516 0.102335 1.94184 1.78754C-0.33726 3.52284 -0.659353 6.77651 1.23696 8.90805L8.4334 16.9972C8.7065 17.3041 9.18204 17.3362 9.49557 17.0688C9.53631 17.0341 9.57231 16.996 9.60351 16.9553L16.7628 8.90721C18.6589 6.77579 18.3367 3.52246 16.0579 1.78734C13.8446 0.102142 10.6825 0.526185 8.99998 2.653Z"
                                fill=" #4F4632"></path>
                            </svg>
                          </span>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="premium-copper-gift-set-1-copper-water-bottle-2pcs-copper-glass"><span
                            class="checkmark"></span>
                        </label>
                      </div>


                      <div class="pro-compare">
                        <label>
                          <span class="compare-label">
                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M9.80006 12.5C9.66163 12.5 9.52632 12.4585 9.41123 12.3809C9.29614 12.3033 9.20644 12.193 9.15347 12.0639C9.1005 11.9349 9.08664 11.7928 9.11364 11.6558C9.14064 11.5188 9.20728 11.393 9.30515 11.2942L11.6103 8.96804H2.79991C2.61426 8.96804 2.4362 8.89361 2.30493 8.76114C2.17365 8.62866 2.0999 8.44899 2.0999 8.26164C2.0999 8.0743 2.17365 7.89462 2.30493 7.76215C2.4362 7.62967 2.61426 7.55525 2.79991 7.55525H13.3001C13.4386 7.55528 13.5739 7.59672 13.689 7.67435C13.8041 7.75197 13.8938 7.86228 13.9467 7.99134C13.9997 8.1204 14.0136 8.2624 13.9866 8.39941C13.9596 8.53642 13.8929 8.66227 13.795 8.76106L10.295 12.293C10.1637 12.4255 9.9857 12.5 9.80006 12.5ZM11.9001 4.72968C11.9001 4.54233 11.8264 4.36266 11.6951 4.23018C11.5638 4.09771 11.3857 4.02328 11.2001 4.02328H2.3897L4.69485 1.69713C4.82236 1.56391 4.89292 1.38547 4.89133 1.20025C4.88973 1.01504 4.81611 0.837869 4.68632 0.706898C4.55654 0.575927 4.38096 0.501636 4.19742 0.500027C4.01388 0.498417 3.83705 0.569618 3.70503 0.698293L0.204955 4.23026C0.107087 4.32905 0.0404406 4.4549 0.0134427 4.59191C-0.0135551 4.72892 0.000307272 4.87092 0.0532774 4.99998C0.106248 5.12904 0.195947 5.23935 0.311036 5.31697C0.426126 5.3946 0.561438 5.43604 0.699866 5.43607H11.2001C11.3857 5.43607 11.5638 5.36165 11.6951 5.22917C11.8264 5.0967 11.9001 4.91703 11.9001 4.72968Z"
                                fill="#4F4632"></path>
                            </svg>
                          </span>
                          <a class="compare-now" href="/pages/compare" style="display:none;"> Compare Now </a>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="premium-copper-gift-set-1-copper-water-bottle-2pcs-copper-glass"><span
                            class="checkmark"></span>
                        </label>
                      </div>


                      <div class="quickview-btn" id="quickview">
                        <a style="text-decoration:none"
                          href="#premium-copper-gift-set-1-copper-water-bottle-2pcs-copper-glass"
                          data-handle="premium-copper-gift-set-1-copper-water-bottle-2pcs-copper-glass">
                          <svg width="14" height="11" viewBox="0 0 14 11" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M6.99996 3.15912C5.70988 3.15912 4.66016 4.20885 4.66016 5.49892C4.66016 6.789 5.70988 7.83873 6.99996 7.83873C8.29004 7.83873 9.33977 6.789 9.33977 5.49892C9.33977 4.20885 8.29004 3.15912 6.99996 3.15912ZM6.99996 6.8724C6.24254 6.8724 5.62648 6.25635 5.62648 5.49892C5.62648 4.7415 6.24254 4.12545 6.99996 4.12545C7.75738 4.12545 8.37344 4.7415 8.37344 5.49892C8.37344 6.25635 7.75738 6.8724 6.99996 6.8724Z"
                              fill="#4F4632"></path>
                            <path
                              d="M13.4184 4.21786C13.1537 3.8509 12.6889 3.28735 11.9785 2.68715C11.2954 2.10993 10.561 1.64782 9.79562 1.31368C8.87633 0.912544 7.9357 0.709106 7 0.709106C6.0643 0.709106 5.12367 0.912544 4.2041 1.31368C3.43875 1.64754 2.7043 2.10965 2.02125 2.68715C1.31086 3.28762 0.846016 3.8509 0.581328 4.21786C0.195781 4.7527 0 5.18418 0 5.5C0 5.81582 0.195508 6.24731 0.581602 6.78215C0.846289 7.14911 1.31113 7.71266 2.02152 8.31286C2.70457 8.89008 3.43902 9.35219 4.20437 9.68633C5.12367 10.0875 6.06457 10.2909 7.00027 10.2909C7.93598 10.2909 8.8766 10.0875 9.79617 9.68633C10.5615 9.35247 11.296 8.89036 11.979 8.31286C12.6894 7.71239 13.1543 7.14911 13.4189 6.78215C13.8045 6.24731 14 5.81582 14 5.5C14 5.18418 13.8045 4.7527 13.4184 4.21786ZM11.293 7.62653C10.3592 8.40118 8.85637 9.32457 7 9.32457C5.14363 9.32457 3.64109 8.40118 2.70703 7.62653C1.56406 6.67852 1.00816 5.73625 0.967422 5.5C1.00789 5.26375 1.56406 4.32149 2.70703 3.37348C3.64082 2.59883 5.14363 1.67543 7 1.67543C8.85609 1.67543 10.3589 2.59883 11.293 3.37348C12.4359 4.32149 12.9921 5.26375 13.0326 5.5C12.9918 5.73625 12.4359 6.67852 11.293 7.62653Z"
                              fill="#4F4632"></path>
                          </svg>
                        </a>
                      </div>

                    </div>

                  </div>
                  <div id="ProductInfo-template--17996521046172__collection_slider_b6Hqnw" class="product-content">
                    <div class="product-content-top">

                      <div class="product-type"></div>

                      <h3 class="product-title">
                        <a href="#premium-copper-gift-set-1-copper-water-bottle-2pcs-copper-glass">Premium
                          Copper Gift Set(1 Copper Water Bottle & 2pcs Copper Glass)</a>
                      </h3>

                      <!-- Start of Judge.me code -->
                      <div class="jdgm-widget jdgm-preview-badge">
                        <div style="display:none" class="jdgm-prev-badge" data-average-rating="0.00"
                          data-number-of-reviews="0" data-number-of-questions="0"> <span class="jdgm-prev-badge__stars"
                            data-score="0.00" tabindex="0" aria-label="0.00 stars" role="button"> <span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span> </span> <span class="jdgm-prev-badge__text"> No
                            reviews </span> </div>
                      </div>
                      <!-- End of Judge.me code -->

                    </div>
                    <div id="ProductInfo-template--17996521046172__collection_slider_b6Hqnw-8446920261788"
                      class="product-content-bottom">
                      <div class="product-selectors">


                      </div>
                      <product-form class="product-form">
                        <div class="wbquicksuccess hidden" hidden="">Translation missing:
                          en.wbcustomlabel.wballtext.quicksuccessmsg</div>
                        <div class="product-form__error-message-wrapper" role="alert" hidden="">
                          <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-error"
                            viewBox="0 0 13 13" width="25" height="25">
                            <circle cx="6.5" cy="6.50049" r="5.5" stroke="white" stroke-width="2"></circle>
                            <circle cx="6.5" cy="6.5" r="5.5" fill="#EB001B" stroke="#EB001B" stroke-width="0.7">
                            </circle>
                            <path
                              d="M5.87413 3.52832L5.97439 7.57216H7.02713L7.12739 3.52832H5.87413ZM6.50076 9.66091C6.88091 9.66091 7.18169 9.37267 7.18169 9.00504C7.18169 8.63742 6.88091 8.34917 6.50076 8.34917C6.12061 8.34917 5.81982 8.63742 5.81982 9.00504C5.81982 9.37267 6.12061 9.66091 6.50076 9.66091Z"
                              fill="white"></path>
                            <path
                              d="M5.87413 3.17832H5.51535L5.52424 3.537L5.6245 7.58083L5.63296 7.92216H5.97439H7.02713H7.36856L7.37702 7.58083L7.47728 3.537L7.48617 3.17832H7.12739H5.87413ZM6.50076 10.0109C7.06121 10.0109 7.5317 9.57872 7.5317 9.00504C7.5317 8.43137 7.06121 7.99918 6.50076 7.99918C5.94031 7.99918 5.46982 8.43137 5.46982 9.00504C5.46982 9.57872 5.94031 10.0109 6.50076 10.0109Z"
                              fill="white" stroke="#EB001B" stroke-width="0.7">
                            </path>
                          </svg>
                          <span class="product-form__error-message"></span>
                        </div>
                        <form method="post" action="cart_add.php"
                          id="product-form-template--17996521046172__collection_slider_b6Hqnw-8446920261788"
                          accept-charset="UTF-8" class="form" enctype="multipart/form-data" novalidate="novalidate"
                          data-type="add-to-cart-form"><input type="hidden" name="form_type" value="product"><input
                            type="hidden" name="utf8" value="✓"><input type="hidden" name="id" value="45040273391772"
                            disabled="">
                          <div class="product-card__bottom">
                            <div class="no-js-hidden price"
                              id="price-template--17996521046172__collection_slider_b6Hqnw-8446920261788" role="status">

                              <ins class="price-item--regular"><span class="money"> Lei150.00</span></ins>






                            </div>
                            <button type="submit" name="add" class="btn btn--secondary product-form__submit"
                              aria-label="Add to Cart"><span>Add to Cart</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"
                                fill="none">
                                <path
                                  d="M3.22708 14.1828L2.22412 8.19984C2.07247 7.29523 1.99665 6.84293 2.23945 6.54647C2.48226 6.25 2.92852 6.25 3.82104 6.25H16.1783C17.0708 6.25 17.5171 6.25 17.7599 6.54647C18.0027 6.84293 17.9268 7.29523 17.7753 8.19984L16.7723 14.1828C16.4398 16.1659 16.2736 17.1574 15.5949 17.7454C14.9163 18.3333 13.938 18.3333 11.9815 18.3333H8.01786C6.06131 18.3333 5.08303 18.3333 4.40438 17.7454C3.72573 17.1574 3.55952 16.1659 3.22708 14.1828Z"
                                  stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                  d="M14.5837 6.25008C14.5837 3.71877 12.5317 1.66675 10.0003 1.66675C7.46902 1.66675 5.41699 3.71877 5.41699 6.25008"
                                  stroke="currentColor" stroke-width="1.5"></path>
                              </svg>

                              <div class="loading-overlay__spinner hidden">

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                  version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 511.494 511.494"
                                  style="enable-background:new 0 0 511.494 511.494;" xml:space="preserve" width="20"
                                  height="20">
                                  <g>
                                    <path
                                      d="M478.291,255.492c-16.133,0.143-29.689,12.161-31.765,28.16c-15.37,105.014-112.961,177.685-217.975,162.315 S50.866,333.006,66.236,227.992S179.197,50.307,284.211,65.677c35.796,5.239,69.386,20.476,96.907,43.959l-24.107,24.107   c-8.33,8.332-8.328,21.84,0.004,30.17c4.015,4.014,9.465,6.262,15.142,6.246h97.835c11.782,0,21.333-9.551,21.333-21.333V50.991   c-0.003-11.782-9.556-21.331-21.338-21.329c-5.655,0.001-11.079,2.248-15.078,6.246l-28.416,28.416   C320.774-29.34,159.141-19.568,65.476,86.152S-18.415,353.505,87.304,447.17s267.353,83.892,361.017-21.828   c32.972-37.216,54.381-83.237,61.607-132.431c2.828-17.612-9.157-34.183-26.769-37.011   C481.549,255.641,479.922,255.505,478.291,255.492z">
                                    </path>
                                  </g>
                                </svg>

                              </div>
                            </button>
                          </div><input type="hidden" name="product-id" value="8446920261788"><input type="hidden"
                            name="section-id" value="template--17996521046172__collection_slider_b6Hqnw">
                        </form>
                      </product-form>
                    </div>
                  </div>
                </div>

              </div>

              <div class="collection-slide swiper-slide">
                <div class="product-card-inner card-inner">
                  <div id="pro-template--17996521046172__collection_slider_b6Hqnw-8446920032412"
                    class="product-card-image card__media"><a href="#prestige-pressure-cooker-3l"
                      title="Prestige Pressure Cooker (Szybkowar) 3L" class="product__media-item"
                      data-media-id="template--17996521046172__collection_slider_b6Hqnw-8446920032412-33639947894940"
                      tabindex="0">
                      <img loading="lazy" class=""
                        srcset="uploads/prestige-pressure-cooker-500x500_b34842fe-a925-4a52-928b-569329997495_600x400_v=1749653398.webp"
                        alt="">
                    </a>
                    <div class="wish-lbl-wrp">

                      <div class="pro-wishlist">
                        <label>
                          <span class="wishlist-label">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                              fill="none">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M15.1335 2.95108C16.73 4.16664 16.9557 6.44579 15.6274 7.93897L8.99983 15.3894L2.37233 7.93977C1.04381 6.44646 1.26946 4.167 2.86616 2.95128C4.50032 1.70704 6.87275 2.10393 7.99225 3.80885L8.36782 4.38082C8.59267 4.72325 9.05847 4.82238 9.40821 4.60224C9.51777 4.53328 9.60294 4.44117 9.66134 4.33666L10.0076 3.80914C11.1268 2.10394 13.4993 1.70679 15.1335 2.95108ZM8.99998 2.653C7.31724 0.526225 4.15516 0.102335 1.94184 1.78754C-0.33726 3.52284 -0.659353 6.77651 1.23696 8.90805L8.4334 16.9972C8.7065 17.3041 9.18204 17.3362 9.49557 17.0688C9.53631 17.0341 9.57231 16.996 9.60351 16.9553L16.7628 8.90721C18.6589 6.77579 18.3367 3.52246 16.0579 1.78734C13.8446 0.102142 10.6825 0.526185 8.99998 2.653Z"
                                fill=" #4F4632"></path>
                            </svg>
                          </span>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="prestige-pressure-cooker-3l"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="pro-compare">
                        <label>
                          <span class="compare-label">
                            <svg width="14" height="13" viewBox="0 0 14 13" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path
                                d="M9.80006 12.5C9.66163 12.5 9.52632 12.4585 9.41123 12.3809C9.29614 12.3033 9.20644 12.193 9.15347 12.0639C9.1005 11.9349 9.08664 11.7928 9.11364 11.6558C9.14064 11.5188 9.20728 11.393 9.30515 11.2942L11.6103 8.96804H2.79991C2.61426 8.96804 2.4362 8.89361 2.30493 8.76114C2.17365 8.62866 2.0999 8.44899 2.0999 8.26164C2.0999 8.0743 2.17365 7.89462 2.30493 7.76215C2.4362 7.62967 2.61426 7.55525 2.79991 7.55525H13.3001C13.4386 7.55528 13.5739 7.59672 13.689 7.67435C13.8041 7.75197 13.8938 7.86228 13.9467 7.99134C13.9997 8.1204 14.0136 8.2624 13.9866 8.39941C13.9596 8.53642 13.8929 8.66227 13.795 8.76106L10.295 12.293C10.1637 12.4255 9.9857 12.5 9.80006 12.5ZM11.9001 4.72968C11.9001 4.54233 11.8264 4.36266 11.6951 4.23018C11.5638 4.09771 11.3857 4.02328 11.2001 4.02328H2.3897L4.69485 1.69713C4.82236 1.56391 4.89292 1.38547 4.89133 1.20025C4.88973 1.01504 4.81611 0.837869 4.68632 0.706898C4.55654 0.575927 4.38096 0.501636 4.19742 0.500027C4.01388 0.498417 3.83705 0.569618 3.70503 0.698293L0.204955 4.23026C0.107087 4.32905 0.0404406 4.4549 0.0134427 4.59191C-0.0135551 4.72892 0.000307272 4.87092 0.0532774 4.99998C0.106248 5.12904 0.195947 5.23935 0.311036 5.31697C0.426126 5.3946 0.561438 5.43604 0.699866 5.43607H11.2001C11.3857 5.43607 11.5638 5.36165 11.6951 5.22917C11.8264 5.0967 11.9001 4.91703 11.9001 4.72968Z"
                                fill="#4F4632"></path>
                            </svg>
                          </span>
                          <a class="compare-now" href="/pages/compare" style="display:none;"> Compare Now </a>
                          <input type="checkbox" id="true" data-value="true" style="display:none;"
                            pro-handle="prestige-pressure-cooker-3l"><span class="checkmark"></span>
                        </label>
                      </div>


                      <div class="quickview-btn" id="quickview">
                        <a style="text-decoration:none" href="#prestige-pressure-cooker-3l"
                          data-handle="prestige-pressure-cooker-3l">
                          <svg width="14" height="11" viewBox="0 0 14 11" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                              d="M6.99996 3.15912C5.70988 3.15912 4.66016 4.20885 4.66016 5.49892C4.66016 6.789 5.70988 7.83873 6.99996 7.83873C8.29004 7.83873 9.33977 6.789 9.33977 5.49892C9.33977 4.20885 8.29004 3.15912 6.99996 3.15912ZM6.99996 6.8724C6.24254 6.8724 5.62648 6.25635 5.62648 5.49892C5.62648 4.7415 6.24254 4.12545 6.99996 4.12545C7.75738 4.12545 8.37344 4.7415 8.37344 5.49892C8.37344 6.25635 7.75738 6.8724 6.99996 6.8724Z"
                              fill="#4F4632"></path>
                            <path
                              d="M13.4184 4.21786C13.1537 3.8509 12.6889 3.28735 11.9785 2.68715C11.2954 2.10993 10.561 1.64782 9.79562 1.31368C8.87633 0.912544 7.9357 0.709106 7 0.709106C6.0643 0.709106 5.12367 0.912544 4.2041 1.31368C3.43875 1.64754 2.7043 2.10965 2.02125 2.68715C1.31086 3.28762 0.846016 3.8509 0.581328 4.21786C0.195781 4.7527 0 5.18418 0 5.5C0 5.81582 0.195508 6.24731 0.581602 6.78215C0.846289 7.14911 1.31113 7.71266 2.02152 8.31286C2.70457 8.89008 3.43902 9.35219 4.20437 9.68633C5.12367 10.0875 6.06457 10.2909 7.00027 10.2909C7.93598 10.2909 8.8766 10.0875 9.79617 9.68633C10.5615 9.35247 11.296 8.89036 11.979 8.31286C12.6894 7.71239 13.1543 7.14911 13.4189 6.78215C13.8045 6.24731 14 5.81582 14 5.5C14 5.18418 13.8045 4.7527 13.4184 4.21786ZM11.293 7.62653C10.3592 8.40118 8.85637 9.32457 7 9.32457C5.14363 9.32457 3.64109 8.40118 2.70703 7.62653C1.56406 6.67852 1.00816 5.73625 0.967422 5.5C1.00789 5.26375 1.56406 4.32149 2.70703 3.37348C3.64082 2.59883 5.14363 1.67543 7 1.67543C8.85609 1.67543 10.3589 2.59883 11.293 3.37348C12.4359 4.32149 12.9921 5.26375 13.0326 5.5C12.9918 5.73625 12.4359 6.67852 11.293 7.62653Z"
                              fill="#4F4632"></path>
                          </svg>
                        </a>
                      </div>

                    </div>

                  </div>
                  <div id="ProductInfo-template--17996521046172__collection_slider_b6Hqnw" class="product-content">
                    <div class="product-content-top">

                      <div class="product-type"></div>

                      <h3 class="product-title">
                        <a href="#prestige-pressure-cooker-3l">Prestige Pressure Cooker (Szybkowar) 3L</a>
                      </h3>

                      <!-- Start of Judge.me code -->
                      <div class="jdgm-widget jdgm-preview-badge">
                        <div style="display:none" class="jdgm-prev-badge" data-average-rating="0.00"
                          data-number-of-reviews="0" data-number-of-questions="0"> <span class="jdgm-prev-badge__stars"
                            data-score="0.00" tabindex="0" aria-label="0.00 stars" role="button"> <span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span><span class="jdgm-star jdgm--off"></span><span
                              class="jdgm-star jdgm--off"></span> </span> <span class="jdgm-prev-badge__text"> No
                            reviews </span> </div>
                      </div>
                      <!-- End of Judge.me code -->

                    </div>
                    <div id="ProductInfo-template--17996521046172__collection_slider_b6Hqnw-8446920032412"
                      class="product-content-bottom">
                      <div class="product-selectors">


                      </div>
                      <product-form class="product-form">
                        <div class="wbquicksuccess hidden" hidden="">Translation missing:
                          en.wbcustomlabel.wballtext.quicksuccessmsg</div>
                        <div class="product-form__error-message-wrapper" role="alert" hidden="">
                          <svg aria-hidden="true" focusable="false" role="presentation" class="icon icon-error"
                            viewBox="0 0 13 13" width="25" height="25">
                            <circle cx="6.5" cy="6.50049" r="5.5" stroke="white" stroke-width="2"></circle>
                            <circle cx="6.5" cy="6.5" r="5.5" fill="#EB001B" stroke="#EB001B" stroke-width="0.7">
                            </circle>
                            <path
                              d="M5.87413 3.52832L5.97439 7.57216H7.02713L7.12739 3.52832H5.87413ZM6.50076 9.66091C6.88091 9.66091 7.18169 9.37267 7.18169 9.00504C7.18169 8.63742 6.88091 8.34917 6.50076 8.34917C6.12061 8.34917 5.81982 8.63742 5.81982 9.00504C5.81982 9.37267 6.12061 9.66091 6.50076 9.66091Z"
                              fill="white"></path>
                            <path
                              d="M5.87413 3.17832H5.51535L5.52424 3.537L5.6245 7.58083L5.63296 7.92216H5.97439H7.02713H7.36856L7.37702 7.58083L7.47728 3.537L7.48617 3.17832H7.12739H5.87413ZM6.50076 10.0109C7.06121 10.0109 7.5317 9.57872 7.5317 9.00504C7.5317 8.43137 7.06121 7.99918 6.50076 7.99918C5.94031 7.99918 5.46982 8.43137 5.46982 9.00504C5.46982 9.57872 5.94031 10.0109 6.50076 10.0109Z"
                              fill="white" stroke="#EB001B" stroke-width="0.7">
                            </path>
                          </svg>
                          <span class="product-form__error-message"></span>
                        </div>
                        <form method="post" action="cart_add.php"
                          id="product-form-template--17996521046172__collection_slider_b6Hqnw-8446920032412"
                          accept-charset="UTF-8" class="form" enctype="multipart/form-data" novalidate="novalidate"
                          data-type="add-to-cart-form"><input type="hidden" name="form_type" value="product"><input
                            type="hidden" name="utf8" value="✓"><input type="hidden" name="id" value="45040273129628"
                            disabled="">
                          <div class="product-card__bottom">
                            <div class="no-js-hidden price"
                              id="price-template--17996521046172__collection_slider_b6Hqnw-8446920032412" role="status">

                              <ins class="price-item--regular"><span class="money"> Lei190.00</span></ins>






                            </div>
                            <button type="submit" name="add" class="btn btn--secondary product-form__submit"
                              aria-label="Add to Cart"><span>Add to Cart</span>
                              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 20 20"
                                fill="none">
                                <path
                                  d="M3.22708 14.1828L2.22412 8.19984C2.07247 7.29523 1.99665 6.84293 2.23945 6.54647C2.48226 6.25 2.92852 6.25 3.82104 6.25H16.1783C17.0708 6.25 17.5171 6.25 17.7599 6.54647C18.0027 6.84293 17.9268 7.29523 17.7753 8.19984L16.7723 14.1828C16.4398 16.1659 16.2736 17.1574 15.5949 17.7454C14.9163 18.3333 13.938 18.3333 11.9815 18.3333H8.01786C6.06131 18.3333 5.08303 18.3333 4.40438 17.7454C3.72573 17.1574 3.55952 16.1659 3.22708 14.1828Z"
                                  stroke="currentColor" stroke-width="1.5"></path>
                                <path
                                  d="M14.5837 6.25008C14.5837 3.71877 12.5317 1.66675 10.0003 1.66675C7.46902 1.66675 5.41699 3.71877 5.41699 6.25008"
                                  stroke="currentColor" stroke-width="1.5"></path>
                              </svg>

                              <div class="loading-overlay__spinner hidden">

                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                  version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 511.494 511.494"
                                  style="enable-background:new 0 0 511.494 511.494;" xml:space="preserve" width="20"
                                  height="20">
                                  <g>
                                    <path
                                      d="M478.291,255.492c-16.133,0.143-29.689,12.161-31.765,28.16c-15.37,105.014-112.961,177.685-217.975,162.315 S50.866,333.006,66.236,227.992S179.197,50.307,284.211,65.677c35.796,5.239,69.386,20.476,96.907,43.959l-24.107,24.107   c-8.33,8.332-8.328,21.84,0.004,30.17c4.015,4.014,9.465,6.262,15.142,6.246h97.835c11.782,0,21.333-9.551,21.333-21.333V50.991   c-0.003-11.782-9.556-21.331-21.338-21.329c-5.655,0.001-11.079,2.248-15.078,6.246l-28.416,28.416   C320.774-29.34,159.141-19.568,65.476,86.152S-18.415,353.505,87.304,447.17s267.353,83.892,361.017-21.828   c32.972-37.216,54.381-83.237,61.607-132.431c2.828-17.612-9.157-34.183-26.769-37.011   C481.549,255.641,479.922,255.505,478.291,255.492z">
                                    </path>
                                  </g>
                                </svg>

                              </div>
                            </button>
                          </div><input type="hidden" name="product-id" value="8446920032412"><input type="hidden"
                            name="section-id" value="template--17996521046172__collection_slider_b6Hqnw">
                        </form>
                      </product-form>
                    </div>
                  </div>
                </div>

              </div>

            </div>
          </div>
        </div>
      </div>

      <script>
        document.addEventListener('DOMContentLoaded', function () {
          const swiper = new Swiper('.collection-slider__swiper', {
            speed: 400,
            spaceBetween: 18,
            slidesPerView: 'auto',
            slidesPerGroup: 1,
            slideShadows: true,
            breakpoints: {
              1200: {
                slidesPerView: 4,
                spaceBetween: 40,
              },
              767: {
                slidesPerView: 3,
              },
            },
          });
        });
      </script>


    </div>
    <section id="shopify-section-template--17996521046172__category_feature_NLdTmd"
      class="shopify-section shop-categories padding-top">
      <div class="container">
        <div class="section-title d-flex align-items-center justify-content-between">
          <h2 class="title">Essentials</h2>
        </div>
        <div class="row row-gap">
          <div class="col-lg-3 col-xl-3 col-md-6 col-sm-6 col-12">
            <div class="category-card">
              <div class="category-img">
                <img src="uploads/Rice_AdobeStock_64819529_E_v=1750153126.jpg"
                  alt="bakers">
              </div>
              <div class="category-card-body">
                <div class="title-wrapper">
                  <h4 class="title">Indian Rice</h4>
                </div>
                <p>Basmati, Matta and more..</p>
                <div class="btn-wrapper">
                  <a href="shop.php?category=rice" class="btn">
                    Shop Now
                    <svg xmlns="http://www.w3.org/2000/svg" width="4" height="6" viewBox="0 0 4 6" fill="none">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M0.65976 0.662719C0.446746 0.879677 0.446746 1.23143 0.65976 1.44839L2.18316 3L0.65976 4.55161C0.446747 4.76856 0.446747 5.12032 0.65976 5.33728C0.872773 5.55424 1.21814 5.55424 1.43115 5.33728L3.34024 3.39284C3.55325 3.17588 3.55325 2.82412 3.34024 2.60716L1.43115 0.662719C1.21814 0.445761 0.872773 0.445761 0.65976 0.662719Z"
                        fill="white"></path>
                    </svg>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-xl-3 col-md-6 col-sm-6 col-12">
            <div class="category-card">
              <div class="category-img">
                <img
                  src="uploads/is-it-possible-for-an-indian-pickle-to-go-bad_v=1750153448.jpg"
                  alt="bakers">
              </div>
              <div class="category-card-body">
                <div class="title-wrapper">
                  <h4 class="title">Pickles</h4>
                </div>
                <p>Known as Achaar / Oorukai</p>
                <div class="btn-wrapper">
                  <a href="shop.php?category=Maharaja Supermarket-shop-sauces-and-pickles" class="btn">
                    See More
                    <svg xmlns="http://www.w3.org/2000/svg" width="4" height="6" viewBox="0 0 4 6" fill="none">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M0.65976 0.662719C0.446746 0.879677 0.446746 1.23143 0.65976 1.44839L2.18316 3L0.65976 4.55161C0.446747 4.76856 0.446747 5.12032 0.65976 5.33728C0.872773 5.55424 1.21814 5.55424 1.43115 5.33728L3.34024 3.39284C3.55325 3.17588 3.55325 2.82412 3.34024 2.60716L1.43115 0.662719C1.21814 0.445761 0.872773 0.445761 0.65976 0.662719Z"
                        fill="white"></path>
                    </svg>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-xl-3 col-md-6 col-sm-6 col-12">
            <div class="category-card">
              <div class="category-img">
                <img src="uploads/pulses-and-lentils_v=1750153680.jpg"
                  alt="bakers">
              </div>
              <div class="category-card-body">
                <div class="title-wrapper">
                  <h4 class="title">Dal Varieties</h4>
                </div>
                <p>Lentils, Pulses and more...</p>
                <div class="btn-wrapper">
                  <a href="shop.php?category=Maharaja Supermarket-shop-groceries-beans-and-lentils" class="btn">
                    Shop Now
                    <svg xmlns="http://www.w3.org/2000/svg" width="4" height="6" viewBox="0 0 4 6" fill="none">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M0.65976 0.662719C0.446746 0.879677 0.446746 1.23143 0.65976 1.44839L2.18316 3L0.65976 4.55161C0.446747 4.76856 0.446747 5.12032 0.65976 5.33728C0.872773 5.55424 1.21814 5.55424 1.43115 5.33728L3.34024 3.39284C3.55325 3.17588 3.55325 2.82412 3.34024 2.60716L1.43115 0.662719C1.21814 0.445761 0.872773 0.445761 0.65976 0.662719Z"
                        fill="white"></path>
                    </svg>
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-xl-3 col-md-6 col-sm-6 col-12">
            <div class="category-card">
              <div class="category-img">
                <img src="uploads/Indian-Breakfast_v=1750153834.jpg"
                  alt="bakers">
              </div>
              <div class="category-card-body">
                <div class="title-wrapper">
                  <h4 class="title">South Indian Breakfast Mixes</h4>
                </div>
                <p>Make the best dosas and idlies!</p>
                <div class="btn-wrapper">
                  <a href="shop.php?category=south-indian-breakfast-mixes" class="btn">
                    Shop Now
                    <svg xmlns="http://www.w3.org/2000/svg" width="4" height="6" viewBox="0 0 4 6" fill="none">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M0.65976 0.662719C0.446746 0.879677 0.446746 1.23143 0.65976 1.44839L2.18316 3L0.65976 4.55161C0.446747 4.76856 0.446747 5.12032 0.65976 5.33728C0.872773 5.55424 1.21814 5.55424 1.43115 5.33728L3.34024 3.39284C3.55325 3.17588 3.55325 2.82412 3.34024 2.60716L1.43115 0.662719C1.21814 0.445761 0.872773 0.445761 0.65976 0.662719Z"
                        fill="white"></path>
                    </svg>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="section-left-shape">
        <img src="/cdn/shopifycloud/storefront/assets/no-image-2048-a2addb12.gif" alt="">
      </div>

    </section>
    <div id="shopify-section-template--17996521046172__brand_slider_G4iNGp" class="shopify-section padding-bottom">
      <div class="brand-slider__wrap">
        <div class="brand-slider__fluid-container">
          <h3 class="brand-slider__title">
            Top Brands
          </h3>
          <div class="brand-slider">


            <a class="brand-slide" href="shop.php?category=patanjali">
              <div class="brand-slide__img"
                style="background-image:url(uploads/patanjali_logo_v=1764149448.webp);">
              </div>
            </a>



            <a class="brand-slide"
              href="shop.php?category=Double+Horse">
              <div class="brand-slide__img"
                style="background-image:url(uploads/dh_v=1726696252.png);">
              </div>
            </a>



            <a class="brand-slide"
              href="shop.php?category=Sweekar">
              <div class="brand-slide__img"
                style="background-image:url(uploads/sw_v=1726696251.png);">
              </div>
            </a>



            <a class="brand-slide"
              href="shop.php?category=Kitchen+Treasures">
              <div class="brand-slide__img"
                style="background-image:url(uploads/image-30-66549173e903a_v=1716822069.webp);">
              </div>
            </a>



            <a class="brand-slide"
              href="shop.php?category=JFK">
              <div class="brand-slide__img"
                style="background-image:url(uploads/image-29-66549174ac9f8_v=1716822069.webp);">
              </div>
            </a>



            <a class="brand-slide"
              href="shop.php?category=Bikano">
              <div class="brand-slide__img"
                style="background-image:url(uploads/image-33-665491734088e_v=1716822069.webp);">
              </div>
            </a>



            <a class="brand-slide"
              href="shop.php?category=Maaza">
              <div class="brand-slide__img"
                style="background-image:url(uploads/image-35-665491757af66_v=1716822069.webp);">
              </div>
            </a>



            <a class="brand-slide"
              href="shop.php?category=Melam">
              <div class="brand-slide__img"
                style="background-image:url(uploads/image-28-66549174bb6f9_v=1716822069.webp);">
              </div>
            </a>


          </div>
        </div>
      </div>


    </div>
    <div id="shopify-section-template--17996521046172__slider_testimonials_qB68pE"
      class="shopify-section testimonial-slider__parent padding-bottom">
      <style>
        .slider-testimonial__title {
          text-align: center;
        }

        .testimonial-slider__parent.padding-bottom {
          padding-bottom: 36px;
        }

        .testimonial-slide {
          background-color: var(--white);
          box-shadow: 12px 16px 44px 0 #0000000A;
          border-radius: 12px;
          display: flex;
          text-align: center;
          padding: 32px;
          position: relative;
          transform: scale(0.9);
          transition: all 0.3s ease;
          opacity: 0.8;
        }

        .testimonial-slide.slick-cloned {
          transition: all 0.3s ease;
        }

        .testimonial-slide.slick-current.slick-active.slick-center {
          transform: scale(1);
          opacity: 1;
        }

        .slider-testimonial__slider .slick-track {
          padding-block: 56px;
        }

        .slider-testimonial__slider .slick-slide {
          margin-left: 12px;
        }

        .slider-testimonial__slider .slick-list {
          margin-left: -12px;
        }

        .testimonial-slide__img {
          max-width: 80px;
          margin-inline: auto;
          padding-bottom: 12px;
        }

        .testimonial-slide__img img {
          aspect-ratio: 1 / 1;
        }

        .testimonial-slide__feedback {
          max-width: 430px;
          margin-inline: auto;
          font-size: 16px;
          line-height: 1.625;
        }

        .testimonial-slide__name {
          padding-bottom: 18px;
          font-weight: 700;
          font-size: 18px;
          line-height: 1.444;
        }

        @media screen and (max-width:600px) {
          .testimonial-slide {
            padding: 18px;
          }

          .testimonial-slide__img {
            max-width: 50px;
            padding-bottom: 4px;
          }

          .testimonial-slide__name {
            padding-bottom: 4px;
            font-size: 16px;
          }

          .testimonial-slide__feedback {
            font-size: 14px;
          }

          .slider-testimonial__slider .slick-track {
            padding-block: 36px;
          }

          .testimonial-slide {
            box-shadow: none;
          }
        }
      </style>

      <div class="slider-testimonial__wrap">
        <div class="slider-testimonial__fluid-container">
          <h3 class="slider-testimonial__title">
            Customer Reviews
          </h3>
          <div class="slider-testimonial__slider">


            <div class="testimonial-slide">
              <div class="testimonial-slide__img">
                <img src="uploads/user-profile_v=1725257626.png" loading="lazy"
                  alt="">
              </div>
              <div class="testimonial-slide__name">
                Arun Prabhakar
              </div>
              <div class="testimonial-slide__feedback">
                bardzo dobra jakość produktów, ceny konkurencyjne, szybka dostawa, gorąco polecam
              </div>
            </div>



            <div class="testimonial-slide">
              <div class="testimonial-slide__img">
                <img src="uploads/user-profile_v=1725257626.png" loading="lazy"
                  alt="">
              </div>
              <div class="testimonial-slide__name">
                Monika Golinska
              </div>
              <div class="testimonial-slide__feedback">
                I recommend. Fast and successful transaction. 10/10
              </div>
            </div>



            <div class="testimonial-slide">
              <div class="testimonial-slide__img">
                <img src="uploads/user-profile_v=1725257626.png" loading="lazy"
                  alt="">
              </div>
              <div class="testimonial-slide__name">
                Vito Cazzorla
              </div>
              <div class="testimonial-slide__feedback">
                I am very satisfied with the service received by Maharaja Supermarket. I will continue shopping with
                them.
              </div>
            </div>



            <div class="testimonial-slide">
              <div class="testimonial-slide__img">
                <img src="uploads/user-profile_v=1725257626.png" loading="lazy"
                  alt="">
              </div>
              <div class="testimonial-slide__name">
                Rakesh Yadav
              </div>
              <div class="testimonial-slide__feedback">
                Good range of products at affordable prices. They think along with customer. Thumbs up for customer
                service!
              </div>
            </div>



            <div class="testimonial-slide">
              <div class="testimonial-slide__img">
                <img src="uploads/user-profile_v=1725257626.png" loading="lazy"
                  alt="">
              </div>
              <div class="testimonial-slide__name">
                Puneet Shrivastava
              </div>
              <div class="testimonial-slide__feedback">
                Amazing collection of Indian Food- for very reasonable prices. Leading wholesalers of Indian Groceries
                in Romania.
              </div>
            </div>



            <div class="testimonial-slide">
              <div class="testimonial-slide__img">
                <img src="uploads/user-profile_v=1725257626.png" loading="lazy"
                  alt="">
              </div>
              <div class="testimonial-slide__name">
                Prodip Bhowal
              </div>
              <div class="testimonial-slide__feedback">
                Very prompt delivery and good quality materials

                I am very satisfied.
              </div>
            </div>



            <div class="testimonial-slide">
              <div class="testimonial-slide__img">
                <img src="uploads/user-profile_v=1725257626.png" loading="lazy"
                  alt="">
              </div>
              <div class="testimonial-slide__name">
                Ewa Marciniak
              </div>
              <div class="testimonial-slide__feedback">
                Super! Dobre produkty, dobra obsługa.
              </div>
            </div>



            <div class="testimonial-slide">
              <div class="testimonial-slide__img">
                <img src="uploads/user-profile_v=1725257626.png" loading="lazy"
                  alt="">
              </div>
              <div class="testimonial-slide__name">
                Kartik Patel
              </div>
              <div class="testimonial-slide__feedback">
                Good
              </div>
            </div>



            <div class="testimonial-slide">
              <div class="testimonial-slide__img">
                <img src="uploads/user-profile_v=1725257626.png" loading="lazy"
                  alt="">
              </div>
              <div class="testimonial-slide__name">
                Mohit Minhas
              </div>
              <div class="testimonial-slide__feedback">
                (For Patanjali Amla Pickle 500g) Must try. Its really really good. Must recommended. I will buy it again
                for sure.
              </div>
            </div>



            <div class="testimonial-slide">
              <div class="testimonial-slide__img">
                <img src="uploads/user-profile_v=1725257626.png" loading="lazy"
                  alt="">
              </div>
              <div class="testimonial-slide__name">
                Kamila Filo
              </div>
              <div class="testimonial-slide__feedback">
                Bardzo dobra kawa. Unikalny smak. Polecam wszystkim.
              </div>
            </div>



            <div class="testimonial-slide">
              <div class="testimonial-slide__img">
                <img src="uploads/user-profile_v=1725257626.png" loading="lazy"
                  alt="">
              </div>
              <div class="testimonial-slide__name">
                Sija
              </div>
              <div class="testimonial-slide__feedback">
                Excellent ghee
                Excellent ghee butter!

                [For Amul Cow Ghee 1L]
              </div>
            </div>



            <div class="testimonial-slide">
              <div class="testimonial-slide__img">
                <img src="uploads/user-profile_v=1725257626.png" loading="lazy"
                  alt="">
              </div>
              <div class="testimonial-slide__name">
                Mohini
              </div>
              <div class="testimonial-slide__feedback">
                Good
                Must recommended

                [For Wagh Bakri Premium Leaf Tea 1Kg]
              </div>
            </div>


          </div>
        </div>
      </div>

    </div>
    <div id="shopify-section-template--17996521046172__subscription_banner_gGqWGN"
      class="shopify-section padding-bottom subscription-banner__parent">
      <div class="subscription-banner__wrap">
        <div class="subscription-banner__container">
          <div class="subscription-banner__content">
            <div class="subscription-banner__text">
              <div class="subscription-banner__text-title">
                Stay home & get your daily needs from our shop
              </div>
              <div class="subscription-banner__text-description">
                Start your daily shopping with Maharaja Supermarket
              </div>
            </div>
            <div class="subscription-banner__form">
              <form method="post" action="/contact#contact_form" id="contact_form" accept-charset="UTF-8"
                class="newsletter-form"><input type="hidden" name="form_type" value="customer"><input type="hidden"
                  name="utf8" value="✓">
                <input type="hidden" name="contact[tags]" value="newsletter">
                <div class="newsletter-form__field-wrapper">
                  <div class="field">
                    <input id="NewsletterForm--template--17996521046172__subscription_banner_gGqWGN" type="email"
                      name="contact[email]" value="" aria-required="true" autocorrect="off" autocapitalize="off"
                      autocomplete="email" placeholder="Enter email address..." required="">
                    <button type="submit" class="btn btn--primary" name="commit" id="Subscribe" aria-label="Subscribe">
                      Subscribe
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <div class="subscription-banner__featured-img">
            <img src="uploads/banner_image_v=1725267995.png" loading="lazy"
              alt="">
          </div>
          <div class="eclipse-pattern left">

            <svg xmlns="http://www.w3.org/2000/svg" width="66" height="66" viewBox="0 0 66 66" fill="none">
              <g opacity="0.5">
                <circle cx="5.68966" cy="5.68966" r="5.68966" fill="#416611"></circle>
                <circle cx="33.0002" cy="5.68966" r="5.68966" fill="#416611"></circle>
                <circle cx="60.3107" cy="5.68966" r="5.68966" fill="#416611"></circle>
                <circle cx="5.68966" cy="33" r="5.68966" fill="#416611"></circle>
                <circle cx="33.0002" cy="33" r="5.68966" fill="#416611"></circle>
                <circle cx="60.3107" cy="33.0002" r="5.68966" fill="#416611"></circle>
                <circle cx="5.68966" cy="60.3103" r="5.68966" fill="#416611"></circle>
                <circle cx="33.0002" cy="60.3103" r="5.68966" fill="#416611"></circle>
                <circle cx="60.3107" cy="60.3103" r="5.68966" fill="#416611"></circle>
              </g>
            </svg>

          </div>
          <div class="eclipse-pattern right">

            <svg xmlns="http://www.w3.org/2000/svg" width="66" height="66" viewBox="0 0 66 66" fill="none">
              <g opacity="0.5">
                <circle cx="5.68966" cy="5.68966" r="5.68966" fill="#416611"></circle>
                <circle cx="33.0002" cy="5.68966" r="5.68966" fill="#416611"></circle>
                <circle cx="60.3107" cy="5.68966" r="5.68966" fill="#416611"></circle>
                <circle cx="5.68966" cy="33" r="5.68966" fill="#416611"></circle>
                <circle cx="33.0002" cy="33" r="5.68966" fill="#416611"></circle>
                <circle cx="60.3107" cy="33.0002" r="5.68966" fill="#416611"></circle>
                <circle cx="5.68966" cy="60.3103" r="5.68966" fill="#416611"></circle>
                <circle cx="33.0002" cy="60.3103" r="5.68966" fill="#416611"></circle>
                <circle cx="60.3107" cy="60.3103" r="5.68966" fill="#416611"></circle>
              </g>
            </svg>

          </div>
        </div>
      </div>

    </div>
    <div id="shopify-section-template--17996521046172__Maharaja Supermarket_highlights_bMjmLr" class="shopify-section">
      <div class="groceywala-highlights" style="margin-bottom: -25px;">
        <div class="container">


          <div class="groceywala-highlights__item">
            <div class="highlight-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="33" height="32" viewBox="0 0 33 32" fill="none">
                <path
                  d="M29.4577 16.0003C29.4577 8.63653 23.4881 2.66699 16.1243 2.66699C8.76055 2.66699 2.79102 8.63653 2.79102 16.0003C2.79102 23.3641 8.76055 29.3337 16.1243 29.3337C23.4881 29.3337 29.4577 23.3641 29.4577 16.0003Z"
                  stroke="#5B8A1D" stroke-width="2"></path>
                <path
                  d="M26.7913 7.59873C25.5451 7.68856 23.9488 8.17107 22.8419 9.60377C20.8427 12.1916 18.8433 12.4075 17.5105 11.5449C15.5112 10.251 17.1913 8.15523 14.8448 7.01628C13.3155 6.27397 13.1023 4.25401 13.9535 2.66675"
                  stroke="#5B8A1D" stroke-width="2" stroke-linejoin="round"></path>
                <path
                  d="M2.79102 14.667C3.80768 15.5498 5.23163 16.3579 6.90934 16.3579C10.3756 16.3579 11.0688 17.0202 11.0688 19.6694C11.0688 22.3186 11.0688 22.3186 11.7621 24.3054C12.213 25.5978 12.3706 26.8902 11.4718 28.0003"
                  stroke="#5B8A1D" stroke-width="2" stroke-linejoin="round"></path>
                <path
                  d="M29.4577 17.9365C28.2749 17.2549 26.791 16.9745 25.2889 18.0541C22.4146 20.1199 20.4329 18.4081 19.5402 20.1187C18.2263 22.6368 22.9186 23.4283 18.791 29.3335"
                  stroke="#5B8A1D" stroke-width="2" stroke-linejoin="round"></path>
              </svg>
            </div>
            <div class="highlight-title">
              20+ YEARS IN GLOBAL TRADE
            </div>
          </div>



          <div class="groceywala-highlights__item">
            <div class="highlight-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="33" height="32" viewBox="0 0 33 32" fill="none">
                <path
                  d="M29.7087 16.0001C29.7087 8.63628 23.7391 2.66675 16.3753 2.66675C9.01153 2.66675 3.04199 8.63628 3.04199 16.0001C3.04199 23.3638 9.01153 29.3334 16.3753 29.3334C23.7391 29.3334 29.7087 23.3638 29.7087 16.0001Z"
                  stroke="#5B8A1D" stroke-width="2"></path>
                <path
                  d="M11.042 17.0001C11.042 17.0001 13.1753 18.2167 14.242 20.0001C14.242 20.0001 17.442 13.0001 21.7087 10.6667"
                  stroke="#5B8A1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </div>
            <div class="highlight-title">
              PROVEN TRUST AND RELIABILITY
            </div>
          </div>



          <div class="groceywala-highlights__item">
            <div class="highlight-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="33" height="32" viewBox="0 0 33 32" fill="none">
                <path
                  d="M19.9587 11.9998C19.9587 13.8408 18.4663 15.3332 16.6253 15.3332C14.7844 15.3332 13.292 13.8408 13.292 11.9998C13.292 10.1589 14.7844 8.6665 16.6253 8.6665C18.4663 8.6665 19.9587 10.1589 19.9587 11.9998Z"
                  stroke="#5B8A1D" stroke-width="2"></path>
                <path
                  d="M18.3019 23.3246C17.8521 23.7577 17.2511 23.9998 16.6256 23.9998C16 23.9998 15.3989 23.7577 14.9492 23.3246C10.8311 19.3342 5.31225 14.8765 8.00361 8.40481C9.45879 4.9056 12.9519 2.6665 16.6256 2.6665C20.2992 2.6665 23.7923 4.90561 25.2475 8.40481C27.9355 14.8684 22.4301 19.348 18.3019 23.3246Z"
                  stroke="#5B8A1D" stroke-width="2"></path>
                <path
                  d="M24.625 26.6667C24.625 28.1395 21.0433 29.3334 16.625 29.3334C12.2067 29.3334 8.625 28.1395 8.625 26.6667"
                  stroke="#5B8A1D" stroke-width="2" stroke-linecap="round"></path>
              </svg>
            </div>
            <div class="highlight-title">
              STRIVING IN 10+ EU COUNTRIES
            </div>
          </div>



          <div class="groceywala-highlights__item">
            <div class="highlight-icon">
              <svg xmlns="http://www.w3.org/2000/svg" width="33" height="32" viewBox="0 0 33 32" fill="none">
                <path
                  d="M26.8747 23.3333C26.8747 25.1743 25.3823 26.6667 23.5413 26.6667C21.7004 26.6667 20.208 25.1743 20.208 23.3333C20.208 21.4924 21.7004 20 23.5413 20C25.3823 20 26.8747 21.4924 26.8747 23.3333Z"
                  stroke="#5B8A1D" stroke-width="2"></path>
                <path
                  d="M13.5417 23.3333C13.5417 25.1743 12.0493 26.6667 10.2083 26.6667C8.36739 26.6667 6.875 25.1743 6.875 23.3333C6.875 21.4924 8.36739 20 10.2083 20C12.0493 20 13.5417 21.4924 13.5417 23.3333Z"
                  stroke="#5B8A1D" stroke-width="2"></path>
                <path
                  d="M20.2077 23.3335H13.541M3.54102 5.3335H16.8743C18.7599 5.3335 19.7027 5.3335 20.2886 5.91928C20.8743 6.50507 20.8743 7.44788 20.8743 9.3335V20.6668M21.541 8.66683H23.9429C25.0491 8.66683 25.6022 8.66683 26.0607 8.92643C26.5191 9.18603 26.8038 9.6603 27.3729 10.6088L29.6377 14.3835C29.9209 14.8555 30.0625 15.0916 30.1351 15.3536C30.2077 15.6156 30.2077 15.8908 30.2077 16.4415V20.0002C30.2077 21.2463 30.2077 21.8694 29.9397 22.3335C29.7642 22.6375 29.5117 22.89 29.2077 23.0655C28.7435 23.3335 28.1205 23.3335 26.8743 23.3335M3.54102 17.3335V20.0002C3.54102 21.2463 3.54102 21.8694 3.80896 22.3335C3.9845 22.6375 4.23698 22.89 4.54102 23.0655C5.00512 23.3335 5.62819 23.3335 6.87435 23.3335"
                  stroke="#5B8A1D" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M3.54102 9.3335H11.541M3.54102 13.3335H8.87435" stroke="#5B8A1D" stroke-width="2"
                  stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </div>
            <div class="highlight-title">
              EXPRESS DELIVERY WITHIN 1-2 WORKING DAYS
            </div>
          </div>


        </div>
      </div>


    </div>
  </main>
  <footer id="shopify-section-footer" class="shopify-section site-footer">
    <div class="container">
      <div class="footer-store-detail d-flex justify-content-between">
        <div class="footer-logo">
          <a href="/">
            <img src="uploads/Maharaja Supermarket-white_v=1716044168.png"
              loading="lazy" alt="footer logo">
          </a>
        </div>
        <div class="social-media">
          <ul class="social-links">


            <li>
              <a href="https://www.facebook.com/Maharaja Supermarketpl/" target="_blank">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <path
                    d="M2.5 12C2.5 7.52166 2.5 5.28249 3.89124 3.89124C5.28249 2.5 7.52166 2.5 12 2.5C16.4783 2.5 18.7175 2.5 20.1088 3.89124C21.5 5.28249 21.5 7.52166 21.5 12C21.5 16.4783 21.5 18.7175 20.1088 20.1088C18.7175 21.5 16.4783 21.5 12 21.5C7.52166 21.5 5.28249 21.5 3.89124 20.1088C2.5 18.7175 2.5 16.4783 2.5 12Z"
                    stroke="#5B8A1D" stroke-width="1.5" stroke-linejoin="round"></path>
                  <path
                    d="M16.9265 8.02637H13.9816C12.9378 8.02637 12.0894 8.86847 12.0817 9.91229L11.9964 21.4268M10.082 14.0017H14.8847"
                    stroke="#5B8A1D" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>


              </a>
            </li>


            <li>
              <a href="https://www.instagram.com/Maharaja Supermarket_pl/" target="_blank">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                  <path
                    d="M2.5 12C2.5 7.52166 2.5 5.28249 3.89124 3.89124C5.28249 2.5 7.52166 2.5 12 2.5C16.4783 2.5 18.7175 2.5 20.1088 3.89124C21.5 5.28249 21.5 7.52166 21.5 12C21.5 16.4783 21.5 18.7175 20.1088 20.1088C18.7175 21.5 16.4783 21.5 12 21.5C7.52166 21.5 5.28249 21.5 3.89124 20.1088C2.5 18.7175 2.5 16.4783 2.5 12Z"
                    stroke="#5B8A1D" stroke-width="1.5" stroke-linejoin="round"></path>
                  <path
                    d="M16.5 12C16.5 14.4853 14.4853 16.5 12 16.5C9.51472 16.5 7.5 14.4853 7.5 12C7.5 9.51472 9.51472 7.5 12 7.5C14.4853 7.5 16.5 9.51472 16.5 12Z"
                    stroke="#5B8A1D" stroke-width="1.5"></path>
                  <path d="M17.508 6.5H17.499" stroke="#5B8A1D" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round"></path>
                </svg>

              </a>
            </li>


          </ul>
        </div>
      </div>
      <div class="footer-row">


        <div class="footer-col footer-link">
          <div class="footer-widget">
            <h4>Navigation</h4>

            <ul>

              <li>
                <a href="contact.php">Contact</a>
              </li>

              <li>
                <a href="/search">Search</a>
              </li>

              <li>
                <a href="/collections">All collections</a>
              </li>

              <li>
                <a href="/pages/wishlist">Wishlist</a>
              </li>

            </ul>

          </div>
        </div>

        <div class="footer-col footer-link">
          <div class="footer-widget">
            <h4>Information</h4>

            <ul>

              <li>
                <a href="/policies/terms-of-service">Terms & Conditions</a>
              </li>

              <li>
                <a href="/policies/privacy-policy">Privacy Policy</a>
              </li>

              <li>
                <a href="/pages/faq">FAQ</a>
              </li>

              <li>
                <a href="/policies/refund-policy">Return and Refund Policy</a>
              </li>

            </ul>

          </div>
        </div>


        <div class="footer-col footer-subscribe-col">
          <div class="footer-widget">
            <h4>Contact</h4>
            <div class="footer-store__info">


              <div class="icon-text">
                <div class="icon-text__icon">

                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                    <path
                      d="M12.6665 11.5C14.8756 11.5 16.6665 9.70914 16.6665 7.5C16.6665 5.29086 14.8756 3.5 12.6665 3.5C10.4574 3.5 8.6665 5.29086 8.6665 7.5C8.6665 9.70914 10.4574 11.5 12.6665 11.5Z"
                      stroke="white" stroke-width="2"></path>
                    <path d="M12.6665 11.5V18.5" stroke="white" stroke-width="2" stroke-linecap="round"></path>
                    <path
                      d="M17.6665 19.5C17.6665 20.6046 15.4279 21.5 12.6665 21.5C9.90508 21.5 7.6665 20.6046 7.6665 19.5"
                      stroke="white" stroke-width="2" stroke-linecap="round"></path>
                  </svg>

                </div>
                <div class="icon-text__address">
                  INDIAN QUALITY S.R.L.
                  Cod poștal 021303
                  , <br>
                  SOS. MIHAI BRAVU NR. 6, SECTOR 2, BUCURESTi <br>
                  Cod poștal 021303
                </div>
              </div>




              <a class="icon-text align-items-center" href="tel:072893723 , 0723242211 7">
                <div class="icon-text__icon">

                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                    <path
                      d="M5.6665 9.5C5.6665 6.20017 5.6665 4.55025 6.69163 3.52513C7.71675 2.5 9.36667 2.5 12.6665 2.5C15.9663 2.5 17.6162 2.5 18.6414 3.52513C19.6665 4.55025 19.6665 6.20017 19.6665 9.5V15.5C19.6665 18.7998 19.6665 20.4497 18.6414 21.4749C17.6162 22.5 15.9663 22.5 12.6665 22.5C9.36667 22.5 7.71675 22.5 6.69163 21.4749C5.6665 20.4497 5.6665 18.7998 5.6665 15.5V9.5Z"
                      stroke="white" stroke-width="1.5" stroke-linecap="round"></path>
                    <path d="M11.6665 19.5H13.6665" stroke="white" stroke-width="1.5" stroke-linecap="round"
                      stroke-linejoin="round"></path>
                    <path
                      d="M9.6665 2.5L9.7555 3.03402C9.94838 4.19129 10.0448 4.76993 10.4417 5.12204C10.8557 5.48934 11.4426 5.5 12.6665 5.5C13.8904 5.5 14.4773 5.48934 14.8913 5.12204C15.2882 4.76993 15.3846 4.19129 15.5775 3.03402L15.6665 2.5"
                      stroke="white" stroke-width="1.5" stroke-linejoin="round"></path>
                  </svg>

                </div>
                <div class="icon-text__phone">
                  +40 536 503 097
                </div>
              </a>



              <a class="icon-text align-items-center" href="mail:shop@maharajasupermarket.ro">
                <div class="icon-text__icon">

                  <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                    <path d="M2.6665 6.5L9.57952 10.417C12.1281 11.861 13.2049 11.861 15.7535 10.417L22.6665 6.5"
                      stroke="white" stroke-width="1.5" stroke-linejoin="round"></path>
                    <path
                      d="M2.68227 13.9756C2.74764 17.0412 2.78033 18.5739 3.91146 19.7094C5.04258 20.8448 6.61683 20.8843 9.76533 20.9634C11.7058 21.0122 13.6272 21.0122 15.5677 20.9634C18.7162 20.8843 20.2904 20.8448 21.4216 19.7094C22.5527 18.5739 22.5854 17.0412 22.6507 13.9756C22.6718 12.9899 22.6718 12.0101 22.6507 11.0244C22.5854 7.95886 22.5527 6.42609 21.4216 5.29066C20.2904 4.15523 18.7162 4.11568 15.5677 4.03657C13.6272 3.98781 11.7058 3.98781 9.76532 4.03656C6.61683 4.11566 5.04258 4.15521 3.91145 5.29065C2.78032 6.42608 2.74764 7.95885 2.68226 11.0244C2.66124 12.0101 2.66125 12.9899 2.68227 13.9756Z"
                      stroke="white" stroke-width="1.5" stroke-linejoin="round"></path>
                  </svg>

                </div>
                <div class="icon-text__mail">
                  shop@maharajasupermarket.ro
                </div>
              </a>



              <div>
                <a href="contact.php" class="btn btn--white btn--lg">
                  Contact us
                </a>
              </div>


            </div>
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <div class="row align-items-center">
          <div class="col-12 col-md-6">
            <p>Copyright © Vistula Foods 2025. All rights reserved</p>
          </div>
          <div class="col-12 col-md-6">
            <div class="supported-payment-providers">
              <img src="uploads/Frame_7628_thumb_v=1716135418.svg"
                loading="lazy" alt="payment provider">
              <img src="uploads/Frame_7627_thumb_v=1716135435.svg"
                loading="lazy" alt="payment provider">
              <img src="uploads/Frame_7626_thumb_v=1716135441.svg"
                loading="lazy" alt="payment provider">
              <img src="uploads/przelewy_thumb_v=1728244570.svg" loading="lazy"
                alt="payment provider">
              <img src="uploads/blik_thumb_v=1728244592.svg" loading="lazy"
                alt="payment provider">
            </div>
          </div>
        </div>
      </div>
    </div>

  </footer>

  <div id="shopify-section-recommendations-product" class="shopify-section recommendations-product">
    <script>
      function SomeonePurchased() {
        if (window.innerWidth > 767) {
          if (jQuery.cookie('pr_notification') == 'closed') {
            jQuery('.product-notification').remove();
          }
          jQuery('.closeNotify').bind('click', function () {
            jQuery('.product-notification').remove();
            jQuery.cookie('pr_notification', 'closed', { expires: 1, path: '/' });
          });
          function toggleSomething() {
            if ($('.product-notification').hasClass('active')) {
              $('.product-notification').removeClass('active')
            }
            else {
              var number = $('.data-product').length,
                i = Math.floor(Math.random() * number),
                images = $('.product-notification .data-product:eq(' + i + ')').data('image'),
                title = $('.product-notification .data-product:eq(' + i + ')').data('title'),
                url = $('.product-notification .data-product:eq(' + i + ')').data('url'),
                local = $('.product-notification .data-product:eq(' + i + ')').data('local'),
                times = $('.product-notification .data-product:eq(' + i + ')').data('time');

              $('.product-notification').addClass('active');
              $('.product-notification .product-image').find('img').attr('src', images);
              $('.product-notification .product-name').text(title).attr('href', url);
              $('.product-notification .product-image').attr('href', url);
              $('.product-notification .time-ago').text(times);
              $('.product-notification .from-ago').text(local);
            }
          }
          var time = $('.product-notification').data('time');
          var timer = setInterval(toggleSomething, time);
          $('.product-notification').hover(function (ev) {
            clearInterval(timer);
          }, function (ev) {
            timer = setInterval(toggleSomething, time);
          });
        }
      }
      SomeonePurchased();
      $(document)
        .on('shopify:section:load', SomeonePurchased)
        .on('shopify:section:unload', SomeonePurchased)
    </script>
  </div>



  <ul hidden="">
    <li id="a11y-refresh-page-message">Choosing a selection results in a full page refresh.</li>
  </ul>
  <script>
    window.shopUrl = 'https://maharajasupermarket.ro';
    window.routes = {
      cart_add_url: '/cart/add',
      cart_change_url: '/cart/change',
      cart_update_url: '/cart/update',
      predictive_search_url: '/search/suggest',
    };

    window.cartStrings = {
      error: `There was an error while updating your cart. Please try again.`,
      quantityError: `You can only add [quantity] of this item to your cart.`,
    };

    window.variantStrings = {
      addToCart: `Add to Cart`,
      soldOut: `Sold out`,
      unavailable: `Unavailable`,
    };

    window.accessibilityStrings = {
      imageAvailable: `Image [index] is now available in gallery view`,
      shareSuccess: `Link copied to clipboard`,
      pauseSlideshow: `Pause slideshow`,
      playSlideshow: `Play slideshow`,
    };
  </script><cart-notification>
    <div class="cart-notification-wrapper page-width">
      <div id="cart-notification" class="cart-notification focus-inset" aria-modal="true"
        aria-label="Item added to your cart" role="dialog" tabindex="-1">
        <div class="cart-notification__header">
          <h6 class="cart-notification__heading caption-large text-body">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="feather feather-check">
              <polyline points="20 6 9 17 4 12"></polyline>
            </svg>
            Item added to your cart
          </h6>
          <button type="button" class="cart-notification__close modal__close-button link link--text focus-inset"
            aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
              stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
              class="feather feather-x">
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
          </button>
        </div>
        <div id="cart-notification-product" class="cart-notification-product"></div>
        <div class="cart-notification__links">
          <a href="cart.php" id="cart-notification-button" class="outline-btn"></a>
          <form action="/cart" method="post" id="cart-notification-form">
            <button class="btn btn--secondary" name="checkout">Proceed to checkout</button>
          </form>
          <button type="button" class="btn btn--primary">Continue shopping</button>
        </div>
      </div>
    </div>
  </cart-notification>
  <div id="shopify-section-quickview" class="shopify-section">
    <div class="quickview-popup" data-section="quick-view">
      <span class="quickview-close">
        <svg height="20" viewBox="0 0 512 512" width="20" xmlns="http://www.w3.org/2000/svg">
          <g id="_02_User" data-name="02 User">
            <path
              d="m25 512a25 25 0 0 1 -17.68-42.68l462-462a25 25 0 0 1 35.36 35.36l-462 462a24.93 24.93 0 0 1 -17.68 7.32z">
            </path>
            <path
              d="m487 512a24.93 24.93 0 0 1 -17.68-7.32l-462-462a25 25 0 0 1 35.36-35.36l462 462a25 25 0 0 1 -17.68 42.68z">
            </path>
          </g>
        </svg>
      </span>
      <div class="quickview_popup_data"></div>
    </div>
  </div>
  <script src="predictive-search_v=6337430363049293461742289479.js"
    defer=""></script>


  <script src="slick-lightbox_v=156535054075192509731742289479.js"
    defer=""></script>
  <script
    src="jquery.fancybox.min_v=183759526812225689971742289479.js"
    defer=""></script>
  <script src="variant_v=127853046769395326941742289479.js"
    async=""></script>
  <script src="compare_v=114666231176119706111742289478.js"
    defer=""></script>
  <script src="https://ajax.aspnetcdn.com/ajax/jquery.templates/beta1/jquery.tmpl.min.js" async=""></script>
  <script
    src="/cdn/shop/t/7/assets/jquery.products.min_v%3D88194351912067139891742289479.js"
    async=""></script>
  <script src="/cdn/shop/t/7/assets/product-form_v%3D36638810988477619121742289479.js"
    async=""></script>
  <script src="/cdn/shop/t/7/assets/wishlist_v%3D123468706697186557161742289479.js"
    async=""></script>
  <script>
    jQuery(window).on('load', function () {
      jQuery('.ttloader').fadeOut(500);
      jQuery('.ttloader .rotating').addClass('load-open');
    });
  </script>



  <!-- Thunder Link Preloading --->
  <script>
    if (true) { let mouseoverTimer, lastTouchTimestamp; const prefetches = new Set, prefetchElement = document.createElement("link"), isSupported = prefetchElement.relList && prefetchElement.relList.supports && prefetchElement.relList.supports("prefetch") && window.IntersectionObserver && "isIntersecting" in IntersectionObserverEntry.prototype, allowQueryString = "instantAllowQueryString" in document.body.dataset, allowExternalLinks = "instantAllowExternalLinks" in document.body.dataset, useWhitelist = "instantWhitelist" in document.body.dataset, mousedownShortcut = "instantMousedownShortcut" in document.body.dataset, DELAY_TO_NOT_BE_CONSIDERED_A_TOUCH_INITIATED_ACTION = 1111; let delayOnHover = 65, useMousedown = !1, useMousedownOnly = !1, useViewport = !1; if ("instantIntensity" in document.body.dataset) { const e = document.body.dataset.instantIntensity; if ("mousedown" == e.substr(0, "mousedown".length)) useMousedown = !0, "mousedown-only" == e && (useMousedownOnly = !0); else if ("viewport" == e.substr(0, "viewport".length)) navigator.connection && (navigator.connection.saveData || navigator.connection.effectiveType && navigator.connection.effectiveType.includes("2g")) || ("viewport" == e ? document.documentElement.clientWidth * document.documentElement.clientHeight < 45e4 && (useViewport = !0) : "viewport-all" == e && (useViewport = !0)); else { const t = parseInt(e); isNaN(t) || (delayOnHover = t) } } if (isSupported) { const e = { capture: !0, passive: !0 }; if (useMousedownOnly || document.addEventListener("touchstart", touchstartListener, e), useMousedown ? mousedownShortcut || document.addEventListener("mousedown", mousedownListener, e) : document.addEventListener("mouseover", mouseoverListener, e), mousedownShortcut && document.addEventListener("mousedown", mousedownShortcutListener, e), useViewport) { let e; e = window.requestIdleCallback ? e => { requestIdleCallback(e, { timeout: 1500 }) } : e => { e() }, e((() => { const e = new IntersectionObserver((t => { t.forEach((t => { if (t.isIntersecting) { const n = t.target; e.unobserve(n), preload(n.href) } })) })); document.querySelectorAll("a").forEach((t => { isPreloadable(t) && e.observe(t) })) })) } } function touchstartListener(e) { lastTouchTimestamp = performance.now(); const t = e.target.closest("a"); isPreloadable(t) && preload(t.href) } function mouseoverListener(e) { if (performance.now() - lastTouchTimestamp < 1111) return; if (!("closest" in e.target)) return; const t = e.target.closest("a"); isPreloadable(t) && (t.addEventListener("mouseout", mouseoutListener, { passive: !0 }), mouseoverTimer = setTimeout((() => { preload(t.href), mouseoverTimer = void 0 }), delayOnHover)) } function mousedownListener(e) { const t = e.target.closest("a"); isPreloadable(t) && preload(t.href) } function mouseoutListener(e) { e.relatedTarget && e.target.closest("a") == e.relatedTarget.closest("a") || mouseoverTimer && (clearTimeout(mouseoverTimer), mouseoverTimer = void 0) } function mousedownShortcutListener(e) { if (performance.now() - lastTouchTimestamp < 1111) return; const t = e.target.closest("a"); if (e.which > 1 || e.metaKey || e.ctrlKey) return; if (!t) return; t.addEventListener("click", (function (e) { 1337 != e.detail && e.preventDefault() }), { capture: !0, passive: !1, once: !0 }); const n = new MouseEvent("click", { view: window, bubbles: !0, cancelable: !1, detail: 1337 }); t.dispatchEvent(n) } function isPreloadable(e) { if (e && e.href && (!useWhitelist || "instant" in e.dataset) && (allowExternalLinks || e.origin == location.origin || "instant" in e.dataset) && ["http:", "https:"].includes(e.protocol) && ("http:" != e.protocol || "https:" != location.protocol) && (allowQueryString || !e.search || "instant" in e.dataset) && !(e.hash && e.pathname + e.search == location.pathname + location.search || "noInstant" in e.dataset)) return !0 } function preload(e) { if (prefetches.has(e)) return; const t = document.createElement("link"); t.rel = "prefetch", t.href = e, document.head.appendChild(t), prefetches.add(e) } }
  </script>
  <!-- End Thunder Link Preloading --->

  <style> </style>


  <link rel="stylesheet" media="nope!" href="cdnwidget.judge.me/widget_v3/base.css">
</body>

</html>