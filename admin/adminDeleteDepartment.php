<?php
include "../connection.php";
$id = $_GET['delete'];
$sql = "DELETE FROM `department` WHERE did = '$id'";
$result = mysqli_query($conn, $sql);
if ($result) {
    echo "<script>window.alert('Department Deleted..')</script>";
    header("Location: adminDepartment.php");
} else {
    echo "<script>window.alert('Error Occured..')</script>";
}
