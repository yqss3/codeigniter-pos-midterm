<nav class="main-navbar">
    <div class="nav-brand">
        <span class="brand-icon">POS</span>
        <span>Point of Sale</span>
    </div>

    <div class="nav-links">
        <a href="<?= site_url('/') ?>">Home</a>
        <a href="<?= site_url('about') ?>">About</a>
        <a href="<?= site_url('products') ?>">Products</a>
        <a href="<?= site_url('customers') ?>">Customers</a>
        <a href="<?= site_url('users') ?>">Staff</a>
        <a href="<?= site_url('sales/create') ?>">Record Sale</a>
        <a href="<?= site_url('sales') ?>">Sales History</a>
        <a class="logout-link" href="<?= site_url('logout') ?>">Logout</a>
    </div>
</nav>

<style>
    .main-navbar {
        background: #172554;
        color: white;
        padding: 16px 5%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.12);
    }

    .nav-brand {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 19px;
        font-weight: bold;
        white-space: nowrap;
    }

    .brand-icon {
        background: #3b82f6;
        padding: 8px 10px;
        border-radius: 8px;
        font-size: 14px;
    }

    .nav-links {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }

    .nav-links a {
        color: #e2e8f0;
        text-decoration: none;
        padding: 9px 11px;
        border-radius: 6px;
        font-size: 14px;
        transition: 0.2s;
    }

    .nav-links a:hover {
        background: #334155;
        color: white;
    }

    .nav-links .logout-link {
        background: #dc2626;
        color: white;
    }

    .nav-links .logout-link:hover {
        background: #b91c1c;
    }

    @media (max-width: 700px) {
        .main-navbar {
            align-items: flex-start;
        }

        .nav-links {
            width: 100%;
        }
    }
</style>