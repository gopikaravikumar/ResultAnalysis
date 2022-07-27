<?php
include "../connection.php";
$utype = $_GET['utype'];
$uid = $_GET['uid'];
$action = $_GET['action'];
$qry = "UPDATE `login` SET `status`='$action' WHERE `uid`='$uid' AND `utype`='$utype'";
echo $qry;
$result = mysqli_query($conn, $qry);
if ($result) {
    if ($utype == 'HOD' && $action == 'Active') {
        $dept = $_GET['dept'];
        $qry = "UPDATE `department` SET `fid`='$uid' WHERE`did`='$dept'";
        $result = mysqli_query($conn, $qry);
        $utype = 'Faculty';
    }
    if ($utype == 'Principal') {
        $utype = 'Faculty';
    }
    echo "<script>alert('User Status Updated Successfully');</script>";
    header('location:adminViewRequest.php?uType=' . ucfirst($utype));
} else {
    echo "<script>alert('Error Occured');</script>";
    header('location:adminViewRequest.php?uType=' . ucfirst($utype));
}
