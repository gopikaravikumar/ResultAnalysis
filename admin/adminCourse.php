<?php
include "adminHeader.php";
include "../connection.php";
$qryDepartment = "SELECT * FROM `department`";
$resultDepartment = mysqli_query($conn, $qryDepartment);
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
                            <input type="text" class="form-control" name="course" placeholder="Course" required>
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
        $dept = $_POST['dept'];
        $qryCheck = "SELECT * FROM course WHERE course = '$course'";
        $resultCheck = mysqli_query($conn, $qryCheck);
        if (mysqli_num_rows($resultCheck) > 0) {
            echo "<script>alert('Course Already Exists..');</script>";
        } else {
            $sql = "INSERT INTO `course`(`course`,`did`) VALUES ('$course','$dept')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>window.alert('Course Added..')</script>";
            } else {
                echo "<script>window.alert('Error Occured..')</script>";
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
                                    <th>Department</th>
                                    <th>Course</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $qryCourse = "SELECT * FROM course, department WHERE course.did = department.did";
                                $resultCourse = mysqli_query($conn, $qryCourse);
                                if (mysqli_num_rows($resultCourse) > 0) {
                                    while ($row = mysqli_fetch_assoc($resultCourse)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['department'] . "</td>";
                                        echo "<td>" . $row['course'] . "</td>";
                                        echo "<td><a href='adminDeleteCourse.php?delete=" . $row['cid'] . "' class='btn btn-danger'>Delete</a></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='3' style='text-align:center'>No Data Found..</td></tr>";
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