<?php
include "../connection.php";



$qryStudent = "SELECT * FROM `login`l,`students`s, `department`d,`course`c, `acayear`a WHERE l.`status`='Active' AND l.`utype`='student' AND l.`uid`=s.`sid` AND s.`did`=d.`did` AND s.`cid`=c.`cid` AND s.`yearid`=a.`yearid`";
$resultStudent = mysqli_query($conn, $qryStudent);

include "adminHeader.php";
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


    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Admission No.</th>
                                    <th>Academic Year</th>
                                    <th>Department</th>
                                    <th>Course</th>
                                    <th>Semester</th>
                                    <th>Student</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($resultStudent) > 0) {
                                    while ($row = mysqli_fetch_assoc($resultStudent)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['admno'] . "</td>";
                                        echo "<td>" . $row['year'] . "</td>";
                                        echo "<td>" . $row['department'] . "</td>";
                                        echo "<td>" . $row['course'] . "</td>";
                                        echo "<td>" . $row['sem'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['phone'] . "</td>";
                                        echo "<td>" . $row['address'] . "</td>";
                                        echo "<td><a href='adminRejectUsers.php?uid=$row[sid]&utype=$row[utype]&action=Rejected&url=adminViewStudents.php' class='btn btn-danger'>Reject</a></td>";
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