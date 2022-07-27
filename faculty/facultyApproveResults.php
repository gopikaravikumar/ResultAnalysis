<?php

include "../connection.php";
$srid = $_GET['srid'];
$action = $_GET['action'];
$eid = $_GET['eid'];
$qry = "UPDATE `studentresult` SET `status`='$action' WHERE `srid`='$srid'";
$result = mysqli_query($conn, $qry);
if ($result) {
    echo "<script>alert('Result Verified Successfully..');</script>";
    echo "<script>window.location.href='facultyViewResults.php?eid=$eid';</script>";
} else {
    echo "<script>alert('Error Occured..');</script>";
    echo "<script>window.location.href='facultyViewResults.php?eid=$eid';</script>";
}
