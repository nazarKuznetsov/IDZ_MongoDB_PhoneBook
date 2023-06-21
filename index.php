<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone BOOK</title>
    <style>
        .phone-field,
        .pib-field,
        .explanation-field,
        .workplace-field,
        .email-field{
            display: block;
        }
    </style>
</head>
<body>
    <header id="header" style="display:none"> 
        <Button><a href="registrationForm.php">Register</a></Button>
        <Button><a href="loginForm.php">Login</a></Button>
    </header>
    <main id="mainUser" style="display:none"> 
        <h3 id="username">Hello,  </h3>
        <Button onclick="localStorage.clear()"><a href="/">Logout</a></Button>
    <div id="add-record">
        <h3>Add record:</h3>
        <form action="addRecord.php" method="POST">
            <input type="hidden" name="usernameForm" id="usernameForm">
            Phone: <input type="number" name="phone" required>
            PIB: <input type="text" name="pib">
            Explanation: <input type="text" name="explanation">
            Workplace: <input type="text" name="workplace">
            Email: <input type="email" name="email">
            <input type="submit" value="Add">
            <script>
                let username = localStorage.getItem("username");
                document.getElementById('usernameForm').value = username;
            </script>
        </form>
    </div>
    <div id="filter-list">
        <h3>Filter your records:</h3>
        <input type="checkbox" name="phoneCheckbox" value="1" checked> Phone
        <input type="checkbox" name="pibCheckbox" value="1" checked> PIB
        <input type="checkbox" name="explanationCheckbox" value="1" checked> Explanation
        <input type="checkbox" name="workplaceCheckbox" value="1" checked> Workplace
        <input type="checkbox" name="emailCheckbox" value="1" checked> Email
    </div>
    <script>
        const phoneCheckbox = document.querySelector('input[name="phoneCheckbox"]');
        const pibCheckbox = document.querySelector('input[name="pibCheckbox"]');
        const explanationCheckbox = document.querySelector('input[name="explanationCheckbox"]');
        const workspaceCheckbox = document.querySelector('input[name="workplaceCheckbox"]');
        const emailCheckbox = document.querySelector('input[name="emailCheckbox"]');

        function handleCheckboxChange() {
            const phoneChecked = phoneCheckbox.checked;
            const pibChecked = pibCheckbox.checked;
            const explanationChecked = explanationCheckbox.checked;
            const workspaceChecked = workspaceCheckbox.checked;
            const emailChecked = emailCheckbox.checked;

            const phoneElements = document.querySelectorAll('.phone-field');
            phoneElements.forEach(element => {
                element.style.display = phoneChecked ? 'block' : 'none';
            });
            const pibElements = document.querySelectorAll('.pib-field');
            pibElements.forEach(element => {
                element.style.display = pibChecked ? 'block' : 'none';
            });
            const explanationElements = document.querySelectorAll('.explanation-field');
            explanationElements.forEach(element => {
                element.style.display = explanationChecked ? 'block' : 'none';
            });
            const workspaceElements = document.querySelectorAll('.workspace-field');
            workspaceElements.forEach(element => {
                element.style.display = workspaceChecked ? 'block' : 'none';
            });
            const emailElements = document.querySelectorAll('.email-field');
            emailElements.forEach(element => {
                element.style.display = emailChecked ? 'block' : 'none';
            });
        }

        phoneCheckbox.addEventListener('change', handleCheckboxChange);
        pibCheckbox.addEventListener('change', handleCheckboxChange);
        explanationCheckbox.addEventListener('change', handleCheckboxChange);
        workspaceCheckbox.addEventListener('change', handleCheckboxChange);
        emailCheckbox.addEventListener('change', handleCheckboxChange);
    </script>
    <div id="records">
    <h3>Your records:</h3>
    <script>
        if(typeof username === 'undefined' || username === null ){
            document.getElementById("header").style.display = "block";
            document.getElementById("mainUser").style.display = "none";
        }else {
            document.getElementById("mainUser").style.display = "block";
            document.getElementById("header").style.display = "none";
            document.getElementById("username").innerText  += " " + username;
        }
    </script>

<?php
require_once "connection.php";

$username = $_GET['username'];

$filter = ['username' => $username];
$result = $recordsCollection->find($filter);

$html = '';
if(!isset($username) || $username == ''){
    $html .= "<h3>No records yet</h3>";
    echo $html;
    exit;
}
foreach ($result as $document) {
    $id = $document['_id'];
    $pib = $document['pib'];
    $explanation = $document['explanation'];
    $workplace = $document['workplace'];
    $email = $document['email'];
    $phone = $document['phone'];

    $html .= "<div>";
    $html .= "<form method='POST' action='delete.php'>";
    $html .= "<input type='hidden' name='id' value='$id'>";
    $html .= "<input type='hidden' name='username' value='$username'>";
    if($phone !== ''){
        $html .= "<p class='phone-field'>Phone: $phone</p>";
    }
    if($pib  !== ''){
        $html .= "<p class='pib-field'>PIB: $pib</p>";
    }
    if($explanation  !== ''){
        $html .= "<p class='explanation-field'>Explanation: $explanation</p>";
    }
    if($workplace  !== ''){
        $html .= "<p class='workspace-field'>Workplace: $workplace</p>";
    }
    if($email !== ''){
        $html .= "<p class='email-field'>Email: $email</p>";
    }
    
    $html .= "<input type='button' onclick='window.location.href=`editForm.php?id=$id&username=$username`' value='Edit'>";
    $html .= "<input type='submit' name='delete' value='Delete'>";
    $html .= "</form>";
    $html .= "</div>";
}
echo $html;
?>
</div>
</main>
</body>
</html>