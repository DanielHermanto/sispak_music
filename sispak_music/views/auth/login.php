<!DOCTYPE html>
<html>
<head>
    <title>Login - Sistem Pakar Music</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
        }
        .box {
            width: 350px;
            margin: 100px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input {
            width: 100%;
            padding: 8px;
            margin: 5px 0 10px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #2c3e50;
            color: white;
            border: none;
        }
        a {
            text-decoration: none;
            font-size: 12px;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Login</h2>

    <form method="POST">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>

    <br>
    <a href="index.php?page=register">Belum punya akun? Register</a>
</div>

</body>
</html>
