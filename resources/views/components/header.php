<?php require_once __DIR__.'/../../../config/config.php'; ?>

<header>
    <div class="container">
        <nav>
            <img src="<?php echo $base_url; ?>/public_html/img/logo-big-v4.png" alt="logo" class="logo">
            <a href="<?php echo $base_url; ?>/index.php">Home</a>
            <a href="<?php echo $base_url; ?>/resources/views/meldingen/index.php">Meldingen</a>
        </nav>
        <div>
            <?php if (isset($_SESSION['username']) == true) : ?>
                <a href="<?php echo $base_url; ?>/login.php">uitloggen</a>
            <?php else : ?>
                <a href="<?php echo $base_url; ?>/login.php">Inloggen</a>
            <?php endif; ?>


        </div>
    </div>
</header>
