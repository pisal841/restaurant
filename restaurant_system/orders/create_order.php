<?php
session_start();
include("../config.php");

if(isset($_POST['create'])){
    $table_number = $_POST['table_number'];
    $food_ids = $_POST['food'];
    $quantities = $_POST['quantity'];

    $total = 0;
    foreach($food_ids as $index => $food_id){
        $qty = $quantities[$index];
        $food = mysqli_fetch_assoc(mysqli_query($conn, "SELECT price FROM menu WHERE id='$food_id'"));
        $total += $food['price'] * $qty;
    }

    mysqli_query($conn, "INSERT INTO orders (table_number, total, status) VALUES ('$table_number','$total','Pending')");
    header("Location: order_list.php");
    exit;
}

// Get tables and menu
$tables = mysqli_query($conn, "SELECT * FROM tables WHERE status='Available'");
$menu = mysqli_query($conn, "SELECT * FROM menu");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Order - Restaurant System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Lucide Icons -->
    <link href="https://cdn.jsdelivr.net/npm/lucide@0.276.0/dist/lucide.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
        }
        .food-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #fff;
        }
        .food-card img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
        }
        .quantity-input {
            width: 60px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2 class="mb-4">📝 Create New Order</h2>

    <form method="POST" action="">
        <div class="mb-3">
            <label for="table_number" class="form-label">Table Number</label>
            <select name="table_number" id="table_number" class="form-select" required>
                <?php while($table = mysqli_fetch_assoc($tables)){ ?>
                    <option value="<?php echo $table['table_number']; ?>"><?php echo $table['table_number']; ?></option>
                <?php } ?>
            </select>
        </div>

        <h4 class="mb-3">Select Food</h4>
        <div class="row">
            <?php while($food = mysqli_fetch_assoc($menu)){ ?>
                <div class="col-md-4">
                    <div class="food-card d-flex align-items-center">
                        <img src="../images/<?php echo $food['image']; ?>" alt="<?php echo $food['name']; ?>" class="me-3">
                        <div>
                            <div><strong><?php echo $food['name']; ?></strong></div>
                            <div>$<?php echo $food['price']; ?></div>
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="food[]" value="<?php echo $food['id']; ?>" id="food_<?php echo $food['id']; ?>">
                                <label class="form-check-label" for="food_<?php echo $food['id']; ?>">Select</label>
                            </div>
                            Quantity: <input type="number" name="quantity[]" value="1" min="1" class="form-control quantity-input mt-1">
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <button type="submit" name="create" class="btn btn-success mt-3">
            <i data-lucide="check-circle"></i> Create Order
        </button>
        <a href="order_list.php" class="btn btn-secondary mt-3">
            <i data-lucide="arrow-left"></i> Back to Orders
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