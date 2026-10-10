<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Staff Login</title>

    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background: #f3f5f9;
            color: #222;
        }

        .login-container {
            width: 100%;
            max-width: 380px;
            box-sizing: border-box;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin-top: 0;
            color: #293f63;
            text-align: center;
        }

        p {
            text-align: center;
            color: #666;
        }

        label {
            display: block;
            margin: 16px 0 6px;
        }

        input {
            box-sizing: border-box;
            width: 100%;
            padding: 11px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            margin-top: 22px;
            padding: 12px;
            background: #293f63;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background: #1d2e4a;
        }

        .error {
            padding: 10px;
            background: #fde8e8;
            color: #b42318;
            border-radius: 4px;
            margin-bottom: 12px;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h1>POS Login</h1>
    <p>Sign in to your staff account</p>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="error">
            <?= esc(session()->getFlashdata('error')) ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('login') ?>" method="post">
        <?= csrf_field() ?>

        <label for="username">Username</label>
        <input
            type="text"
            id="username"
            name="username"
            value="<?= esc(old('username') ?? '') ?>"
            autocomplete="username"
            required
        >

        <label for="password">Password</label>
        <input
            type="password"
            id="password"
            name="password"
            autocomplete="current-password"
            required
        >

        <button type="submit">Log In</button>
    </form>
</div>

</body>
</html>
