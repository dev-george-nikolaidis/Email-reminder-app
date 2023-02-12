<!-- The CSS styles can be found at app/resources/pages/_home.scss  the global components can be found at app/resources/global/ _global.scss-->


<?php include "../app/views/components/header.php" ?>

<section class="home">

    <!-- Welcome message to the user -->
    <?php if (isset($_SESSION['user_id'])) : ?>
        <div class="display-user-container">
            <p>Herzlich willkommen!</p>
            <div class="user-context-container">
                <img src="./assets/img/user.svg" alt="user-icon" class="user-icon">
                <p><?php echo $_SESSION['user_email'] ?></p>
            </div>
        </div>
    <?php endif; ?>
    <!-- End welcome message to the user -->

    <!-- Header start -->
    <?php include "../app/views/components/logo.php"; ?>
    <!-- Header end -->
    <div class="main-container">
        <div class="left-container">
            <?php include "../app/views/components/navbar.php"; ?>
        </div>
        <div class="center-container">
            <div class="box--borders"></div>

            <div class="errors-container">
                <small class="login-error"> <?php echo $data["user_login_err"] ?> </small>
                <small> <?php echo $data["input_date_err"] ?> </small>
                <small> <?php echo $data["input_month_err"] ?> </small>
                <small> <?php echo $data["description_err"] ?> </small>
                <small> <?php echo $data["time_reminder_err"] ?> </small>

            </div>


            <!--  Form start-->
            <form action="<?php echo URL_ROOT . "/appointments" ?>" method="POST">
                <!-- <form action="<?php echo  htmlspecialchars($_SERVER['PHP_SELF']) ?>" method=" POST"> -->
                <div class="flex-container">

                    <div class="form-control-date">
                        <label for="Date">Datum(TT/MM)</label>
                        <div>
                            <input type="number" name="input_date" value="<?php echo  htmlspecialchars($data['input_date']) ?>" min="1" max="31" class=<?php echo !empty($data["input_date_err"]) ? "input-error" : null ?>>
                            <input type="number" name="input_month" value="<?php echo  htmlspecialchars($data['input_month']) ?>" min="1" max="12" class=<?php echo !empty($data["input_month_err"]) ? "input-error" : null ?>>
                        </div>
                    </div>
                    <div class="form-control-description">
                        <label for="Description">Bezeichnung</label>
                        <input type="text" name="description" value="<?php echo  htmlspecialchars($data['description']) ?>" class=<?php echo !empty($data["description_err"]) ? "input-error" : null ?>>
                    </div>
                    <div class="form-control-time-reminder">
                        <label for="time reminder">Erinnerrung</label>
                        <select name="time_reminder" class=<?php echo !empty($data["time_reminder_err"]) ? "input-error selection" : "selection" ?>>
                            <option value="" selected disabled hidden> --bitte auswählen </option>
                            <option value="1 Tag">1 Tag</option>
                            <option value="2 Tage">2 Tage</option>
                            <option value="4 Tage">4 Tage</option>
                            <option value="1 Woche">1 Woche</option>
                            <option value="2 Wochen">2 Wochen</option>
                        </select>

                    </div>
                </div>
                <button class="btn-save" type="submit" name="create_new_appointment">SPEICHERN</button>
            </form>
            <!-- End form -->

            <!-- Display appointments -->
            <section class="appointments-container">
                <?php include "../app/views/components/display-appointments.php"; ?>
            </section>
            <!-- End Display appointments -->


            <div class="update-errors-container">
                <small class="day-error"></small>
                <small class="month-error"></small>
                <small class="description-error"></small>
            </div>

        </div>

        <div class="right-container"></div>
    </div>
</section>

<?php include "../app/views/components/footer.php" ?>