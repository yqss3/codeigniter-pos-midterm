<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>POS System | Product Management</title>

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
            max-width: 1250px;
            margin: 0 auto;
            padding: 35px 25px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 25px;
        }

        h1 {
            margin: 0 0 10px;
            color: #172554;
            font-size: 28px;
        }

        .subtitle {
            margin: 0;
            color: #64748b;
        }

        .button {
            display: inline-block;
            padding: 10px 14px;
            border: none;
            border-radius: 7px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            transition: background 0.2s;
        }

        .add-button {
            background: #2563eb;
            color: white;
            padding: 12px 18px;
        }

        .add-button:hover {
            background: #1d4ed8;
        }

        .edit-button {
            background: #fef3c7;
            color: #92400e;
            margin-right: 6px;
        }

        .edit-button:hover {
            background: #fde68a;
        }

        .delete-button {
            background: #dc2626;
            color: white;
        }

        .delete-button:hover {
            background: #b91c1c;
        }

        .message {
            padding: 14px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .table-container {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow-x: auto;
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.04);
        }

        table {
            width: 100%;
            min-width: 800px;
            border-collapse: collapse;
        }

        th, td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        th {
            background: #172554;
            color: white;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .product-image {
            width: 58px;
            height: 58px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }

        .no-image {
            display: inline-flex;
            width: 58px;
            height: 58px;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: #f1f5f9;
            color: #64748b;
            font-size: 12px;
        }

        .product-name {
            font-weight: bold;
            color: #1e293b;
        }

        .price {
            font-weight: bold;
            color: #166534;
            white-space: nowrap;
        }

        .stock {
            display: inline-block;
            padding: 6px 10px;
            background: #dbeafe;
            color: #1d4ed8;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .empty-state {
            padding: 35px;
            text-align: center;
            color: #64748b;
        }

        .actions {
            white-space: nowrap;
        }

        form {
            display: inline;
        }

        @media (max-width: 600px) {
            .container {
                padding: 25px 15px;
            }

            .page-header {
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>

    <?= view('navbar') ?>

    <main class="container">

        <div class="page-header">
            <div>
                <h1>Product Management</h1>
                <p class="subtitle">
                    Manage your products, prices, and available stock.
                </p>
            </div>

            <a class="button add-button" href="<?= site_url('products/create') ?>">
                + Add Product
            </a>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
            <div class="message success">
                <?= esc(session()->getFlashdata('success')) ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="message error">
                <?= esc(session()->getFlashdata('error')) ?>
            </div>
        <?php endif; ?>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Stock Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($products)): ?>

                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= esc($product['id']) ?></td>

                                <td>
                                    <?php if (!empty($product['image'])): ?>
                                        <img
                                            class="product-image"
                                            src="<?= base_url('uploads/products/' . $product['image']) ?>"
                                            alt="<?= esc($product['name']) ?>"
                                        >
                                    <?php else: ?>
                                        <span class="no-image">No image</span>
                                    <?php endif; ?>
                                </td>

                                <td class="product-name">
                                    <?= esc($product['name']) ?>
                                </td>

                                <td class="price">
                                    ₱<?= number_format((float) $product['price'], 2) ?>
                                </td>

                                <td>
                                    <span class="stock">
                                        <?= esc($product['stock_quantity']) ?> units
                                    </span>
                                </td>

                                <td class="actions">
                                    <a
                                        class="button edit-button"
                                        href="<?= site_url('products/edit/' . $product['id']) ?>"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="<?= site_url('products/delete/' . $product['id']) ?>"
                                        method="post"
                                        onsubmit="return confirm('Are you sure you want to delete this product?');"
                                    >
                                        <?= csrf_field() ?>

                                        <button
                                            class="button delete-button"
                                            type="submit"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="empty-state">
                                No products found. Click "Add Product" to register your first product.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </main>

</body>
</html>