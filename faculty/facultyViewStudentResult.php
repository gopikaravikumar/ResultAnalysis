<?php
session_start();
include "facultyHeader.php";
include "../connection.php";
$eid = $_GET['eid'];
$sid = $_GET['sid'];
$qry = "SELECT * FROM `exams`e, `students`s, `subject`sub, `studentresult`sr WHERE e.`eid`='$eid' AND s.`sid`='$sid'  AND e.`eid`=sr.`eid` AND sr.`sid`=s.`sid` AND sr.`subid`=sub.`subid`";

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
            <h2>Faculty Page</h2>

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
                                    <th>Exam</th>
                                    <th>Student</th>
                                    <th>Subject</th>
                                    <th>Result</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['exam'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['subject'] . "</td>";
                                        echo "<td>" . $row['result'] . "</td>";
                                        if ($row['status'] == "Pending") {
                                            echo "<td><a href='facultyApproveResults.php?srid=$row[srid]&action=Approved&eid=$row[eid]' class='btn btn-primary'>Mark As Verified</a> <a href='facultyEditResults.php?srid=$row[srid]&eid=$row[eid]' class='btn btn-warning'>Edit</a></td>";
                                        } else {
                                            echo "<td>Verified</td>";
                                        }
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='12' style='text-align:center'>No Data Found..</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>


</main>

<?php

include "footer.php"
?>