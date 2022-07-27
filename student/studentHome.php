<?php
session_start();
include "studentHeader.php";
include "../connection.php";
$qry = "SELECT * FROM `students`s,`course`c,`department`d,`acayear`a,`login`l  WHERE s.`sid` = '$_SESSION[uid]' AND s.`cid`=c.`cid` AND s.`did`=d.`did` AND s.`yearid`=a.`yearid`AND s.`email`=l.`uname`";
$result = mysqli_query($conn, $qry);
$row = mysqli_fetch_assoc($result);
?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="adminHome.php">Home</a></li>
                <li>Home</li>
            </ol>
            <h2>Student Page</h2>

        </div>
    </section><!-- End Breadcrumbs -->
    <section id="contact" class="contact">
        <div class="container">

            <h1>Welcome <?php echo $row['name'] ?>..</h1><br><br>
            <div class="col-lg-6" style="margin:auto;">
                <h2 class='text-center mb-3'>Update Profile</h2>
                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <input type="text" name="adno" class="form-control" id="name" placeholder="Your Admission No" value="<?php echo $row['admno'] ?>" readonly>
                        </div>
                        <div class="col-md-6 form-group">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" value="<?php echo $row['name'] ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group mt-3">
                            <input type="text" name="phone" class="form-control" id="name" pattern="[6789][0-9]{9}" maxlength="10" placeholder="Your Phone" value="<?php echo $row['phone'] ?>" required>
                        </div>
                        <div class="col-md-6 form-group mt-3">
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $row['email'] ?>" placeholder="Your Email" readonly>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <textarea class="form-control" name="address" rows="5" placeholder="Your Address" required><?php echo $row['address'] ?></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6 form-group mt-3">
                            <input type="text" class="form-control" id="email" value="<?php echo $row['year'] ?>" placeholder="Your Email" readonly>
                        </div>
                        <div class="col-md-6 form-group mt-3">
                            <select name="sem" id="" required class="form-control">
                                <option value="<?php echo $row['sem'] ?>" selected><?php echo $row['sem'] ?></option>
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
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mt-3">
                            <input type="text" class="form-control" id="email" value="<?php echo $row['department'] ?>" placeholder="Your Email" readonly>
                        </div>
                        <div class="col-md-6 form-group mt-3">
                            <input type="text" class="form-control" id="email" value="<?php echo $row['course'] ?>" placeholder="Your Email" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 form-group mt-3">
                            <input type="password" class="form-control" name="ePass" id="ePass" value="<?php echo $row['password'] ?>" placeholder="Your Password" required>
                        </div>
                        <div class="col-md-6 form-group mt-3">
                            <input type="password" class="form-control" name="cPass" id="cPass" oninput="myFun(this.value)" placeholder="Confirm Password" required>
                        </div>
                    </div>
                    <div class="bg-danger mt-2 p-3 text-light" id="error-message" style="display: none"></div>
                    <div class="text-center mt-3"><button type="submit" id='subBtn' class="p-2 bg-danger text-light" style="border: none;" name="submit">Update</button></div>
                </form>
            </div>
        </div>
    </section>


</main>

<?php
if (isset($_POST['submit'])) {
    $adno = $_POST['adno'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $sem = $_POST['sem'];
    $ePass = $_POST['ePass'];
    $cPass = $_POST['cPass'];
    if ($ePass == $cPass) {
        $qry = "UPDATE `students` SET `admno`='$adno',`name`='$name',`phone`='$phone',`address`='$address',`sem`='$sem' WHERE `sid`='$_SESSION[uid]'";
        $result = mysqli_query($conn, $qry);
        $qryLog = "UPDATE `login` SET `password`='$ePass' WHERE `uname`='$email'";
        $resultLog = mysqli_query($conn, $qryLog);
        if ($result && $resultLog) {
            echo "<script>alert('Updated Successfully');</script>";
            echo "<script>window.location.href='studentHome.php';</script>";
        } else {
            echo "<script>alert('Error');</script>";
        }
    } else {
        echo "<script>alert('Password Mismatch');</script>";
    }
}

include "footer.php"
?>