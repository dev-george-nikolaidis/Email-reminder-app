<!-- The CSS styles can be found at app/resources/pages/_login.scss   global components can be found at app/resources/global/ _global.scss-->




<?php include "../app/views/components/header.php" ?>
<?php
// Create form error when we have error in inputs 
if (!empty($data["email_err"]) || !empty($data["password_err"])) {
    $data["form-error"] = true;
}
?>
<section class="login">

    <!-- Include header logo component -->
    <?php include "../app/views/components/logo.php"; ?>
    <div class="main-container">
        <div class="left-container">
            <!-- Include navar  component -->
            <?php include "../app/views/components/navbar.php"; ?>
        </div>
        <div class="center-container">
            <div class="box--borders"></div>
            <img src="../assets/img/logo.png" alt="calendar logo image" class="logo">

            <!-- Form start -->

            <form action="<?php echo URL_ROOT . "/users/login" ?>" method="POST" class=<?php echo !empty($data["password_err"]) ? "form-error" : "" ?>>
                <div class="control-container">

                    <div class="form-control">
                        <label for="">Email</label>
                        <input type="email" name="email" value="<?php echo  htmlspecialchars($data['email']) ?>" class=<?php echo !empty($data["email_err"]) ? "input-error" : "" ?>>
                        <span> <?php echo  $data["email_err"] ?> </span>
                    </div>

                    <div class="form-control">
                        <label for="">Passwort</label>
                        <input type="password" name="password" value="<?php echo htmlspecialchars($data['password']) ?>" class=<?php echo !empty($data["password_err"]) ? "input-error" : "" ?>>
                        <span> <?php echo $data["password_err"] ?> </span>
                    </div>


                    <button class="btn-login" type="submit" value="login">Anmeldung</button>
                </div>
            </form>
            <!-- End form -->

        </div>
        <div class="right-container"></div>


    </div>
</section>

<?php include "../app/views/components/footer.php" ?>