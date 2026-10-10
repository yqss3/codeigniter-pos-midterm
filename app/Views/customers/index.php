<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>POS System | Customer Management</title>

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
            max-width: 1200px;
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

        .add-button {
            display: inline-block;
            padding: 12px 18px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }

        .add-button:hover {
            background: #1d4ed8;
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
            min-width: 700px;
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

        .customer-name {
            font-weight: bold;
            color: #1e293b;
        }

        .action-link {
            display: inline-block;
            text-decoration: none;
            font-weight: bold;
            margin-right: 12px;
        }

        .edit {
            color: #2563eb;
        }

        .edit:hover {
            text-decoration: underline;
        }

        .delete-button {
            background: #dc2626;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
        }

        .delete-button:hover {
            background: #b91c1c;
        }

        .empty-state {
            text-align: center;
            color: #64748b;
            padding: 35px;
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
                <h1>Customer Management</h1>
                <p class="subtitle">
                    Manage customer names, email addresses, and phone numbers.
                </p>
            </div>

            <a class="add-button" href="<?= site_url('customers/create') ?>">
                + Add Customer
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
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($customers)): ?>

                        <?php foreach ($customers as $customer): ?>
                            <tr>
                                <td><?= esc($customer['id']) ?></td>

                                <td class="customer-name">
                                    <?= esc($customer['full_name']) ?>
                                </td>

                                <td><?= esc($customer['email']) ?></td>

                                <td><?= esc($customer['phone'] ?? '') ?></td>

                                <td>
                                    <a
                                        class="action-link edit"
                                        href="<?= site_url('customers/edit/' . $customer['id']) ?>"
                                    >
                                        Edit
                                    </a>

                                    <form
                                        action="<?= site_url('customers/delete/' . $customer['id']) ?>"
                                        method="post"
                                        onsubmit="return confirm('Are you sure you want to delete this customer?');"
                                    >
                                        <?= csrf_field() ?>

                                        <button
                                            type="submit"
                                            class="delete-button"
                                        >
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="empty-state">
                                No customers found. Click "Add Customer" to register your first customer.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </main>

</body>
</html>