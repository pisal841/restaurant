<?php
session_start();
include("../config.php");

if(!isset($_GET['id'])){
    header("Location: order_list.php");
    exit;
}

$id = $_GET['id'];

// Get order info
$order = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM orders WHERE id='$id'"));
$table_number = $order['table_number'];
$total = $order['total'];
$status = $order['status'];
$date = $order['order_date'];

// For simplicity, we're not fetching individual food items in this example
?>

<!DOCTYPE html>
<html>
<head>
    <title>Receipt - Order #<?php echo $id; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .receipt-card {
            max-width: 500px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.1);
        }
        .receipt-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .receipt-footer {
            text-align: center;
            margin-top: 20px;
        }
        .btn-print {
            width: 100%;
        }
    </style>
</head>
<body>

<div class="receipt-card">
    <div class="receipt-header">
        <h3>🍴 Restaurant Receipt</h3>
        <p>Order ID: <strong><?php echo $id; ?></strong></p>
        <p>Table Number: <strong><?php echo $table_number; ?></strong></p>
        <p>Status: <span class="badge <?php 
            echo match($status){
                'Pending'=>'bg-warning text-dark',
                'Cooking'=>'bg-info text-dark',
                'Ready'=>'bg-primary text-white',
                'Completed'=>'bg-success text-white',
                default=>'bg-secondary text-white'
            }; ?>"><?php echo $status; ?></span></p>
        <p>Order Date: <?php echo $date; ?></p>
    </div>

    <hr>

    <h4 class="text-end">Total: $<?php echo $total; ?></h4>

    <hr>

    <p class="receipt-footer">Thank you for dining with us!</p>

    <button onclick="window.print()" class="btn btn-success btn-print mb-2">🖨️ Print Receipt</button>
    <a href="order_list.php" class="btn btn-secondary btn-print">⬅ Back to Orders</a>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>