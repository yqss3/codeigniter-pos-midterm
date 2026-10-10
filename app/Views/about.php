<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>POS System | About</title>

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

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
        }

        .about-header {
            background: linear-gradient(135deg, #1e3a8a, #2563eb);
            color: white;
            padding: 40px;
            border-radius: 16px;
            margin-bottom: 25px;
        }

        .about-header h1 {
            margin-top: 0;
            font-size: 32px;
        }

        .about-header p {
            color: #dbeafe;
            line-height: 1.8;
            margin-bottom: 0;
        }

        .about-card {
            background: white;
            padding: 30px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            line-height: 1.8;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04);
        }

        .about-card h2 {
            margin-top: 0;
            font-size: 22px;
        }

        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-top: 25px;
        }

        .feature {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 20px;
            border-radius: 10px;
        }

        .feature h3 {
            color: #1d4ed8;
            margin-top: 0;
        }

        .back-link {
            display: inline-block;
            margin-top: 25px;
            background: #2563eb;
            color: white;
            padding: 12px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }

        .back-link:hover {
            background: #1d4ed8;
        }

        .footer {
            text-align: center;
            color: #94a3b8;
            font-size: 13px;
            padding: 25px;
        }
    </style>
</head>

<body>

    <?= view('navbar') ?>

    <main class="container">

        <section class="about-header">
            <h1>About Our POS System</h1>
            <p>
                A simple Point-of-Sale system designed to help organize
                products, customer accounts, staff accounts, and sales
                transactions in one place.
            </p>
        </section>

        <section class="about-card">
            <h2>What is this system?</h2>

            <p>
                This Point-of-Sale system helps users manage important
                business records through an organized web interface.
                It provides tools for maintaining product information,
                managing customers and staff, and recording sales.
            </p>

            <div class="features">

                <div class="feature">
                    <h3>Products</h3>
                    <p>Manage product details, prices, and stock quantities.</p>
                </div>

                <div class="feature">
                    <h3>Customers</h3>
                    <p>Maintain customer names, email addresses, and phone numbers.</p>
                </div>

                <div class="feature">
                    <h3>Staff</h3>
                    <p>Manage staff accounts used to access the system.</p>
                </div>

                <div class="feature">
                    <h3>Sales</h3>
                    <p>Record purchases and review previous transactions.</p>
                </div>

            </div>

            <a href="<?= site_url('/') ?>" class="back-link">
                ← Back to Dashboard
            </a>
        </section>

    </main>

    <footer class="footer">
        Point of Sale System | About
    </footer>

</body>
</html>