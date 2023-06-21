<?php
require_once "connection.php";

$id = $_GET['id'];
$username = $_GET['username'];

$filter = ['_id' => new MongoDB\BSON\ObjectID($id)];
$document = $recordsCollection->findOne($filter);

$phone = $document['phone'];
$pib = $document['pib'];
$explanation = $document['explanation'];
$workplace = $document['workplace'];
$email = $document['email'];

$html = "<form method='POST'>";
$html .= "<input type='hidden' name='id' value='$id'>";
$html .= "<input type='hidden' name='username' value='$username'>";
$html .= "Phone:";
$html .= "<input type='number' name='phone' value='$phone'>";
$html .= "PIB:";
$html .= "<input type='text' name='pib' value='$pib'>";
$html .= "Explanation:";
$html .= "<input type='text' name='explanation' value='$explanation'>";
$html .= "Workplace:";
$html .= "<input type='text' name='workplace' value='$workplace'>";
$html .= "Email:";
$html .= "<input type='email' name='email' value='$email'>";
$html .= "<input type='submit' name='update' value='Save'>";
$html .= "</form>";

echo $html;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $id = $_POST['id'];
    $newPhone = $_POST['phone'];
    $newPib = $_POST['pib'];
    $newExplanation = $_POST['explanation'];
    $newWorkplace = $_POST['workplace'];
    $newEmail = $_POST['email'];
    

    $filter = ['_id' => new MongoDB\BSON\ObjectID($id)];
    $update = [
        '$set' => [
            'phone' => $newPhone,
            'pib' => $newPib,
            'explanation' => $newExplanation,
            'workplace' => $newWorkplace,
            'email' => $newEmail
        ]
    ];
    $result = $recordsCollection->updateOne($filter, $update);
    $html = '';
    echo $html;

    if ($result->getModifiedCount() > 0) {
        header("Location: index.php?username=$username");
        exit();
    } else {
        echo "Update of record failed";
    }
}
?>