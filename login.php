<?php
require_once "connection.php";

$username = $_POST['name'];
$password = $_POST['password'];

$userData = $usersCollection->findOne(['username' => $username]);

if ($userData && password_verify($password, $userData['password'])) {
    echo "Login success";
    $result = json_encode($username);
    echo "<script> localStorage.setItem('username', $result); </script> ";
    echo "<Button><a href='index.php?username=" . $username. "'>Go home</a></Button>";
} else {
    echo "Wrong login or password";
    echo "<Button><a href='loginForm.php'>Try again</a></Button>";
}
?>