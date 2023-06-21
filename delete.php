<?php

require_once "connection.php";

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $filter = ['_id' => new MongoDB\BSON\ObjectId($id)];
    $recordsCollection->deleteOne($filter);
}

echo "Record deleted";
echo "<Button><a href='index.php?username=" . $username. "'>Go home</a></Button>";

?>