<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS System | Staff Management</title>

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
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 25px;
        }

        h1 {
            margin: 0 0 10px;
            color: #172554;
            font-size: 28px;
        }

        .subtitle {
            color: #64748b;
            margin: 0;
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
            overflow-x: auto;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.04);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        th, td {
            padding: 16px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }

        th {
            background: #172554;
            color: white;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        tbody tr:hover {
            background: #f8fafc;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .avatar {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #e2e8f0;
        }

        .no-avatar {
            display: inline-flex;
            width: 45px;
            height: 45px;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #dbeafe;
            color: #1d4ed8;
            font-weight: bold;
        }

        .action-link {
            display: inline-block;
            color: #2563eb;
            text-decoration: none;
            font-weight: bold;
            margin-right: 12px;
        }

        .action-link:hover {
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
                <h1>Staff Management</h1>
                <p class="subtitle">
                    Manage the staff accounts for your POS system.
                </p>
            </div>

            <a class="add-button" href="<?= site_url('users/create') ?>">
                + Add Staff
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
                        <th>Avatar</th>
                        <th>Username</th>
                        <th>Full Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($users)): ?>

                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= esc($user['id']) ?></td>

                                <td>
                                    <?php if (!empty($user['avatar'])): ?>
                                        <img
                                            class="avatar"
                                            src="<?= base_url('uploads/avatars/' . $user['avatar']) ?>"
                                            alt="Staff avatar"
                                        >
                                    <?php else: ?>
                                        <span class="no-avatar">
                                            <?= esc(strtoupper(substr($user['username'], 0, 1))) ?>
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td><?= esc($user['username']) ?></td>

                                <td><?= esc($user['full_name']) ?></td>

                                <td>
                                    <a
                                        class="action-link"
                                        href="<?= site_url('users/edit/' . $user['id']) ?>"
                                    >Edit</a>

                                    <form
                                        action="<?= site_url('users/delete/' . $user['id']) ?>"
                                        method="post"
                                        style="display:inline;"
                                        onsubmit="return confirm('Are you sure you want to delete this staff member?');"
                                    >
                                        <?= csrf_field() ?>

                                        <button
                                            class="delete-button"
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
                            <td colspan="5" class="empty-state">
                                No staff members found.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </main>

</body>
</html>