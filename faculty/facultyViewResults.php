<?php
session_start();
include "facultyHeader.php";
include "../connection.php";
$eid = $_GET['eid'];
// $qry = "SELECT * FROM `exams`e, `students`s, `subject`sub, `studentresult`sr WHERE e.`eid`='$eid'  AND e.`eid`=sr.`eid` AND sr.`sid`=s.`sid` AND sr.`subid`=sub.`subid`";
$qry = "SELECT DISTINCT(s.`admno`), s.`sid`, e.`exam` FROM `exams`e, `students`s, `subject`sub, `studentresult`sr WHERE e.`eid`='$eid'  AND e.`eid`=sr.`eid` AND sr.`sid`=s.`sid` AND sr.`subid`=sub.`subid`";
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
                                    <th>Student Admission No.</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['exam'] . "</td>";
                                        echo "<td>" . $row['admno'] . "</td>";
                                        echo "<td><a href='facultyViewStudentResult.php?sid=$row[sid]&eid=$eid' class='btn btn-primary'>View Results</a></td>";
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