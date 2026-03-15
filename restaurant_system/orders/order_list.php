<?php
session_start();
include("../config.php");

// Check login
if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Orders - Restaurant System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Lucide Icons -->
    <link href="https://cdn.jsdelivr.net/npm/lucide@0.276.0/dist/lucide.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
        }
        .table-actions a {
            margin-right: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mb-4">📋 Orders</h2>

    <a href="create_order.php" class="btn btn-success mb-3">
        <i data-lucide="plus-circle"></i> Create New Order
    </a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Table Number</th>
                    <th>Total ($)</th>
                    <th>Status</th>
                    <th>Order Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conn, "SELECT * FROM orders ORDER BY order_date DESC");
                while($row = mysqli_fetch_assoc($result)){
                    // Add badge color based on status
                    $statusClass = match($row['status']){
                        'Pending' => 'bg-warning text-dark',
                        'Cooking' => 'bg-info text-dark',
                        'Ready' => 'bg-primary text-white',
                        'Completed' => 'bg-success text-white',
                        default => 'bg-secondary text-white'
                    };

                    echo "<tr>";
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".$row['table_number']."</td>";
                    echo "<td>$".$row['total']."</td>";
                    echo "<td><span class='badge $statusClass'>".$row['status']."</span></td>";
                    echo "<td>".$row['order_date']."</td>";
                    echo "<td class='table-actions'>
                            <a href='edit_order.php?id=".$row['id']."' class='btn btn-primary btn-sm'>
                                <i data-lucide='edit-2'></i> Edit
                            </a>
                            <a href='delete_order.php?id=".$row['id']."' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this order?\")'>
                                <i data-lucide='trash-2'></i> Delete
                            </a>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <a href="../dashboard.php" class="btn btn-secondary mt-3">
        <i data-lucide="arrow-left"></i> Back to Dashboard
    </a>
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