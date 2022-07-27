<?php
session_start();
include "facultyHeader.php";
include "../connection.php";
// $qry = "SELECT e.*, c.`course`,a.* FROM `exams`e, `classadvisor`ca, `course`c, `acayear`a WHERE ca.`fid`='$_SESSION[uid]' AND ca.`yearid`=e.`yearid` AND e.`cid`=c.`cid` AND e.`yearid`=a.`yearid`";
$qry = "SELECT e.*, c.`course`,a.* FROM `exams`e, `course`c, `acayear`a WHERE  e.`cid`=c.`cid` AND e.`yearid`=a.`yearid`";
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

                                        echo "<td><a href='facultyViewResults.php?eid=$row[eid]' class='btn btn-primary'>View Result</a></td>";
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