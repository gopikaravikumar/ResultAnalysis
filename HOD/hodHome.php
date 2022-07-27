<?php
session_start();
include "hodHeader.php";
include "../connection.php";
$qry = "SELECT * FROM faculty where `fid` = '$_SESSION[uid]'";
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
            <h2>HOD Page</h2>

        </div>
    </section><!-- End Breadcrumbs -->
    <section id="contact" class="contact">
        <div class="container">

            <h1>Welcome <?php echo $row['name'] ?>..</h1>
        </div>
    </section>


</main>

<?php

include "footer.php"
?>