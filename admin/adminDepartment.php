<?php
include "adminHeader.php";
include "../connection.php";
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
                <span>Department</span>
                <h2>Department</h2>
            </div>

            <div class="row" data-aos="fade-up">


                <div class="col-lg-6" style="margin: auto;">
                    <form action="" method="post">

                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="dept" placeholder="Department" required>
                        </div>
                        <div class="text-center"><button type="submit" class="p-2 mt-3 bg-danger text-light" style="border: none;" name="submit">Submit</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php
    if (isset($_POST['submit'])) {
        $dept = $_POST['dept'];
        $qryCheck = "SELECT * FROM department WHERE department = '$dept'";
        $resultCheck = mysqli_query($conn, $qryCheck);
        if (mysqli_num_rows($resultCheck) > 0) {
            echo "<script>alert('Department Already Exists..');</script>";
        } else {
            $sql = "INSERT INTO `department`(`department`) VALUES ('$dept')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>window.alert('Department Added..')</script>";
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $qryDept = "SELECT * FROM department";
                                $resultDept = mysqli_query($conn, $qryDept);
                                if (mysqli_num_rows($resultDept) > 0) {
                                    while ($row = mysqli_fetch_assoc($resultDept)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['department'] . "</td>";
                                        echo "<td><a href='adminDeleteDepartment.php?delete=" . $row['did'] . "' class='btn btn-danger'>Delete</a></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='2' style='text-align:center'>No Data..</td></tr>";
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