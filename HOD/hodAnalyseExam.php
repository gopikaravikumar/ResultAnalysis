<?php
session_start();
include "hodHeader.php";
include "../connection.php";

$eid = $_GET['eid'];

$qry = "SELECT DISTINCT(sr.subid), su.`subject`, sr.examtype  FROM `studentresult`sr, `subject`su, `exams`e WHERE sr.`eid`='$eid' AND sr.`subid`=su.`subid` AND sr.`eid`=e.`eid` AND e.`sem`=su.`sem`";
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
            <h2>HOD Page</h2>

        </div>
    </section><!-- End Breadcrumbs -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Subject</th>
                                    <th>Total Students</th>
                                    <th>Passed</th>
                                    <th>Failed</th>
                                    <th>Analysis</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $overallPass = 0;
                                $subs = array();
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $qryTotStu = "SELECT COUNT(sid) FROM `studentresult` WHERE `examtype`='$row[examtype]' AND `status`='Approved' AND `subid`='$row[subid]'";
                                    $resultTotStu = mysqli_query($conn, $qryTotStu);
                                    $rowTotStu = mysqli_fetch_array($resultTotStu);
                                    $totStu = $rowTotStu[0];
                                    $qryFullPass = "SELECT COUNT(sid) FROM `studentresult` WHERE `examtype`='$row[examtype]' AND `result`='Pass'  AND `status`='Approved' AND `subid`='$row[subid]'";
                                    $resultFullPass = mysqli_query($conn, $qryFullPass);
                                    $rowFullPass = mysqli_fetch_array($resultFullPass);
                                    $fullPass = $rowFullPass[0];
                                    $qrySuply = "SELECT COUNT(sid) FROM `studentresult` WHERE `examtype`='$row[examtype]' AND `result`='Fail'  AND `status`='Approved' AND `subid`='$row[subid]'";
                                    $resultSuply = mysqli_query($conn, $qrySuply);
                                    $rowSuply = mysqli_fetch_array($resultSuply);
                                    $suply = $rowSuply[0];


                                ?>
                                    <tr>
                                        <td><?php echo $row['subject'] ?></td>
                                        <td><?php echo $totStu ?></td>
                                        <td><?php echo $fullPass ?></td>
                                        <td><?php echo $suply ?></td>
                                        <td><?php
                                            $res = ($fullPass / $totStu) * 100;
                                            echo "$res%";
                                            if ($res == 100) {
                                                array_push($subs, $row['subject']);
                                            }
                                            ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <div class="text-center mt-5">
                            <h3 class='mb-3'>Subjects With Full Pass Students</h3>
                            <?php
                            $arrlength = count($subs);

                            for ($x = 0; $x < $arrlength; $x++) {
                                echo "<h5>$subs[$x]</h5>";
                            }

                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


</main>

<?php

include "footer.php"
?>