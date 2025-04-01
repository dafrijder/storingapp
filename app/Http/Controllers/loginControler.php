<?php
session_start();

$username = $_POST['username'];
$password = $_POST['password'];

require_once '../../../config/conn.php';

$query = "SELECT * FROM users WHERE username = :username";

$statement = $conn->prepare($query);
$statement->bindParam(':username', $username);
$statement->execute();

$user = $statement->fetch(PDO::FETCH_ASSOC);
if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $msg = "Je bent ingelogd";
    header("Location: " . $base_url . "/index.php?msg=". $msg);
} else {
    header("Location: " . $base_url . "/resources/views/login.php");
}
?>