<?php
include "../connection.php";
$uType = $_GET['uType'];
if ($uType == "Faculty") {
    $qryFaculty = "SELECT * FROM `login`l, `faculty`f, `department`d WHERE l.`status`='Inactive' AND (l.`utype`='faculty' OR l.`utype`='HOD') AND l.`uid`=f.`fid` AND f.`did`=d.`did` ";
    $resultFaculty = mysqli_query($conn, $qryFaculty);
} else if ($uType == "Student") {
    $qryStudent = "SELECT * FROM `login`l,`students`s, `department`d,`course`c, `acayear`a WHERE l.`status`='Inactive' AND l.`utype`='student' AND l.`uid`=s.`sid` AND s.`did`=d.`did` AND s.`cid`=c.`cid` AND s.`yearid`=a.`yearid`";
    $resultStudent = mysqli_query($conn, $qryStudent);
}
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

    <?php

    if ($uType == 'Student') {
    ?>
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
                                            echo "<td><a href='adminApproveUsers.php?uid=$row[sid]&utype=$row[utype]&action=Active' class='btn btn-success'>Approve</a></td>";
                                            echo "<td><a href='adminApproveUsers.php?uid=$row[sid]&utype=$row[utype]&action=Rejected' class='btn btn-danger'>Reject</a></td>";
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
    <?php
    }
    if ($uType == 'Faculty') {
    ?>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Department</th>
                                        <th>Faculty</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Qualification</th>
                                        <th>Position</th>
                                        <th colspan="2">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (mysqli_num_rows($resultFaculty) > 0) {
                                        while ($row = mysqli_fetch_assoc($resultFaculty)) {
                                            echo "<tr>";
                                            echo "<td>" . $row['department'] . "</td>";
                                            echo "<td>" . $row['name'] . "</td>";
                                            echo "<td>" . $row['email'] . "</td>";
                                            echo "<td>" . $row['phone'] . "</td>";
                                            echo "<td>" . $row['address'] . "</td>";
                                            echo "<td>" . $row['qual'] . "</td>";
                                            echo "<td>" . $row['ftype'] . "</td>";
                                            echo "<td><a href='adminApproveUsers.php?uid=$row[uid]&utype=$row[utype]&action=Active&dept=$row[did]' class='btn btn-success'>Approve</a></td>";
                                            echo "<td><a href='adminApproveUsers.php?uid=$row[uid]&utype=$row[utype]&action=Rejected' class='btn btn-danger'>Reject</a></td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='8' style='text-align:center'>No Data Found..</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php
    }
    ?>



</main>

<?php

include "footer.php"
?>