<?php
session_start();
include "adminHeader.php";
include "../connection.php";
$qryYear = "SELECT * FROM acayear";
$resultYear = mysqli_query($conn, $qryYear);
$qryCourse = "SELECT * FROM course";
$resultCourse = mysqli_query($conn, $qryCourse);
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


                <form action="adminAnalyseSubject.php" method="GET">
                    <div class="col-lg-12 d-flex" style="margin: auto;justify-content:space-around;">
                        <div class="col-3 form-group mt-3">
                            <select name="yer" id="" required class="form-control">
                                <option value="" selected disabled>Select Academic Year</option>
                                <?php
                                while ($rowYear = mysqli_fetch_assoc($resultYear)) {
                                    echo "<option value='" . $rowYear['yearid'] . "'>" . $rowYear['year'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-3 form-group mt-3">
                            <select name="course" id="" required class="form-control">
                                <option value="" selected disabled>Select Course</option>
                                <?php
                                while ($rowCourse = mysqli_fetch_assoc($resultCourse)) {
                                    echo "<option value='" . $rowCourse['cid'] . "'>" . $rowCourse['course'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-3 form-group mt-3">
                            <select name="sem" id="" required class="form-control">
                                <option value="" selected disabled>Select Semester</option>
                                <option value="0">Whole Academic Year</option>
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
                        <div class="col-3 text-center"><button type="submit" class="col-12 p-2 mt-3 btn-danger text-light" style="border: none;">Submit</button></div>
                    </div>
                </form>
            </div>


            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">

                    </div>
                </div>
            </div>
        </div>
    </section>


</main>

<?php

include "footer.php"
?>