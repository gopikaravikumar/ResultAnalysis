<?php
session_start();
include "facultyHeader.php";
include "../connection.php";
$eid = $_GET['eid'];
$qry = "SELECT * FROM `exams`e, `students`s WHERE e.`eid`='$eid' AND e.`yearid`=s.`yearid` AND e.`sem`=s.`sem` AND e.`cid`=s.`cid`";
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
                                    <th>Admission No.</th>
                                    <th>Student</th>
                                    <th>Semester</th>
                                    <th>Exam Type</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['admno'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['sem'] . "</td>";
                                        echo "<td>" . $row['examtype'] . "</td>";

                                        echo "<td><a href='facultyAddStudentMark.php?eid=$row[eid]&cid=$row[cid]&sem=$row[sem]&yearid=$row[yearid]&etype=$row[examtype]&sid=$row[sid]' class='btn btn-primary'>Add Mark</a></td>";
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