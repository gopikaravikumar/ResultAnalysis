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
                <span>Academic Year</span>
                <h2>Academic Year</h2>
            </div>

            <div class="row" data-aos="fade-up">


                <div class="col-lg-6" style="margin: auto;">
                    <form action="" method="post">

                        <div class="form-group mt-3">
                            <input type="number" min='2000' max="3000" class="form-control" name="sYear" placeholder="Starting Year" required>
                        </div>
                        <div class="form-group mt-3">
                            <input type="number" min='2000' max="3000" class="form-control" name="eYear" placeholder="Ending Year" required>
                        </div>

                        <div class="text-center"><button type="submit" class="p-2 mt-2 bg-danger text-light" style="border: none;" name="submit">Submit</button></div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php
    if (isset($_POST['submit'])) {
        $sYear = $_POST['sYear'];
        $eYear = $_POST['eYear'];
        $year = "$sYear-$eYear";
        $qryCheck = "SELECT * FROM acayear WHERE year = '$year'";
        $resultCheck = mysqli_query($conn, $qryCheck);
        if (mysqli_num_rows($resultCheck) > 0) {
            echo "<script>alert('Academic Year Already Exists..');</script>";
        } else {
            $sql = "INSERT INTO `acayear`(`year`) VALUES ('$year')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>window.alert('Year Added..')</script>";
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
                                    <th>Academic Year</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM acayear";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['year'] . "</td>";
                                        echo "<td><a href='adminDeleteYear.php?delete=" . $row['yearid'] . "' class='btn btn-danger'>Delete</a></td>";
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