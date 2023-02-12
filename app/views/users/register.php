<!-- The CSS styles can be found at app/resources/pages/_register.scss   global components can be found at app/resources/global/ _global.scss-->


<?php include "../app/views/components/header.php" ?>
<?php
// Create form error when we have error in inputs 
if (!empty($data["email_err"]) || !empty($data["password_err"]) || !empty($data["confirm_password_err"])) {
    $data["form-error"] = true;
}
?>

<section class="register">

    <!-- Register success message modal -->
    <?php if (isset($data["register-success"])) : ?>
        <div class="register-modal-container"></div>
        <div class="content-modal-container">
            <img src="../assets/img/check-box.svg" alt="success checkmark  image" class="success-icon">
            <p>Das Konto wurde erfolgreich erstellt!</p>
            <a href=<?php echo URL_ROOT . "/users/login" ?> class="btn-success-login">Login</a>
        </div>
    <?php endif; ?>
    <!-- Modal end-->

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

            <form action="<?php echo URL_ROOT . "/users/register" ?>" method="POST" class=<?php echo !empty($data["password_err"]) ? "form-error" : "" ?>>
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

                    <div class="form-control">
                        <label for="">Passwort Bestätigen</label>
                        <input type="password" name="confirm_password" value="<?php echo  htmlspecialchars($data['confirm_password']) ?>" class=<?php echo !empty($data["confirm_password_err"]) ? "input-error" : "" ?>>
                        <span> <?php echo $data["confirm_password_err"] ?> </span>
                    </div>

                    <button class="btn-register-form" type="submit" value="register"><span></span> Registrieren</button>
                </div>
            </form>
            <!-- End form -->

        </div>
        <div class="right-container"></div>
    </div>
</section>

<?php include "../app/views/components/footer.php" ?>