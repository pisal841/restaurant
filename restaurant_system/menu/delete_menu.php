<?php
session_start();
include("../config.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];

    // Delete image file first
    $result = mysqli_query($conn, "SELECT image FROM menu WHERE id='$id'");
    $row = mysqli_fetch_assoc($result);
    if(file_exists("../images/".$row['image'])){
        unlink("../images/".$row['image']);
    }

    // Delete from database
    mysqli_query($conn, "DELETE FROM menu WHERE id='$id'");
}

header("Location: view_menu.php");
exit;
?>