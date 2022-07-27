<?php
include "commonHeader.php";
include "connection.php";
$qryDepartment = "SELECT * FROM `department`";
$resultDepartment = mysqli_query($conn, $qryDepartment);
?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="index.html">Home</a></li>
                <li>Faculty Registration</li>
            </ol>
            <h2>Faculty Registration</h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <section id="contact" class="contact">
        <div class="container">

            <div class="section-title">
                <span>Faculty Registration</span>
                <h2>Faculty Registration</h2>
            </div>

            <div class="row" data-aos="fade-up">

                <div class="col-lg-6 ">
                    <img src="./assets/img/forForm.jpg" alt="">
                </div>

                <div class="col-lg-6">
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-md-12 form-group">
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
                                <select name="position" id="" required class="form-control">
                                    <option value="" selected disabled>Select Position</option>
                                    <!-- <option value="Principal">Principal</option> -->
                                    <option value="HOD">HOD</option>
                                    <option value="Faculty">Faculty</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="qual" id="subject" placeholder="Qualification" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group mt-3">
                                <input type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="ePass" id="ePass" placeholder="Your Password" required>
                            </div>
                            <div class="col-md-6 form-group mt-3">
                                <input type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="cPass" id="cPsss" oninput="myFun(this.value)" placeholder="Confirm Password" required>
                            </div>
                        </div>
                        <div class="bg-danger mt-2 p-3 text-light" id="error-message" style="display: none"></div>
                        <div class="text-center"><button type="submit" class="p-2 bg-danger text-light" style="border: none;" id='subBtn' name="submit">Register</button></div>
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
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $dept = $_POST['dept'];
    $position = $_POST['position'];
    $qual = $_POST['qual'];
    $cPass = $_POST['cPass'];
    $qryCheck = "SELECT * FROM `login` WHERE `uname`='$email'";
    $resultCheck = mysqli_query($conn, $qryCheck);
    if (mysqli_num_rows($resultCheck) > 0) {
        echo "<script>alert('Email Already Exists');</script>";
    } else {
        $qry = "INSERT INTO `faculty`(`name`, `phone`, `email`, `address`, `did`, `qual`,`ftype`) VALUES ('$name','$phone','$email','$address','$dept','$qual','$position')";
        $result = mysqli_query($conn, $qry);
        $qryLog = "INSERT INTO `login`(`uid`,`uname`, `password`,`utype`) VALUES ((SELECT MAX(`fid`) FROM `faculty`),'$email','$cPass','$position')";
        $resultLog = mysqli_query($conn, $qryLog);
        if ($result && $resultLog) {
            header('location:login.php');
        } else {
            echo "<script>alert('Error occured');</script>";
        }
    }
}
include "commonFooter.php";
?>