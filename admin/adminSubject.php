<?php
include "adminHeader.php";
include "../connection.php";
$qryDepartment = "SELECT * FROM `department`";
$resultDepartment = mysqli_query($conn, $qryDepartment);
$qryCourse = "SELECT * FROM `course`";
$resultCourse = mysqli_query($conn, $qryCourse);
$qryYear = "SELECT * FROM `acayear`";
$resultYear = mysqli_query($conn, $qryYear);
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

            <div class="section-title">
                <span>Subject</span>
                <h2>Subject</h2>
            </div>

            <div class="row" data-aos="fade-up">


                <div class="col-lg-6" style="margin: auto;">
                    <form action="" method="post">
                        <div class="form-group mt-3">
                            <select name="dept" id="" required class="form-control">
                                <option value="" selected disabled>Select Department</option>
                                <?php
                                while ($rowDepartment = mysqli_fetch_assoc($resultDepartment)) {
                                    echo "<option value='" . $rowDepartment['did'] . "'>" . $rowDepartment['department'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <select name="course" id="" required class="form-control">
                                <option value="" selected disabled>Select Course</option>
                                <?php
                                while ($rowCourse = mysqli_fetch_assoc($resultCourse)) {
                                    echo "<option value='" . $rowCourse['cid'] . "'>" . $rowCourse['course'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <select name="year" id="" required class="form-control">
                                <option value="" selected disabled>Select Academic Year</option>
                                <?php
                                while ($rowYear = mysqli_fetch_assoc($resultYear)) {
                                    echo "<option value='" . $rowYear['yearid'] . "'>" . $rowYear['year'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <select name="sem" id="" required class="form-control">
                                <option value="" selected disabled>Select Semester</option>
                                <option value="1st">1st</option>
                                <option value="2nd">2nd</option>
                                <option value="3rd">3rd</option>
                                <option value="4th">4th</option>
                                <option value="5th">5th</option>
                                <option value="6th">6th</option>
                                <option value="7th">7th</option>
                                <option value="8th">8th</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                        </div>
                        <div class="text-center"><button type="submit" class="p-2 mt-3 bg-danger text-light" style="border: none;" name="submit">Submit</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php
    if (isset($_POST['submit'])) {
        $dept = $_POST['dept'];
        $course = $_POST['course'];
        $year = $_POST['year'];
        $subject = $_POST['subject'];
        $sem = $_POST['sem'];
        $qryCheck = "SELECT * FROM `subject` WHERE `did` = '$dept' AND `cid` = '$course' AND `yearid` = '$year' AND `subject` = '$subject'";
        $resultCheck = mysqli_query($conn, $qryCheck);
        if (mysqli_num_rows($resultCheck) > 0) {
            echo "<script>alert('Subject already exists');</script>";
        } else {
            $qry = "INSERT INTO `subject`(`did`, `cid`, `yearid`, `subject`,`sem`) VALUES ('$dept','$course','$year','$subject','$sem')";
            $result = mysqli_query($conn, $qry);
            if ($result) {
                echo "<script>alert('Subject Added Successfully');</script>";
            } else {
                echo "<script>alert('Subject Not Added');</script>";
            }
        }
    }
    ?>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Academic Year</th>
                                    <th>Department</th>
                                    <th>Course</th>
                                    <th>Semester</th>
                                    <th>Subject</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $qrySub = "SELECT * FROM `acayear` a,`course` c,`department` d,`subject` s WHERE s.`did`=d.`did` AND s.`cid`=c.`cid` AND s.`yearid`=a.`yearid`";
                                $resultSub = mysqli_query($conn, $qrySub);
                                if (mysqli_num_rows($resultSub) > 0) {

                                    while ($rowSub = mysqli_fetch_assoc($resultSub)) {

                                        echo "<tr>";
                                        echo "<td>" . $rowSub['year'] . "</td>";
                                        echo "<td>" . $rowSub['department'] . "</td>";
                                        echo "<td>" . $rowSub['course'] . "</td>";
                                        echo "<td>" . $rowSub['sem'] . "</td>";
                                        echo "<td>" . $rowSub['subject'] . "</td>";
                                        echo "<td><a href='adminSubjectDelete.php?delete=" . $rowSub['subid'] . "' class='btn btn-danger'>Delete</a></td>";
                                        echo "</tr>";
                                    }
                                }else{
                                    echo "<tr><td colspan='6' class='text-center'>No Subject Found</td></tr>";
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