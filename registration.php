<?php
require_once "connection.php";

$username = $_POST['name'];
$password = $_POST['password'];

if ($usersCollection->countDocuments(['username' => $username]) > 0) {
    echo "User with this name already exist";
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$userData = [
    'username' => $username,
    'password' => $hashedPassword,
];
$result = $usersCollection->insertOne($userData);

if ($result->getInsertedCount() > 0) {
    echo "Registration success";
    $result = json_encode($username);
    echo "<script> localStorage.setItem('username', $result); </script> ";
    echo "<Button><a href='index.php?username=" . $username. "'>Go home</a></Button>";
} else {
    echo "Registration failed";
    echo "<Button><a href='registrationForm.php'>Try again</a></Button>";
}
?>