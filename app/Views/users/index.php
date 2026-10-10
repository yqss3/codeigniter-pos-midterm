<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Accounts</title>
</head>
<body>
    <h1>User Accounts</h1>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Full Name</th>
                <th>Role</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= esc($user['user_id']) ?></td>
                    <td><?= esc($user['username']) ?></td>
                    <td><?= esc($user['full_name']) ?></td>
                    <td><?= esc($user['role']) ?></td>
                    <td><?= esc($user['email']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
