<?php
include "adminHeader.php";
include "../connection.php";
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
                <span>Exam</span>
                <h2>Exam</h2>
            </div>

            <div class="row" data-aos="fade-up">


                <div class="col-lg-6" style="margin: auto;">
                    <form action="" method="post">

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
                            <select name="etype" id="" required class="form-control">
                                <option value="" selected disabled>Select Exam Type</option>
                                <option value="Regular">Regular Examiation</option>
                                <option value="Supply">Supplementary Examination</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="exam" placeholder="Name of the Exam" required>
                        </div>
                        <div class="text-center"><button type="submit" class="p-2 mt-3 bg-danger text-light" style="border: none;" name="submit">Submit</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php
    if (isset($_POST['submit'])) {
        $course = $_POST['course'];
        $year = $_POST['year'];
        $sem = $_POST['sem'];
        $exam = $_POST['exam'];
        $etype = $_POST['etype'];
        $qryCheck = "SELECT * FROM `exams` WHERE `cid`='$course' AND `yearid`='$year' AND `sem`='$sem' AND `exam`='$exam'";
        $resultCheck = mysqli_query($conn, $qryCheck);
        if (mysqli_num_rows($resultCheck) > 0) {
            echo "<script>alert('Exam already exists');</script>";
        } else {
            $qry = "INSERT INTO `exams`(`cid`, `yearid`, `sem`, `exam`,`date`,`examtype`) VALUES ('$course','$year','$sem','$exam',(SELECT SYSDATE()),'$etype')";
            $result = mysqli_query($conn, $qry);
            if ($result) {
                echo "<script>alert('Exam Added Successfully');</script>";
            } else {
                echo "<script>alert('Error');</script>";
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
                                    <th>Posted Date</th>
                                    <th>Academic Year</th>
                                    <th>Course</th>
                                    <th>Semester</th>
                                    <th>Exam Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $qryExam = "SELECT * FROM `exams` e, `course`c, `acayear`a WHERE e.`cid`=c.`cid` AND e.`yearid`=a.`yearid`";
                                $resultExam = mysqli_query($conn, $qryExam);
                                if (mysqli_num_rows($resultExam) > 0) {
                                    while ($rowExam = mysqli_fetch_assoc($resultExam)) {

                                        echo "<tr>";
                                        echo "<td>" . $rowExam['date'] . "</td>";
                                        echo "<td>" . $rowExam['year'] . "</td>";
                                        echo "<td>" . $rowExam['course'] . "</td>";
                                        echo "<td>" . $rowExam['sem'] . "</td>";
                                        echo "<td>" . $rowExam['examtype'] . "</td>";
                                        echo "<td><a href='adminExamDelete.php?delete=" . $rowExam['eid'] . "' class='btn btn-danger'>Delete</a></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>No Data Found</td></tr>";
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