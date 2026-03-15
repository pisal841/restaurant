<?php
session_start();
include("../config.php");

if(isset($_POST['add'])){
    $table_number = $_POST['table_number'];
    $status = $_POST['status'];

    mysqli_query($conn, "INSERT INTO tables (table_number, status) VALUES ('$table_number','$status')");
    header("Location: view_tables.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Table - Restaurant System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Lucide Icons -->
    <link href="https://cdn.jsdelivr.net/npm/lucide@0.276.0/dist/lucide.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .form-card {
            max-width: 400px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

<div class="form-card">
    <h3 class="mb-4">🪑 Add New Table</h3>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="table_number" class="form-label">Table Number</label>
            <input type="number" name="table_number" id="table_number" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="Available">Available</option>
                <option value="Occupied">Occupied</option>
            </select>
        </div>

        <button type="submit" name="add" class="btn btn-success">
            <i data-lucide="plus-circle"></i> Add Table
        </button>
        <a href="view_tables.php" class="btn btn-secondary">
            <i data-lucide="arrow-left"></i> Back to Tables
        </a>
    </form>
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