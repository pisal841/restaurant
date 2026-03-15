<?php
session_start();
include("../config.php");

if(!isset($_GET['id'])){
    header("Location: view_menu.php");
    exit;
}

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM menu WHERE id='$id'");
$row = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){
    $name = $_POST['name'];
    $price = $_POST['price'];

    // Upload new image if selected
    if($_FILES['image']['name'] != ""){
        $image = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp_name, "../images/".$image);
        mysqli_query($conn, "UPDATE menu SET name='$name', price='$price', image='$image' WHERE id='$id'");
    } else {
        mysqli_query($conn, "UPDATE menu SET name='$name', price='$price' WHERE id='$id'");
    }

    header("Location: view_menu.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Food - Restaurant System</title>
</head>
<body>

<h2>Edit Food</h2>

<form method="POST" action="" enctype="multipart/form-data">
    Name: <input type="text" name="name" value="<?php echo $row['name']; ?>" required><br><br>
    Price: <input type="number" step="0.01" name="price" value="<?php echo $row['price']; ?>" required><br><br>
    Current Image: <img src="../images/<?php echo $row['image']; ?>" width="50"><br><br>
    New Image: <input type="file" name="image"><br><br>
    <button type="submit" name="update">Update Food</button>
</form>

<br>
<a href="view_menu.php">Back to Menu</a>

</body>
</html>