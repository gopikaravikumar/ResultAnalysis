<?php
include "commonHeader.php";
include "connection.php";
$qryYear = "SELECT * FROM `acayear`";
$resultYear = mysqli_query($conn, $qryYear);
$qryDepartment = "SELECT * FROM `department`";
$resultDepartment = mysqli_query($conn, $qryDepartment);
$qryCourse = "SELECT * FROM `course`";
$resultCourse = mysqli_query($conn, $qryCourse);
?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="index.html">Home</a></li>
                <li>Student Registration</li>
            </ol>
            <h2>Student Registration</h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <section id="contact" class="contact">
        <div class="container">

            <div class="section-title">
                <span>Student Registration</span>
                <h2>Student Registration</h2>
            </div>

            <div class="row" data-aos="fade-up">

                <div class="col-lg-6 ">
                    <img src="./assets/img/forForm.jpg" alt="">
                </div>

                <div class="col-lg-6">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <input type="text" name="adno" class="form-control" id="name" placeholder="Your Admission No" required>
                            </div>
                            <div class="col-md-6 form-group">
                                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group mt-3">
                                <input type="text" name="phone" class="form-control" id="name" pattern="[6789][0-9]{9}" maxlength="10" placeholder="Your Phone" required>
                            </div>
                            <div class="col-md-6 form-group mt-3">
                                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <textarea class="form-control" name="address" rows="5" placeholder="Your Address" required></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group mt-3">
                                <select name="year" id="" required class="form-control">
                                    <option value="" selected disabled>Select Academic Year</option>
                                    <?php
                                    while ($rowYear = mysqli_fetch_assoc($resultYear)) {
                                        echo "<option value='" . $rowYear['yearid'] . "'>" . $rowYear['year'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group mt-3">
                                <select name="sem" id="" required class="form-control">
                                    <option value="" selected disabled>Select Semester</option>
                                    <option value="1st">S1</option>
                                    <option value="2nd">S2</option>
                                    <option value="3rd">S3</option>
                                    <option value="4th">S4</option>
                                    <option value="5th">S5</option>
                                    <option value="6th">S6</option>
                                    <option value="7th">S7</option>
                                    <option value="8th">S8</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group mt-3">
                                <select name="dept" id="" required class="form-control">
                                    <option value="">Select Department</option>
                                    <?php
                                    while ($rowDepartment = mysqli_fetch_assoc($resultDepartment)) {
                                        echo "<option value='" . $rowDepartment['did'] . "'>" . $rowDepartment['department'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-6 form-group mt-3">
                                <select name="course" id="" required class="form-control">
                                    <option value="">Select Course</option>
                                    <?php
                                    while ($rowCourse = mysqli_fetch_assoc($resultCourse)) {
                                        echo "<option value='" . $rowCourse['cid'] . "'>" . $rowCourse['course'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group mt-3">
                                <input type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="ePass" id="ePass" placeholder="Your Password" required>
                            </div>
                            <div class="col-md-6 form-group mt-3">
                                <input type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="cPass" id="cPass" oninput="myFun(this.value)" placeholder="Confirm Password" required>
                            </div>
                        </div>
                        <div class="bg-danger mt-2 p-3 text-light" id="error-message" style="display: none"></div>
                        <div class="text-center mt-3"><button type="submit" id='subBtn' class="p-2 bg-danger text-light" style="border: none;" name="submit">Register</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</main>
<script>
    function myFun(cPass) {
        ePass = document.getElementById('ePass').value;
        console.log('CPass: ' + cPass);
        console.log('EPass: ' + ePass);
        if (cPass != ePass) {
            document.getElementById('subBtn').disabled = true;
            document.getElementById('error-message').style.display = 'block';
            document.getElementById('error-message').innerText =
                "Password Dosen't Match";
        } else {
            document.getElementById('subBtn').disabled = false;
            document.getElementById('error-message').style.display = 'none';
        }
    }
</script>

<?php
if (isset($_POST['submit'])) {
    $adno = $_POST['adno'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $year = $_POST['year'];
    $sem = $_POST['sem'];
    $dept = $_POST['dept'];
    $course = $_POST['course'];
    $cPass = $_POST['cPass'];
    $qryCheck = "SELECT * FROM `login` WHERE uname='$email'";
    $resultCheck = mysqli_query($conn, $qryCheck);
    if (mysqli_num_rows($resultCheck) > 0) {
        echo "<script>alert('Email Already Exists');</script>";
    } else {
        $sql = "INSERT INTO `students`(`admno`,`name`, `phone`, `email`, `address`, `yearid`, `sem`, `did`, `cid`) VALUES ('$adno','$name','$phone','$email','$address','$year','$sem','$dept','$course')";
        echo $sql;
        $sqlLog = "INSERT INTO `login` (`uid`,`uname`,`password`,`utype`,`status`) VALUES ((SELECT MAX(`sid`) FROM `students`),'$email','$cPass','student','Inactive')";
        $result = mysqli_query($conn, $sql);
        $resultOutput = mysqli_query($conn, $sqlLog);
        if ($result && $resultOutput) {
            echo "<script>alert('Registration Successful')</script>";
            header("location:login.php");
        } else {
            echo "<script>alert('Error Occured')</script>";
        }
    }
}
include "commonFooter.php";
?>