<?php

include "../connection.php";
$uid = $_POST['uid'];
$utype = $_POST['utype'];
$action = $_POST['action'];
$url = $_POST['url'];

$qry = "UPDATE `login` SET `status`='$action' WHERE `uid`='$uid' AND `utype`='$utype'";
$result = mysqli_query($conn, $qry);
if ($result) {
    echo "<script>alert('User Rejected')</script>";
    header("location:$url");
}
