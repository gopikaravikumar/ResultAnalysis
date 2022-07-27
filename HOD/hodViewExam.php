<?php
session_start();
include "hodHeader.php";
include "../connection.php";
$qry = "SELECT * FROM faculty where `fid` = '$_SESSION[uid]'";
$result = mysqli_query($conn, $qry);
$row = mysqli_fetch_assoc($result);
$did = $row['did'];
$qryDept = "SELECT * FROM `department` WHERE `did`='$did'";
$resultDept = mysqli_query($conn, $qryDept);
$rowDept = mysqli_fetch_assoc($resultDept);
$dept = $rowDept['department'];

?>
<style>
    .box {
        width: 20rem;
        height: 18rem;
        padding: 40px;
        text-align: center;
        margin: auto;
    }
</style>
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="adminHome.php">Home</a></li>
                <li>Home</li>
            </ol>
            <!-- <h2>HOD Page</h2> -->

        </div>
    </section><!-- End Breadcrumbs -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="box bg-warning">
                <h2>Subject Wise Result Analysis</h2>
                <h5>Of <?php echo $dept ?> Department</h5>
                <a href="hodAnalyseResult.php?did=<?php echo  $did; ?>" class='btn btn-primary mt-4'>Analysis</a>
            </div>
        </div>
    </section>


</main>

<?php

include "footer.php"
?>