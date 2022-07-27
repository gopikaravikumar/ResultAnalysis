<?php
include "../connection.php";
$id = $_GET['delete'];
$sql = "DELETE FROM `acayear` WHERE yearid = '$id'";
$result = mysqli_query($conn, $sql);
if ($result) {
    echo "<script>window.alert('Year Deleted..')</script>";
    header("Location: adminYear.php");
} else {
    echo "<script>window.alert('Error Occured..')</script>";
}
