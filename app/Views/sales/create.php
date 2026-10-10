<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>POS System | Record Sale</title>

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
            margin-bottom: 22px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            font-size: 14px;
        }

        input, select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: white;
            font-size: 15px;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px #dbeafe;
        }

        .help-text {
            display: block;
            margin-top: 7px;
            color: #64748b;
            font-size: 12px;
        }

        .message {
            padding: 14px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .form-actions {
            display: flex;
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

            <h1>Record a Sale</h1>

            <p class="subtitle">
                Select a product, enter the quantity, and record the transaction.
            </p>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="message error">
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="message error">
                    <ul>
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('sales/store') ?>" method="post">

                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="product_id">Product</label>

                    <select id="product_id" name="product_id" required>
                        <option value="">-- Select a product --</option>

                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <option
                                    value="<?= esc($product['id']) ?>"
                                    <?= (string) old('product_id') === (string) $product['id'] ? 'selected' : '' ?>
                                    <?= (int) $product['stock_quantity'] < 1 ? 'disabled' : '' ?>
                                >
                                    <?= esc($product['name']) ?>
                                    — ₱<?= number_format((float) $product['price'], 2) ?>
                                    (Stock: <?= esc($product['stock_quantity']) ?>)
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>

                    <span class="help-text">
                        Products with no available stock cannot be selected.
                    </span>
                </div>

                <div class="form-group">
                    <label for="customer_id">Customer (Optional)</label>

                    <select id="customer_id" name="customer_id">
                        <option value="">Walk-in Customer</option>

                        <?php if (!empty($customers)): ?>
                            <?php foreach ($customers as $customer): ?>
                                <option
                                    value="<?= esc($customer['id']) ?>"
                                    <?= (string) old('customer_id') === (string) $customer['id'] ? 'selected' : '' ?>
                                >
                                    <?= esc($customer['full_name']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="quantity">Quantity</label>

                    <input
                        type="number"
                        id="quantity"
                        name="quantity"
                        min="1"
                        step="1"
                        value="<?= esc(old('quantity') ?? '1') ?>"
                        required
                    >

                    <span class="help-text">
                        The system should reject quantities greater than the available stock.
                    </span>
                </div>

                <div class="form-actions">
                    <button class="button" type="submit">
                        Record Sale
                    </button>

                    <a class="cancel" href="<?= site_url('sales') ?>">
                        View Sales History
                    </a>
                </div>

            </form>

        </section>
    </main>

</body>
</html>