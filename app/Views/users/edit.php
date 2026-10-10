<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>POS System | Edit Staff</title>

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
            font-weight: bold;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 15px;
            background: white;
        }

        input:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px #dbeafe;
        }

        input[type="file"] {
            background: #f8fafc;
        }

        .help-text {
            display: block;
            margin-top: 7px;
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }

        .current-avatar {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #dbeafe;
            margin-top: 5px;
        }

        .avatar-placeholder {
            width: 90px;
            height: 90px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #dbeafe;
            color: #1d4ed8;
            font-size: 28px;
            font-weight: bold;
            margin-top: 5px;
        }

        .errors {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
            padding: 14px 18px;
            margin-bottom: 22px;
            border-radius: 8px;
        }

        .errors ul {
            margin: 8px 0 0;
            padding-left: 20px;
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
            font-weight: bold;
            font-size: 14px;
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
            font-weight: bold;
            font-size: 14px;
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

            <h1>Edit Staff Member</h1>

            <p class="subtitle">
                Update this staff member's account information below.
            </p>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="errors">
                    <strong>Please correct the following errors:</strong>

                    <ul>
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="errors">
                    <?= esc(session()->getFlashdata('error')) ?>
                </div>
            <?php endif; ?>

            <form
                action="<?= site_url('users/update/' . $user['id']) ?>"
                method="post"
                enctype="multipart/form-data"
            >

                <?= csrf_field() ?>

                <div class="form-group">
                    <label for="username">Username</label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        value="<?= esc(old('username') ?? $user['username']) ?>"
                        autocomplete="username"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="full_name">Full Name</label>

                    <input
                        type="text"
                        id="full_name"
                        name="full_name"
                        value="<?= esc(old('full_name') ?? $user['full_name']) ?>"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="password">New Password (Optional)</label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        minlength="8"
                        placeholder="Leave blank to keep the current password"
                        autocomplete="new-password"
                    >

                    <span class="help-text">
                        Leave blank if you do not want to change the password.
                        A new password must contain at least 8 characters.
                    </span>
                </div>

                <div class="form-group">
                    <label>Current Avatar</label>

                    <?php if (!empty($user['avatar'])): ?>
                        <img
                            class="current-avatar"
                            src="<?= base_url('uploads/avatars/' . $user['avatar']) ?>"
                            alt="Current staff avatar"
                        >
                    <?php else: ?>
                        <div class="avatar-placeholder">
                            <?= esc(strtoupper(substr($user['username'], 0, 1))) ?>
                        </div>

                        <span class="help-text">
                            No avatar has been uploaded.
                        </span>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="avatar">New Avatar (Optional)</label>

                    <input
                        type="file"
                        id="avatar"
                        name="avatar"
                        accept="image/*"
                    >

                    <span class="help-text">
                        Choose a new image if you want to replace the current avatar.
                    </span>
                </div>

                <div class="form-actions">
                    <button class="button" type="submit">
                        Update Staff
                    </button>

                    <a class="cancel" href="<?= site_url('users') ?>">
                        Cancel
                    </a>
                </div>

            </form>

        </section>

    </main>

</body>
</html>