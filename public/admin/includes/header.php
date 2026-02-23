<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title ?? 'Dashboard'; ?> - Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #5B8A1D;
            --secondary: #4a7017;
            --dark: #111827;
            --sidebar-bg: #1f2937;
            --body-bg: #f9fafb;
            --text-main: #374151;
            --border: #e5e7eb;
        }
        body { font-family: 'Inter', sans-serif; background: var(--body-bg); color: var(--text-main); margin: 0; display: flex; min-height: 100vh; }
        
        /* Sidebar */
        .sidebar { width: 260px; background: var(--sidebar-bg); color: #fff; flex-shrink: 0; display: flex; flex-direction: column; }
        .sidebar-header { padding: 1.5rem; background: rgba(0,0,0,0.2); text-align: center; }
        .sidebar-header h2 { margin: 0; font-size: 1.25rem; color: var(--primary); }
        .nav-links { padding: 1rem 0; flex-grow: 1; }
        .nav-link { display: flex; align-items: center; padding: 0.75rem 1.5rem; color: #d1d5db; text-decoration: none; transition: 0.2s; }
        .nav-link:hover { background: rgba(255,255,255,0.05); color: #fff; }
        .nav-link.active { background: var(--primary); color: #fff; }
        .nav-link i { width: 20px; margin-right: 12px; font-size: 1.1rem; }
        
        /* Main Content */
        .main-wrapper { flex-grow: 1; display: flex; flex-direction: column; overflow-x: hidden; }
        header { background: #fff; height: 60px; display: flex; align-items: center; justify-content: flex-end; padding: 0 2rem; border-bottom: 1px solid var(--border); }
        .admin-profile { display: flex; align-items: center; gap: 10px; color: var(--dark); font-weight: 600; }
        
        .content-area { padding: 2rem; }
        
        /* Dashboard Cards */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
        .stat-card { background: #fff; padding: 1.5rem; border-radius: 0.75rem; border: 1px solid var(--border); }
        .stat-card .label { color: #6b7280; font-size: 0.875rem; font-weight: 500; }
        .stat-card .value { font-size: 1.5rem; font-weight: 700; color: var(--dark); margin: 0.5rem 0; }
        .stat-card .trend { font-size: 0.75rem; font-weight: 600; }
        .trend.up { color: #059669; }
        
        /* Tables */
        .card { background: #fff; border-radius: 0.75rem; border: 1px solid var(--border); overflow: hidden; margin-bottom: 2rem; }
        .card-header { padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
        .card-header h3 { margin: 0; font-size: 1.1rem; }
        .table-responsive { width: 100%; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; background: #f9fafb; padding: 1rem 1.5rem; color: #6b7280; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid var(--border); }
        td { padding: 1rem 1.5rem; border-bottom: 1px solid var(--border); font-size: 0.875rem; }
        
        .badge { padding: 0.25rem 0.6rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; }
        .badge-pending { background: #fef3c7; color: #92400e; }
        .badge-completed { background: #d1fae5; color: #065f46; }
        .badge-low-stock { background: #fee2e2; color: #991b1b; }
        
        .btn-view { color: var(--primary); font-weight: 600; text-decoration: none; }
        .logout-link { color: #ef4444; margin-left:15px; text-decoration: none; font-size: 14px; }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <h2>Maharaja Admin</h2>
        </div>
        <div class="nav-links">
            <?php $current_page = basename($_SERVER['PHP_SELF']); ?>
            <a href="index.php" class="nav-link <?php echo $current_page == 'index.php' ? 'active' : ''; ?>"><i class="fas fa-home"></i> Dashboard</a>
            <a href="orders.php" class="nav-link <?php echo $current_page == 'orders.php' ? 'active' : ''; ?>"><i class="fas fa-shopping-cart"></i> Orders</a>
            <a href="products.php" class="nav-link <?php echo $current_page == 'products.php' ? 'active' : ''; ?>"><i class="fas fa-box"></i> Products</a>
            <a href="categories.php" class="nav-link <?php echo $current_page == 'categories.php' ? 'active' : ''; ?>"><i class="fas fa-tags"></i> Categories</a>
            <a href="customers.php" class="nav-link <?php echo $current_page == 'customers.php' ? 'active' : ''; ?>"><i class="fas fa-users"></i> Customers</a>
            <a href="coupons.php" class="nav-link <?php echo $current_page == 'coupons.php' ? 'active' : ''; ?>"><i class="fas fa-tag"></i> Coupons</a>
            <a href="settings.php" class="nav-link <?php echo $current_page == 'settings.php' ? 'active' : ''; ?>"><i class="fas fa-cog"></i> Settings</a>
        </div>
    </div>
    
    <div class="main-wrapper">
        <header>
            <div class="admin-profile">
                <i class="fas fa-user-circle"></i>
                <span><?php echo htmlspecialchars($_SESSION['admin_username'] ?? 'Admin'); ?></span>
                <a href="logout.php" class="logout-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </header>
        <div class="content-area">
