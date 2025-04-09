<?php
require_once '../../../config/conn.php';
require_once '../../../config/config.php';

if (isset($_SESSION['user_id'])) {
    header("Location: " . $base_url . "/registeer.php?msg=Je bent al ingelogd");
    die();
}

$username = $_POST['username'];
$password = $_POST['password'];
$password_check  = $_POST['password_check'];
if (empty($username) || empty($password)) {
    header("Location: " . $base_url . "/resources/views/registreer.php?msg=Vul alle velden in.");
    die();
}

if ($password != $password_check) {
    header("Location: " . $base_url . "/resources/views/registreer.php?msg=Wachtwoorden komen niet overeen.");
    die();
}

//check if user already exists
$query = "SELECT * FROM users WHERE username = :username";
$statement = $conn->prepare($query);
$statement->execute([":username" => $username]);

if($statement->rowCount() > 0) {
    header("Location: " . $base_url . "/resources/views/registreer.php?msg=Gebruikersnaam bestaat al.");
    die();
}

$hash = password_hash($password, PASSWORD_DEFAULT);

//Kernbegrip 17, stap 3b:
$query = "INSERT INTO users (username, password) VALUES (:username, :hash)";
$statement = $conn->prepare($query);
$statement->execute([
    ":username" => $username,
    ":hash" => $hash
]);

//Stuur naar login:
header("Location: " . $base_url . "/login.php?msg=Account aangemaakt, je kunt nu inloggen");
?>
