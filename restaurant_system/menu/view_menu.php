<?php
session_start();
include("../config.php");

// Check if user is logged in
if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Food Menu - Restaurant System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Lucide Icons for buttons -->
    <link href="https://cdn.jsdelivr.net/npm/lucide@0.276.0/dist/lucide.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
        }
        .table-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
        }
        .action-btn i {
            margin-right: 4px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mb-4">🍔 Food Menu</h2>
    
    <a href="add_menu.php" class="btn btn-success mb-3">
        <i data-lucide="plus-circle"></i> Add New Food
    </a>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Price ($)</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = mysqli_query($conn, "SELECT * FROM menu");
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['price']."</td>";
                echo "<td><img src='../images/".$row['image']."' class='table-img'></td>";
                echo "<td>
                        <a href='edit_menu.php?id=".$row['id']."' class='btn btn-primary btn-sm action-btn'>
                            <i data-lucide='edit-2'></i> Edit
                        </a>
                        <a href='delete_menu.php?id=".$row['id']."' class='btn btn-danger btn-sm action-btn' onclick='return confirm(\"Are you sure you want to delete this item?\")'>
                            <i data-lucide='trash-2'></i> Delete
                        </a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

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