<?php
session_start();
include "studentHeader.php";
include "../connection.php";
$qry = "SELECT e.*, c.`course`, a.`year`, s.`sid` FROM `exams`e, `students`s, `course`c,`acayear`a WHERE s.`sid`='$_SESSION[uid]' AND e.`yearid`=s.`yearid` AND s.`cid`=e.`cid` AND e.`cid`=c.`cid` AND e.`yearid`=a.`yearid` ORDER BY e.`eid` DESC";
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
            <h2>Student Page</h2>

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
                                    <th>Posted Date</th>
                                    <th>Exam</th>
                                    <th>Academic Year</th>
                                    <th>Course</th>
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
                                        echo "<td>" . $row['date'] . "</td>";
                                        echo "<td>" . $row['exam'] . "</td>";
                                        echo "<td>" . $row['year'] . "</td>";
                                        echo "<td>" . $row['course'] . "</td>";
                                        echo "<td>" . $row['sem'] . "</td>";
                                        echo "<td>" . $row['examtype'] . "</td>";

                                        echo "<td><a href='studentAddMark.php?eid=$row[eid]&cid=$row[cid]&sem=$row[sem]&yearid=$row[yearid]&etype=$row[examtype]' class='btn btn-primary'>Add Result</a></td>";
                                        echo "<td><a href='studentViewResult.php?eid=$row[eid]&sid=$row[sid]' class='btn btn-info'>View Result</a></td>";
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