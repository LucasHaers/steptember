<?php

include "sessie.php";
include "gebruiker.php";

$error = false;
if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $gebruiker = null;

    $gebruiker = Gebruiker::vindGebruikers($username, $password);

    if ($gebruiker != null) {
        $key = md5(uniqid(rand(), true));

        $sessie = new Sessie();
        $sessie->userID = $gebruiker->id;
        $sessie->key = $key;
        $sessie->start = date("Y-m-d H:i:s");
        $sessie->end = date("Y-m-d H:i:s", strtotime("+1 month"));
        $sessie->insert();
    
        setcookie("steptember-session", $key, strtotime("+1 month"), "/");
        header("Location: overview.php");
    } else {
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if($error){echo "username or password is incorrect";} ?>
        <form action="" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>
