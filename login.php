<!doctype html>
<html lang="nl">

<head>
    <title>StoringApp</title>
    <?php require_once 'resources/views/components/head.php'; ?>
</head>

<body>
    <?php require_once 'resources/views/components/header.php'; ?>

    <div class="container home">
        <form action="./app/Http/Controllers/loginControler.php" method="post">
            <div class="form-group">
                <label for="username">Gebruikersnaam</label>
                <input type="text" name="username" id="username">
            </div>
            <div class="form-group">
                <label for="password">Wachtwoord:</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="form-group">
                <input type="submit" value="Login">
            </div>
        </form>
        <div class="registreer">
            <p>nog geen account</p>
            <a href="./registreer.php">registreer</a>
        </div>
    </div>
</body>

</html>
