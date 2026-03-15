<?php
session_start();
include("../config.php");

if(!isset($_GET['id'])){
    header("Location: view_tables.php");
    exit;
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM tables WHERE id='$id'");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){
    $table_number = $_POST['table_number'];
    $status = $_POST['status'];

    mysqli_query($conn, "UPDATE tables SET table_number='$table_number', status='$status' WHERE id='$id'");
    header("Location: view_tables.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Table - Restaurant System</title>
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
    <h3 class="mb-4">✏️ Edit Table #<?php echo $row['id']; ?></h3>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="table_number" class="form-label">Table Number</label>
            <input type="number" name="table_number" id="table_number" class="form-control" value="<?php echo $row['table_number']; ?>" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="Available" <?php if($row['status']=='Available') echo 'selected'; ?>>Available</option>
                <option value="Occupied" <?php if($row['status']=='Occupied') echo 'selected'; ?>>Occupied</option>
            </select>
        </div>

        <button type="submit" name="update" class="btn btn-primary">
            <i data-lucide="save"></i> Update Table
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