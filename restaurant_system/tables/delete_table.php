<?php
session_start();
include("../config.php");

if(isset($_GET['id'])){
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM tables WHERE id='$id'");
}

header("Location: view_tables.php");
exit;
?>