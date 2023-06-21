<?php 
require_once __DIR__."/vendor/autoload.php";
$usersCollection = (new MongoDB\Client)->phone_book->users;
$recordsCollection = (new MongoDB\Client)->phone_book->records;
?>