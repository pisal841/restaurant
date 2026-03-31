<?php
session_start();
include __DIR__ . ("../config.php");

if(!isset($_SESSION['username'])){
    header("Location: ../login.php");
    exit;
}

$result = mysqli_query($conn, "SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Users - Restaurant System</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
<div class="header">
    <h1><i class="fas fa-users"></i> Users Management</h1>
</div>
<div class="nav">
    <a href="../dashboard.php"><i class="fas fa-home"></i> Dashboard</a>
    <a href="add_user.php"><i class="fas fa-user-plus"></i> Add User</a>
    <a href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
</div>
<div class="container">
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['username']; ?></td>
            <td><?php echo $row['role']; ?></td>
            <td>
                <a href="add_user.php?id=<?php echo $row['id']; ?>"><i class="fas fa-edit"></i></a>
                <a href="add_user.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this user?')"><i class="fas fa-trash-alt"></i></a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>