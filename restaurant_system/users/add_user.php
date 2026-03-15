<?php
session_start();
include("../includes/config.php");

if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit;
}

// Add or Edit
if(isset($_POST['save'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if(isset($_GET['id'])) {
        $id = $_GET['id'];
        mysqli_query($conn, "UPDATE users SET username='$username', password='$password', role='$role' WHERE id='$id'");
    } else {
        mysqli_query($conn, "INSERT INTO users (username,password,role) VALUES ('$username','$password','$role')");
    }
    header("Location: user_list.php");
    exit;
}

// Delete
if(isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];
    mysqli_query($conn, "DELETE FROM users WHERE id='$id'");
    header("Location: user_list.php");
    exit;
}

// Fetch for edit
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id='$id'"));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo isset($user) ? "Edit" : "Add"; ?> User</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="header">
    <h1><i class="fas fa-user-plus"></i> <?php echo isset($user) ? "Edit" : "Add"; ?> User</h1>
</div>
<div class="container">
    <form method="POST">
        Username: <input type="text" name="username" value="<?php echo isset($user)?$user['username']:'';?>" required><br><br>
        Password: <input type="password" name="password" value="<?php echo isset($user)?$user['password']:'';?>" required><br><br>
        Role: 
        <select name="role" required>
            <option value="admin" <?php echo (isset($user) && $user['role']=='admin')?'selected':'';?>>Admin</option>
            <option value="staff" <?php echo (isset($user) && $user['role']=='staff')?'selected':'';?>>Staff</option>
        </select><br><br>
        <button type="submit" name="save"><i class="fas fa-save"></i> Save</button>
    </form>
</div>
</body>
</html>