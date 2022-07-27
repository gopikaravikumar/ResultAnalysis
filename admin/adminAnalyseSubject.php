<?php
session_start();
include "adminHeader.php";
include "../connection.php";

$yer = $_GET['yer'];
$course = $_GET['course'];
$sem = $_GET['sem'];
if ($sem != 0) {
    $qrySub = "SELECT * FROM `subject` WHERE `yearid`='$yer' AND `cid`='$course' AND `sem`='$sem'";
    $resultSub = mysqli_query($conn, $qrySub);

    $qry = "SELECT * FROM `exams` WHERE `yearid`='$yer' AND `cid`='$course' AND `sem`='$sem' ";
    $result = mysqli_query($conn, $qry);
    $totStundents = 0;
    $passStundents = 0;
    if (isset($_GET['submit'])) {
        $sub = $_GET['sub'];
        $attempt = $_GET['attempt'];
        if ($sub != 0) {
            $qryTotStundents = "SELECT * FROM `studentresult` WHERE `eid`='$attempt' AND `subid`='$sub'";
            $resultTotStundents = mysqli_query($conn, $qryTotStundents);
            $totStundents = mysqli_num_rows($resultTotStundents);
            $qryPassStundents = "SELECT * FROM `studentresult` WHERE `eid`='$attempt' AND `subid`='$sub' AND `result`='Pass'";
            $resultPassStundents = mysqli_query($conn, $qryPassStundents);
            $passStundents = mysqli_num_rows($resultPassStundents);
        } else {
            $qryTotStundents = "select distinct(`sid`) from `studentresult` where `eid`='$attempt'";
            $resultTotStundents = mysqli_query($conn, $qryTotStundents);
            $totStundents = mysqli_num_rows($resultTotStundents);
            $passStundents = 0;
            while ($rowTotStundents = mysqli_fetch_assoc($resultTotStundents)) {
                $sid = $rowTotStundents['sid'];
                $qryPassStundents = "SELECT * FROM `studentresult` WHERE `eid`='$attempt' AND `sid`='$sid'";
                $resultPassStundents = mysqli_query($conn, $qryPassStundents);
                $fail = 0;
                while ($passStundents = mysqli_fetch_array($resultPassStundents)) {
                    if ($passStundents['result'] == 'Fail') {
                        $fail++;
                    }
                }
                if ($fail == 0) {
                    $passStundents++;
                }
            }
        }
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
                <h2>Admin Page</h2>

            </div>
        </section><!-- End Breadcrumbs -->
        <section id="contact" class="contact">
            <div class="container">
                <div class="row" data-aos="fade-up">


                    <form action="adminAnalyseSubject.php" method="get">
                        <input type="hidden" value="<?php echo $yer ?>" name="yer">
                        <input type="hidden" value="<?php echo $course ?>" name="course">
                        <input type="hidden" value="<?php echo $sem ?>" name="sem">
                        <div class="col-lg-12 d-flex" style="margin: auto;justify-content:space-around;">
                            <div class="col-4 form-group mt-3">
                                <select name="sub" id="" required class="form-control">
                                    <option value="" selected disabled>Select Subject</option>
                                    <option value="0">Whole Semester</option>
                                    <?php
                                    while ($rowSub = mysqli_fetch_assoc($resultSub)) {
                                        echo "<option value='" . $rowSub['subid'] . "'>" . $rowSub['subject'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-4 form-group mt-3">
                                <select name="attempt" id="" required class="form-control">
                                    <option value="" selected disabled>Select Attempt</option>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='$row[eid]'>Attempt $i</option>";
                                        $i++;
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-4 text-center"><button type="submit" class="col-12 p-2 mt-3 btn-danger text-light" style="border: none;" name="submit">Submit</button></div>
                        </div>
                    </form>
                </div>


                <div class="row">
                    <div class="col-lg-12 mt-5 text-center">
                        <h4>Total Number of Students : <em style="font-weight: 900;"><?php echo $totStundents ?></em></h4>
                        <h4>Number of Students Passed : <em style="font-weight: 900;"><?php echo $passStundents ?></em> </h4>
                    </div>
                </div>
            </div>
        </section>


    </main>

<?php
} else {
    $qry = "SELECT * FROM `exams` WHERE `yearid`='$yer' AND `cid`='$course' AND `examtype`='Regular'";
    $result = mysqli_query($conn, $qry);
    $totStundents = 0;
    $failStundents = 0;
    while ($row = mysqli_fetch_array($result)) {
        $qryFailed = "SELECT DISTINCT(`sid`) FROM `studentresult` WHERE `eid`='$row[eid]' AND `result`='fail'";
        $resultFailed = mysqli_query($conn, $qryFailed);
        $rowFailed = mysqli_fetch_array($resultFailed);
        $failStundents += mysqli_num_rows($resultFailed);
        $qryTotStundents = "SELECT DISTINCT(`sid`) FROM `studentresult` WHERE `eid`='$row[eid]'";
        $resultTotStundents = mysqli_query($conn, $qryTotStundents);
        $totStundents += mysqli_num_rows($resultTotStundents);
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
                <h2>Admin Page</h2>

            </div>
        </section><!-- End Breadcrumbs -->
        <section id="contact" class="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 mt-5 text-center">
                        <h4>Total Number of Students : <em style="font-weight: 900;"><?php echo $totStundents ?></em></h4>
                        <h4>Number of Students Passed in Whole Subject in 1<sup>st</sup> Attempt : <em style="font-weight: 900;"><?php echo $totStundents - $failStundents ?></em> </h4>
                    </div>
                </div>
            </div>
        </section>


    </main>
<?php
}
include "footer.php"
?>