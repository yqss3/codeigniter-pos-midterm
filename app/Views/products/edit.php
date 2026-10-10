<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>POS System | Edit Product</title>

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

        input[type="file"] {
            background: #f8fafc;
        }

        .current-image {
            display: block;
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            margin-top: 10px;
        }

        .no-image {
            display: inline-block;
            padding: 12px;
            background: #f1f5f9;
            color: #64748b;
            border-radius: 8px;
            margin-top: 5px;
        }

        .help-text {
            display: block;
            margin-top: 7px;
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
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

            <h1>Edit Product</h1>

            <p class="subtitle">
                Update the product details and inventory information below.
            </p>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="message error">
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="message error">
                    <strong>Please correct the following errors:</strong>

                    <ul>
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form
                action="<?= site_url('products/update/' . $product['id']) ?>"
                method="post"
                enctype="multipart/form-data"
            >

                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="name">Product Name</label>

                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="<?= esc(old('name', $product['name'])) ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="price">Price (₱)</label>

                    <input
                        type="number"
                        id="price"
                        name="price"
                        step="0.01"
                        min="0"
                        value="<?= esc(old('price', $product['price'])) ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="stock_quantity">Stock Quantity</label>

                    <input
                        type="number"
                        id="stock_quantity"
                        name="stock_quantity"
                        min="0"
                        step="1"
                        value="<?= esc(old('stock_quantity', $product['stock_quantity'])) ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Current Product Image</label>

                    <?php if (!empty($product['image'])): ?>
                        <img
                            class="current-image"
                            src="<?= base_url('uploads/products/' . $product['image']) ?>"
                            alt="<?= esc($product['name']) ?>"
                        >
                    <?php else: ?>
                        <span class="no-image">No image uploaded yet</span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="image">Replace Product Image (Optional)</label>

                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept="image/jpeg,image/png,image/webp"
                    >

                    <span class="help-text">
                        Accepted formats: JPG, PNG, or WebP. Maximum size: 2 MB.
                        Leave this empty to keep the current image.
                    </span>
                </div>

                <div class="form-actions">
                    <button class="button" type="submit">
                        Update Product
                    </button>

                    <a class="cancel" href="<?= site_url('products') ?>">
                        Cancel
                    </a>
                </div>

            </form>

        </section>

    </main>

</body>
</html>