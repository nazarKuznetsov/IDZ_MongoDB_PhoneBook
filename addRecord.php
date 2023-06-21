<?php
require_once "connection.php";

$phone = $_POST['phone'];
$pib = $_POST['pib'];
$explanation = $_POST['explanation'];
$workplace = $_POST['workplace'];
$email = $_POST['email'];
$username = $_POST['usernameForm'];

$newDocument = [
    'username' => $username,
    'phone' => $phone,
    'pib' => $pib,
    'explanation' => $explanation,
    'workplace' => $workplace,
    'email' => $email
];

$result = $recordsCollection->insertOne($newDocument);

if ($result->getInsertedCount() > 0) {
    echo "Record success";
    echo "<Button><a href='index.php?username=" . $username. "'>Go home</a></Button>";
} else {
    echo "Record failed";
    echo "<Button><a href='index.php?username=" . $username. "'>Go home</a></Button>";
}
?>