
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales History - POS</title>

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f1f5f9;
            color: #1e293b;
        }

        .page-container {
            max-width: 1400px;
            margin: auto;
            padding: 30px 5%;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 25px;
        }

        h1 {
            margin: 0 0 8px;
            font-size: 28px;
            color: #172554;
        }

        .page-header p {
            margin: 0;
            color: #64748b;
            font-size: 14px;
        }

        .btn {
            display: inline-block;
            padding: 12px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .btn-primary {
            background: #2563eb;
            color: white;
        }

        .btn-primary:hover { background: #1d4ed8; }

        .btn-secondary {
            background: #e2e8f0;
            color: #334155;
        }

        .btn-secondary:hover { background: #cbd5e1; }

        .content-card {
            background: white;
            padding: 25px;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(15, 23, 42, .06);
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-bottom: 15px;
        }

        .table-header h2 {
            margin: 0;
            font-size: 19px;
            color: #172554;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 850px;
            border-collapse: collapse;
        }

        th {
            background: #172554;
            color: white;
            padding: 15px 12px;
            text-align: left;
            font-size: 13px;
            white-space: nowrap;
        }

        td {
            padding: 14px 12px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 14px;
        }

        tbody tr:hover { background: #f8fafc; }

        .sale-id {
            color: #2563eb;
            font-weight: bold;
        }

        .price {
            color: #15803d;
            font-weight: bold;
            white-space: nowrap;
        }

        .quantity {
            display: inline-block;
            background: #dbeafe;
            color: #1d4ed8;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: bold;
        }

        .success {
            padding: 14px 16px;
            margin-bottom: 20px;
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
        }

        .empty {
            text-align: center;
            padding: 35px 15px;
            color: #64748b;
        }

        .empty strong {
            display: block;
            margin-bottom: 8px;
            color: #334155;
            font-size: 16px;
        }

        @media (max-width: 600px) {
            .page-container { padding: 20px 4%; }
            .content-card { padding: 15px; }
            h1 { font-size: 24px; }
        }
    </style>
</head>
<body>

<?= view('navbar') ?>

<div class="page-container">

    <div class="page-header">
        <div>
            <h1>Sales History</h1>
            <p>View and review your recorded transactions.</p>
        </div>

        <a class="btn btn-primary" href="<?= site_url('sales/create') ?>">
            + Record New Sale
        </a>
    </div>

    <?php if ($message = session()->getFlashdata('success')): ?>
        <div class="success">
            <?= esc($message) ?>
        </div>
    <?php endif; ?>

    <div class="content-card">

        <div class="table-header">
            <h2>Transaction Records</h2>

            <a class="btn btn-secondary" href="<?= site_url('/') ?>">
                Back to Dashboard
            </a>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Sale ID</th>
                        <th>Product</th>
                        <th>Customer</th>
                        <th>Staff</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Date Recorded</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($sales)): ?>
                        <?php foreach ($sales as $sale): ?>
                            <tr>
                                <td class="sale-id">
                                    #<?= esc($sale['id'] ?? '') ?>
                                </td>

                                <td>
                                    <?= esc($sale['product_name'] ?? 'Unknown Product') ?>
                                </td>

                                <td>
                                    <?= esc($sale['customer_name'] ?? 'Walk-in') ?>
                                </td>

                                <td>
                                    <?= esc($sale['staff_name'] ?? 'Unknown Staff') ?>
                                </td>

                                <td>
                                    <span class="quantity">
                                        <?= esc($sale['quantity'] ?? 0) ?>
                                    </span>
                                </td>

                                <td class="price">
                                    ₱<?= number_format((float) ($sale['total_price'] ?? 0), 2) ?>
                                </td>

                                <td>
                                    <?= esc($sale['created_at'] ?? 'N/A') ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="empty">
                                <strong>No sales recorded yet.</strong>
                                Your completed transactions will appear here.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>

</body>
</html>
