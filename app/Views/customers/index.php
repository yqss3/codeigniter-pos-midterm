<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Accounts</title>
</head>
<body>
    <h1>Customer Accounts</h1>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= esc($customer['customer_id']) ?></td>
                    <td><?= esc($customer['full_name']) ?></td>
                    <td><?= esc($customer['email']) ?></td>
                    <td><?= esc($customer['phone']) ?></td>
                    <td><?= esc($customer['address'] ?? '') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
