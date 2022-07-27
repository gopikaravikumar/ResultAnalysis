<?php
session_start();
include "facultyHeader.php";
include "../connection.php";
$eid = $_GET['eid'];
$srid = $_GET['srid'];

$qry = "SELECT * FROM `studentresult`sr, `students`s, `subject`su WHERE sr.`sid`=s.`sid` AND sr.`subid`=su.`subid` AND sr.`srid`='$srid'";
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
            <h2>Faculty Page</h2>

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
                                        <th>Student</th>
                                        <th>Subject</th>
                                        <th>Result</th>
                                        <th>Update</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        echo "<tr>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['subject'] . "</td>";
                                        echo "<td>" . $row['result'] . "</td>";
                                        echo "<td><input type='radio' value='Pass' name='res'/><em class='text-success'>Pass</em> <br><input type='radio' value='Fail' name='res'/><em class=text-danger>Fail</em></td>";
                                        echo "</tr>";

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
    $res = $_POST['res'];
    $qry = "UPDATE `studentresult` SET `result`='$res', `status`='Approved' WHERE `srid`='$srid'";
    $result = mysqli_query($conn, $qry);
    if ($result) {
        echo "<script>alert('Mark added successfully..');</script>";
        echo "<script>window.location.href='facultyViewResults.php?eid=$eid';</script>";
    }
}
include "footer.php"
?>