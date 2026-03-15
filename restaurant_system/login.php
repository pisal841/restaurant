<?php
session_start();
include("config.php");

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Restaurant System</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('background.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.9); /* semi-transparent for readability */
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0px 10px 25px rgba(0,0,0,0.3);
            width: 350px;
        }
        .login-card h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #ff7e5f;
            font-weight: bold;
        }
        .btn-login {
            background: #ff7e5f;
            color: #fff;
            width: 100%;
            font-weight: bold;
        }
        .btn-login:hover {
            background: #feb47b;
        }
        .error-message {
            text-align: center;
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h2>Restaurant Ordering</h2>

        <?php if(isset($error)) { echo "<p class='error-message'>$error</p>"; } ?>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
            </div>
            <button type="submit" name="login" class="btn btn-login">Login</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>