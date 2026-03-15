<?php
session_start();
include("../config.php");

if(!isset($_GET['id'])){
    header("Location: order_list.php");
    exit;
}

$id = $_GET['id'];
$order = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM orders WHERE id='$id'"));

if(isset($_POST['update'])){
    $status = $_POST['status'];
    mysqli_query($conn, "UPDATE orders SET status='$status' WHERE id='$id'");
    header("Location: order_list.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Order - Restaurant System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Lucide Icons -->
    <link href="https://cdn.jsdelivr.net/npm/lucide@0.276.0/dist/lucide.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
        }
        .form-container {
            max-width: 500px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <h3 class="mb-4">✏️ Edit Order #<?php echo $id; ?></h3>

        <form method="POST" action="">
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select" required>
                    <option value="Pending" <?php if($order['status']=='Pending') echo 'selected'; ?>>Pending</option>
                    <option value="Cooking" <?php if($order['status']=='Cooking') echo 'selected'; ?>>Cooking</option>
                    <option value="Ready" <?php if($order['status']=='Ready') echo 'selected'; ?>>Ready</option>
                    <option value="Completed" <?php if($order['status']=='Completed') echo 'selected'; ?>>Completed</option>
                </select>
            </div>

            <button type="submit" name="update" class="btn btn-primary">
                <i data-lucide="save"></i> Update Status
            </button>
            <a href="order_list.php" class="btn btn-secondary">
                <i data-lucide="arrow-left"></i> Back to Orders
            </a>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Lucide Icons JS -->
<script src="https://cdn.jsdelivr.net/npm/lucide@0.276.0/dist/lucide.js"></script>
<script>
    lucide.createIcons();
</script>

</body>
</html>