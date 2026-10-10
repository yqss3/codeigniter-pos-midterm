<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>POS System | Edit Customer</title>

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
            max-width: 750px;
            margin: 35px auto;
            padding: 20px;
        }

        .form-card {
            background: white;
            padding: 32px;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            box-shadow: 0 5px 18px rgba(15, 23, 42, 0.05);
        }

        h1 {
            margin: 0 0 10px;
            color: #172554;
            font-size: 28px;
        }

        .subtitle {
            color: #64748b;
            margin-bottom: 28px;
            line-height: 1.6;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: white;
            font-size: 15px;
        }

        input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px #dbeafe;
        }

        .message {
            padding: 14px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .form-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-top: 28px;
        }

        .button {
            display: inline-block;
            padding: 12px 18px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
        }

        .button:hover {
            background: #1d4ed8;
        }

        .cancel {
            display: inline-block;
            padding: 12px 18px;
            background: #e2e8f0;
            color: #334155;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .cancel:hover {
            background: #cbd5e1;
        }

        @media (max-width: 600px) {
            .container {
                padding: 15px;
            }

            .form-card {
                padding: 22px;
            }
        }
    </style>
</head>

<body>

    <?= view('navbar') ?>

    <main class="container">
        <section class="form-card">

            <h1>Edit Customer</h1>

            <p class="subtitle">
                Update the customer's information below.
            </p>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="message">
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="message">
                    <ul>
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form
                action="<?= site_url('customers/update/' . $customer['id']) ?>"
                method="post"
            >
                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input
                        type="text"
                        id="full_name"
                        name="full_name"
                        value="<?= esc(old('full_name') ?? $customer['full_name']) ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="<?= esc(old('email') ?? $customer['email']) ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input
                        type="text"
                        id="phone"
                        name="phone"
                        value="<?= esc(old('phone') ?? $customer['phone']) ?>"
                        required
                    >
                </div>

                <div class="form-actions">
                    <button class="button" type="submit">
                        Update Customer
                    </button>

                    <a class="cancel" href="<?= site_url('customers') ?>">
                        Cancel
                    </a>
                </div>
            </form>

        </section>
    </main>

</body>
</html>