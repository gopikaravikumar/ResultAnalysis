<?php
include "../connection.php";
$id = $_GET['delete'];
$sql = "DELETE FROM `course` WHERE cid = '$id'";
$result = mysqli_query($conn, $sql);
if ($result) {
    echo "<script>window.alert('Course Deleted..')</script>";
    header("Location: adminCourse.php");
} else {
    echo "<script>window.alert('Error Occured..')</script>";
}