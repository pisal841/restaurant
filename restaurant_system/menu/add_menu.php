<?php
session_start();
include("../config.php");

if(isset($_POST['add'])){
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Upload image
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    move_uploaded_file($tmp_name, "../images/".$image);

    // Insert into database
    mysqli_query($conn, "INSERT INTO menu (name, price, image) VALUES ('$name','$price','$image')");
    header("Location: view_menu.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Food - Restaurant System</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            max-width: 480px;
            background: #fff;
            border-radius: 16px;
            padding: 35px 30px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
        }

        h2 {
            text-align: center;
            color: #ff6b6b;
            font-weight: 600;
            margin-bottom: 25px;
            position: relative;
        }

        h2 i {
            font-size: 1.5rem;
            margin-right: 8px;
            color: #ff4c4c;
        }

        .form-label i {
            color: #ff6b6b;
            margin-right: 6px;
        }

        .form-control {
            border-radius: 12px;
            padding: 10px 15px;
            transition: 0.3s;
        }
        .form-control:focus {
            border-color: #ff6b6b;
            box-shadow: 0 0 5px rgba(255,107,107,0.5);
        }

        .custom-file-upload {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 10px;
            border-radius: 12px;
            border: 2px dashed #ff6b6b;
            cursor: pointer;
            transition: background 0.3s, border-color 0.3s;
            text-align: center;
            color: #ff6b6b;
            font-weight: 500;
        }
        .custom-file-upload:hover {
            background: #ffeded;
            border-color: #ff4c4c;
        }
        .custom-file-upload input {
            display: none;
        }

        .img-preview {
            width: 100%;
            max-height: 220px;
            object-fit: cover;
            margin-top: 15px;
            border-radius: 12px;
            display: none;
            transition: transform 0.3s ease;
        }
        .img-preview.show {
            display: block;
            transform: scale(1.05);
        }

        .btn-primary {
            background: #ff6b6b;
            border: none;
            border-radius: 12px;
            padding: 10px 0;
            font-weight: 500;
            transition: background 0.3s, transform 0.2s;
        }
        .btn-primary:hover {
            background: #ff4c4c;
            transform: translateY(-2px);
        }

        a {
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
            font-weight: 500;
            color: #555;
        }
        .back-link i {
            margin-right: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2><i class="bi bi-plus-circle"></i> Add New Food</h2>

    <form method="POST" action="" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label"><i class="bi bi-card-text"></i> Food Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter food name" required>
        </div>
        <div class="mb-3">
            <label class="form-label"><i class="bi bi-currency-dollar"></i> Price</label>
            <input type="number" step="0.01" class="form-control" name="price" placeholder="Enter price" required>
        </div>
        <div class="mb-3">
            <label class="form-label"><i class="bi bi-image"></i> Upload Image</label>
            <label class="custom-file-upload">
                <i class="bi bi-upload"></i> Choose File
                <input type="file" name="image" accept="image/*" onchange="previewImage(event)" required>
            </label>
            <img id="imagePreview" class="img-preview">
        </div>
        <button type="submit" name="add" class="btn btn-primary w-100"><i class="bi bi-plus-lg"></i> Add Food</button>
    </form>

    <div class="back-link">
        <a href="view_menu.php"><i class="bi bi-arrow-left"></i> Back to Menu</a>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<script>
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('imagePreview');
        output.src = reader.result;
        output.classList.add('show');
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>

</body>
</html>