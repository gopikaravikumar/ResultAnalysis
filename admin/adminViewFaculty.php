<?php
include "../connection.php";



$qryFaculty = "SELECT * FROM `login`l, `faculty`f, `department`d WHERE l.`status`='Active' AND (l.`utype`='faculty' OR l.`utype`='HOD') AND l.`uid`=f.`fid` AND f.`did`=d.`did` ";
$resultFaculty = mysqli_query($conn, $qryFaculty);

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
                                        $qryCA = "SELECT * FROM `classadvisor` WHERE `fid`='$row[uid]'";
                                        $resultCA = mysqli_query($conn, $qryCA);
                                        $rowCA = mysqli_fetch_assoc($resultCA);
                                        $countCA = mysqli_num_rows($resultCA);
                                        echo "<tr>";
                                        echo "<td>" . $row['department'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['email'] . "</td>";
                                        echo "<td>" . $row['phone'] . "</td>";
                                        echo "<td>" . $row['address'] . "</td>";
                                        echo "<td>" . $row['qual'] . "</td>";
                                        if ($countCA > 0) {
                                            echo "<td>Advisor</td>";
                                        } else {

                                            echo "<td>" . $row['ftype'] . "</td>";
                                        }

                                        echo "<td><a href='adminRejectUsers.php?uid=$row[uid]&utype=$row[utype]&action=Rejected&url=adminViewFaculty.php' class='btn btn-danger'>Reject</a></td>";
                                        if ($countCA <= 0 && strtolower($row['ftype']) == 'faculty') {
                                            echo "<td><a href='adminAssignClass.php?uid=$row[uid]&dept=$row[did]' class='btn btn-info'>Assign Class</a></td>";
                                        } else {
                                            echo "<td></td>";
                                        }
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
</main>

<?php

include "footer.php"
?>