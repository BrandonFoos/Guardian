<?php
require("./connect.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$allow = True;
if (isset($_POST['email']) && $allow) {
    $email = htmlentities(trim($_POST['email']));
    $password = htmlentities(trim($_POST['password']));
    $md5 = md5($password);
    $sha256 = hash('sha256', $password);
    $salt = generateRandomString(256);
    $passwordandsalt = $password . $salt;
    $sha256salted = hash('sha256', $passwordandsalt);

    $sql = "INSERT INTO Login VALUES (null,'" . $email . "', 0 ,'" . $password . "','". $md5 ."','" . $sha256 . "','". $sha256salted . "','" . $salt . "');";
    $result = mysqli_query($conn,$sql);
    if(!$result) {
        die(mysqli_error($conn));
    } else {
        die("<script>alert('Account created, please login.'); window.location = 'index.php'</script>");
    }
} else if (!$allow) {
        echo "<script>alert('Account Creation Disabled');</script>";
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}  
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<form method="post" action="">
    <h1>ACME Corp</h1>
    <input type="email" name="email" placeholder="Email" >
    <input id="password" type="password" name="password" placeholder="Password" onmouseover="mouseoverPass();" onmouseout="mouseoutPass();">
    <button type="submit" class="login">Create Account</button>
    <a href="./login.php">Go back to login</a>
    <br>
</form>

</body>
<script>
    function mouseoverPass(obj) {
        var obj = document.getElementById('password');
        obj.type = "text";
    }
    function mouseoutPass(obj) {
        var obj = document.getElementById('password');
        obj.type = "password";
    }
</script>


</html>
