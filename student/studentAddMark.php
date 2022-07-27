<?php
session_start();
include "studentHeader.php";
include "../connection.php";
$eid = $_GET['eid'];
$cid = $_GET['cid'];
$sem = $_GET['sem'];
$yearid = $_GET['yearid'];
$etype = $_GET['etype'];

$qry = "SELECT * FROM `subject` WHERE `yearid`='$yearid' AND `sem`='$sem' AND `cid`='$cid'";
$result = mysqli_query($conn, $qry);
$countSub = mysqli_num_rows($result);

$qryCheck = "SELECT * FROM `studentresult` WHERE `sid`='$_SESSION[uid]' AND `eid`='$eid'";
$resultCheck = mysqli_query($conn, $qryCheck);
if (mysqli_num_rows($resultCheck) > 0) {
    echo "<script>alert('You have already added mark for this exam..');</script>";
    echo "<script>window.location.href='studentViewExam.php';</script>";
}
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
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <form action="" method="post">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Subject</th>
                                        <th>Result</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        $i = 1;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $row['subject'] . "<input type='hidden' value='$row[subid]' name='sub$i'/></td>";
                                            echo "<td><input type='radio' value='Pass' name='res$i'/><em class='text-success'>Pass</em> <br><input type='radio' value='Fail' name='res$i'/><em class=text-danger>Fail</em></td>";
                                            echo "</tr>";
                                            $i++;
                                        }
                                        echo "<tr><td colspan='12' style='text-align:center'><input type='submit' name='submit' class='bg-danger mt-2 p-3 text-light' style='border:none'/></td></tr>";
                                    } else {
                                        echo "<tr><td colspan='12' style='text-align:center'>No Data Found..</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


</main>

<?php
if (isset($_POST['submit'])) {
    $i = 1;
    while ($i <= $countSub) {
        $subid = $_POST['sub' . $i];
        if (isset($_POST['res' . $i])) {
            $res = $_POST['res' . $i];
            $qry = "INSERT INTO `studentresult`(`sid`, `eid`, `subid`, `result`,`examtype`) VALUES ('$_SESSION[uid]','$eid','$subid','$res','$etype')";
            $result = mysqli_query($conn, $qry);
        }
        $i++;
    }
    if ($result) {
        echo "<script>alert('Mark added successfully..');</script>";
        echo "<script>window.location.href='studentViewExam.php';</script>";
    }
}
include "footer.php"
?>