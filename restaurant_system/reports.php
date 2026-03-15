<?php
session_start();

include_once __DIR__ . "../dashboard.php/";


if(!isset($_SESSION['username'])){
    header("Location: login.php");
    exit;
}


?>

// Get total income
$result = mysqli_query($conn, "SELECT SUM(total) as income, COUNT(*) as total_orders FROM orders WHERE DATE(order_date) = CURDATE()");
$row = mysqli_fetch_assoc($result);
$income = $row['income'];
$total_orders = $row['total_orders'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daily Report - Restaurant System</title>
</head>
<body>

<h2>Daily Report (<?php echo date("Y-m-d"); ?>)</h2>
<p>Total Orders Today: <?php echo $total_orders; ?></p>
<p>Total Income Today: $<?php echo $income; ?></p>

<br>
<a href="dashboard.php">Back to Dashboard</a>

</body>
</html>