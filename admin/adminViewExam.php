<?php
session_start();
include "adminHeader.php";
include "../connection.php";

$qryDept = "SELECT * FROM `department`";
$resultDept = mysqli_query($conn, $qryDept);


?>
<style>
    .box {
        width: 20rem;
        height: 18rem;
        padding: 40px;
        text-align: center;
        margin: auto;
    }
    .forDept{
        display: flex;
        flex-wrap: wrap;

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
        <div class="container forDept">
            <?php
            while ($rowDept = mysqli_fetch_assoc($resultDept)) {
            ?>

                <div class="box bg-warning mt-1">
                    <h2>Subject Wise Result Analysis</h2>
                    <h5>Of <?php echo $rowDept['department'] ?> Department</h5>
                    <a href="adminAnalyseResult.php?did=<?php echo  $rowDept['did']; ?>" class='btn btn-primary mt-4'>Analysis</a>
                </div>
            <?php
            }
            ?>
        </div>
    </section>


</main>

<?php

include "footer.php"
?>