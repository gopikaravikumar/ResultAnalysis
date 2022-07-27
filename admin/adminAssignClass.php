<?php
include "adminHeader.php";
include "../connection.php";
$uid = $_GET['uid'];
$dept = $_GET['dept'];
$qryDepartment = "SELECT * FROM `course` WHERE `did`='$dept'";
$resultDepartment = mysqli_query($conn, $qryDepartment);
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
                <span>Course</span>
                <h2>Course</h2>
            </div>

            <div class="row" data-aos="fade-up">


                <div class="col-lg-6" style="margin: auto;">
                    <form action="" method="post">
                        <div class="form-group mt-3">
                            <select name="course" id="" required class="form-control">
                                <option value="" selected disabled>Select Course</option>
                                <?php
                                while ($rowDepartment = mysqli_fetch_assoc($resultDepartment)) {
                                    echo "<option value='" . $rowDepartment['cid'] . "'>" . $rowDepartment['course'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <select name="year" id="" required class="form-control">
                                <option value="" selected disabled>Select Academic Year</option>
                                <?php
                                while ($rowYeat = mysqli_fetch_assoc($resultYear)) {
                                    echo "<option value='" . $rowYeat['yearid'] . "'>" . $rowYeat['year'] . "</option>";
                                }
                                ?>
                            </select>
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
        $qryCheck = "SELECT * FROM `classadvisor` WHERE `yearid`='$year' AND `cid`='$course'";
        $resultCheck = mysqli_query($conn, $qryCheck);
        if (mysqli_num_rows($resultCheck) > 0) {
            $qryUp = "UPDATE `classadvisor` SET `fid`='$uid' WHERE `yearid`='$year' AND `cid`='$course'";
            $resultUp = mysqli_query($conn, $qryUp);
            if ($resultUp) {
                echo "<script>alert('Updated Successfully');</script>";
                echo "<script>window.location.href='adminViewFaculty.php';</script>";
            } else {
                echo "<script>alert('Error');</script>";
            }
        } else {
            $sql = "INSERT INTO `classadvisor` (`yearid`,`cid`,`fid`) VALUES ('$year','$course','$uid')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>window.alert('Course Added..')</script>";
                echo "<script>window.location.href='adminViewFaculty.php';</script>";
            } else {
                echo "<script>window.alert('Error Occured..')</script>";
            }
        }
    }

    ?>

</main>

<?php

include "footer.php"
?>