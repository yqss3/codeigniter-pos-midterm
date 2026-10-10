<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>POS System | Dashboard</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        .dashboard {
            max-width: 1200px;
            margin: 0 auto;
            padding: 35px 25px;
        }

        .welcome {
            background: linear-gradient(135deg, #1e3a8a, #2563eb);
            color: white;
            padding: 38px;
            border-radius: 16px;
            margin-bottom: 30px;
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.15);
        }

        .welcome h1 {
            margin: 0 0 12px;
            font-size: 32px;
        }

        .welcome p {
            margin: 0;
            color: #dbeafe;
            line-height: 1.7;
        }

        .section-title {
            font-size: 22px;
            margin-bottom: 18px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
        }

        .dashboard-card {
            display: block;
            background: white;
            padding: 25px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            text-decoration: none;
            color: #1e293b;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .dashboard-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 22px rgba(15, 23, 42, 0.09);
            border-color: #93c5fd;
        }

        .card-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            background: #dbeafe;
            color: #1d4ed8;
            border-radius: 10px;
            font-weight: bold;
            margin-bottom: 18px;
        }

        .dashboard-card h3 {
            margin: 0 0 10px;
            font-size: 18px;
        }

        .dashboard-card p {
            margin: 0;
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
        }

        .card-action {
            display: block;
            margin-top: 18px;
            color: #2563eb;
            font-weight: bold;
            font-size: 14px;
        }

        .footer {
            text-align: center;
            color: #94a3b8;
            font-size: 13px;
            padding: 30px 15px;
        }

        @media (max-width: 850px) {
            .dashboard-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 550px) {
            .dashboard {
                padding: 22px 15px;
            }

            .welcome {
                padding: 25px;
            }

            .welcome h1 {
                font-size: 25px;
            }

            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <?= view('navbar') ?>

    <main class="dashboard">

        <section class="welcome">
            <h1>Welcome to Your POS Dashboard</h1>
            <p>
                Manage your products, customers, staff accounts, and sales
                using the Point of Sale system.
            </p>
        </section>

        <h2 class="section-title">System Management</h2>

        <div class="dashboard-grid">

            <a href="<?= site_url('products') ?>" class="dashboard-card">
                <span class="card-icon">P</span>
                <h3>Products</h3>
                <p>Manage product details, prices, and available stock.</p>
                <span class="card-action">Manage Products →</span>
            </a>

            <a href="<?= site_url('customers') ?>" class="dashboard-card">
                <span class="card-icon">C</span>
                <h3>Customers</h3>
                <p>Add new customers and update or remove customer records.</p>
                <span class="card-action">Manage Customers →</span>
            </a>

            <a href="<?= site_url('users') ?>" class="dashboard-card">
                <span class="card-icon">S</span>
                <h3>Staff Management</h3>
                <p>Manage staff accounts and their information.</p>
                <span class="card-action">Manage Staff →</span>
            </a>

            <a href="<?= site_url('sales/create') ?>" class="dashboard-card">
                <span class="card-icon">+</span>
                <h3>Record Sale</h3>
                <p>Record a purchase and automatically update product stock.</p>
                <span class="card-action">Create a Sale →</span>
            </a>

            <a href="<?= site_url('sales') ?>" class="dashboard-card">
                <span class="card-icon">H</span>
                <h3>Sales History</h3>
                <p>Review recorded transactions, quantities, and total prices.</p>
                <span class="card-action">View Sales →</span>
            </a>

            <a href="<?= site_url('about') ?>" class="dashboard-card">
                <span class="card-icon">i</span>
                <h3>About</h3>
                <p>Learn more about this Point of Sale system.</p>
                <span class="card-action">Learn More →</span>
            </a>

        </div>

    </main>

    <footer class="footer">
        Point of Sale System | Dashboard
    </footer>

</body>
</html>
