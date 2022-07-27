<?php
session_start();
include "adminHeader.php";
include "../connection.php";

$did = $_GET['did'];

$qry = "SELECT * FROM `course` WHERE did='$did'";
$result = mysqli_query($conn, $qry);
?>
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="adminHome.php">Home</a></li>
                <li>Home</li>
            </ol>
            <h2>Admin Page</h2>

        </div>
    </section><!-- End Breadcrumbs -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $qry = "SELECT * FROM `exams` WHERE `cid`='$row[cid]'";
                                $result1 = mysqli_query($conn, $qry);

                        ?>
                                <h2 class="text-center"><?php echo $row['course'] ?></h2>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Exam</th>
                                            <th>Exam Type</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (mysqli_num_rows($result1) > 0) {
                                            while ($rowExm = mysqli_fetch_array($result1)) {
                                                $qryStudCount = "SELECT * FROM `students` WHERE `yearid`='$rowExm[yearid]'";
                                                $resultStudCount = mysqli_query($conn, $qryStudCount);
                                                $studCount = mysqli_num_rows($resultStudCount);

                                                echo "<tr>";
                                                echo "<td>" . $rowExm['exam'] . "</td>";
                                                echo "<td>" . $rowExm['examtype'] . "</td>";
                                                echo "<td><a href='adminAnalyseExam.php?eid=$rowExm[eid]' class='btn btn-primary'>Analyse Exam Result</a></td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "<tr><td colspan='12' style='text-align:center'>No Data Found..</td></tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                        <?php
                            }
                        } else {
                            echo "<h3 class='text-center'>No Data Found..</h3>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>


</main>

<?php

include "footer.php"
?>