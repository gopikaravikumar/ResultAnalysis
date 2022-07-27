<?php
session_start();
include "commonHeader.php";
include "connection.php";
?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="index.html">Home</a></li>
                <li>Login</li>
            </ol>
            <h2>Login</h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <section id="contact" class="contact">
        <div class="container">

            <div class="section-title">
                <span>Login</span>
                <h2>Login</h2>
            </div>

            <div class="row" data-aos="fade-up">

                <div class="col-lg-6 ">
                    <img src="./assets/img/forForm.jpg" alt="">
                </div>

                <div class="col-lg-6">
                    <form action="" method="post">

                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="email" id="subject" placeholder="Email" required>
                        </div>
                        <div class="form-group mt-3">
                            <input type="password" class="form-control" name="password" id="subject" placeholder="Password" required>
                        </div>

                        <div class="my-3">
                            <div class="errorMsg bg-danger p-3 text-center text-light" id="ErrorMsgPass" style="font-weight:700; font-size:20px; display:none">No User Found..</div>
                            <div class="successMsg bg-success p-3 text-center text-light" style="font-weight:700; font-size:20px; display:none">Registration Succesful...</div>
                        </div>
                        <div class="text-center"><button type="submit" class="p-2 bg-danger text-light" style="border: none;" name="submit">Login</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $qryLog = "SELECT * FROM `login` WHERE `uname`='$email'";
    $resultLog = mysqli_query($conn, $qryLog);
    if (mysqli_num_rows($resultLog) > 0) {
        $rowLog = mysqli_fetch_assoc($resultLog);
        if ($rowLog['password'] == $password) {
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            $_SESSION['uid'] = $rowLog['uid'];
            if ($rowLog['status'] == 'Active') {

                $utype = $rowLog['utype'];
                if ($utype == "admin") {
                    header("Location: admin/adminHome.php");
                } else if (strtolower($utype) == "faculty") {
                    header("Location: faculty/facultyHome.php");
                } else if ($utype == "student") {
                    header("Location: student/studentHome.php");
                } else if ($utype == "HOD") {
                    header("Location: HOD/hodHome.php");
                }
            } else {
                echo "<script>window.alert('Account is Inactive...')</script>";
            }
        } else {
            echo "<script>window.alert('Incorrect Password...')</script>";
        }
    } else {
        echo "<script>window.alert('User Not Found...')</script>";
    }
}
include "commonFooter.php";
?>