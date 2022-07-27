<?php
include "../connection.php";
$id = $_GET['delete'];
$sql = "DELETE FROM `subject` WHERE subid = '$id'";
$result = mysqli_query($conn, $sql);
if ($result) {
    echo "<script>window.alert('Subject Deleted..')</script>";
    header("Location: adminSubject.php");
} else {
    echo "<script>window.alert('Error Occured..')</script>";
}