<?php
session_start();
include("config.php");

// Check if user is logged in
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Restaurant System</title>
    <!-- Font Awesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f2f5;
            margin: 0;
        }
        .header {
            background-color: #ff6347;
            color: white;
            padding: 25px;
            text-align: center;
            font-size: 28px;
            font-weight: bold;
            box-shadow: 0 3px 6px rgba(0,0,0,0.2);
        }
        .nav {
            display: flex;
            background-color: #333;
        }
        .nav a {
            color: white;
            padding: 15px 20px;
            text-decoration: none;
            flex: 1;
            text-align: center;
            transition: background 0.3s;
            font-weight: bold;
        }
        .nav a:hover {
            background-color: #575757;
        }
        .content {
            padding: 30px;
        }
        .welcome {
            margin-bottom: 30px;
            text-align: center;
        }
        .welcome h2 {
            margin: 0;
            color: #333;
        }
        .welcome p {
            color: #666;
            font-size: 16px;
        }
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        .card {
            background-color: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            text-align: center;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }
        .card i {
            font-size: 40px;
            margin-bottom: 15px;
            color: white;
            padding: 20px;
            border-radius: 50%;
            display: inline-block;
        }
        .card.menu i { background-color: #ff6347; }
        .card.tables i { background-color: #1e90ff; }
        .card.orders i { background-color: #32cd32; }
        .card.users i { background-color: #ffa500; }
        .card h3 {
            margin: 10px 0;
            color: #333;
        }
        .card p {
            font-size: 18px;
            color: #555;
        }
    </style>
</head>
<body>

<div class="header">
    Restaurant Dashboard
</div>

<div class="nav">
    <a href="menu/view_menu.php"><i class="fa-solid fa-utensils"></i> Menu</a>
    <a href="tables/view_tables.php"><i class="fa-solid fa-chair"></i> Tables</a>
    <a href="orders/order_list.php"><i class="fa-solid fa-receipt"></i> Orders</a>
    <a href="users/user_list.php"><i class="fa-solid fa-users"></i> Users</a>
    <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
</div>

<div class="content">
    <div class="welcome">
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <p>Role: <?php echo $_SESSION['role']; ?></p>
    </div>

    <div class="card-grid">
        <div class="card menu">
            <i class="fa-solid fa-utensils"></i>
            <h3>Total Menu Items</h3>
            <?php
            $menu_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM menu"));
            echo "<p>$menu_count items</p>";
            ?>
        </div>

        <div class="card tables">
            <i class="fa-solid fa-chair"></i>
            <h3>Total Tables</h3>
            <?php
            $table_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM tables"));
            echo "<p>$table_count tables</p>";
            ?>
        </div>

        <div class="card orders">
            <i class="fa-solid fa-receipt"></i>
            <h3>Total Orders</h3>
            <?php
            $order_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM orders"));
            echo "<p>$order_count orders</p>";
            ?>
        </div>

        <div class="card users">
            <i class="fa-solid fa-users"></i>
            <h3>Total Users</h3>
            <?php
            $user_count = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users"));
            echo "<p>$user_count users</p>";
            ?>
        </div>
        
<div class="card report">
    <i class="fa-solid fa-chart-line"></i>
    <h3>Reports</h3>
    <p>View Sales Report</p>
</div>

    </div>
</div>

</body>
</html>