<!-- The CSS styles can be found  app/resources/components/ _navbar.scss  -->
<nav class=navbar>
    <ul class="navbar-list">
        <?php if (isset($_SESSION['user_email'])) : ?>

            <li> <a href=<?php echo URL_ROOT ?> class=<?php echo isset($data["active-home"]) ? "active" : null ?>>Home</a></li>
            <li> <a href=<?php echo URL_ROOT . "/users/logout" ?> class="logout-link">Logout </a></li>
            <li><a href=<?php echo URL_ROOT . "/appointments/about" ?> class=<?php echo isset($data["active-about"]) ? "active" : null ?>>Über Uns</a></li>

        <?php else : ?>

            <li> <a href=<?php echo URL_ROOT ?> class=<?php echo isset($data["active-home"]) ? "active" : null ?>>Home</a></li>
            <li><a href=<?php echo URL_ROOT . "/users/register" ?> class=<?php echo isset($data["active-register"]) ? "active" : null ?>>Registrieren</a></li>
            <li><a href=<?php echo URL_ROOT . "/users/login" ?> class=<?php echo isset($data["active-login"]) ? "active" : null ?>>Anmeldung</a></li>
            <li><a href=<?php echo URL_ROOT . "/appointments/about" ?> class=<?php echo isset($data["active-about"]) ? "active" : null ?>>Über Uns</a></li>

        <?php endif; ?>
    </ul>
</nav>