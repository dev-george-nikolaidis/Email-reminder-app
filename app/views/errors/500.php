<!-- The CSS styles can be found at app/resources/pages/_page500.scss   global components can be found at app/resources/global/ _global.scss-->

<?php include "../app/views/components/header.php" ?>

<section class="page500">

    <!-- Include header logo component -->
    <?php include "../app/views/components/logo.php"; ?>
    <div class="main-container">
        <div class="left-container">
            <!-- Include navar  component -->
            <?php include "../app/views/components/navbar.php"; ?>
            <a href="http://www.freepik.com">Designed by stories / Freepik</a>
        </div>
        <div class="center-container">
            <div class="box--borders"></div>
            <img src="../assets/img/500.jpg" alt="server error image" class="server-error-img">
        </div>
        <div class="right-container"></div>


    </div>
</section>

<?php include "../app/views/components/footer.php" ?>