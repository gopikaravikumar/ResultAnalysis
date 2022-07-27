<?php
include "../connection.php";
$id = $_GET['delete'];
$sql = "DELETE FROM `exams` WHERE eid = '$id'";
$result = mysqli_query($conn, $sql);
if ($result) {
    echo "<script>window.alert('Exam Deleted..')</script>";
    header("Location: adminExam.php");
} else {
    echo "<script>window.alert('Error Occured..')</script>";
}
