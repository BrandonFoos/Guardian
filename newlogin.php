<?php
require("./connect.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['email'])) {
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
    <style>
        body {
            background-color: #f4f5f7;
            color:#172b4d;
            font-family: Helvetica,Arial,sans-serif;
        }
        form {
            width: 400px;
            max-width: 90%;
            margin-top: 20vh;
            margin-left: auto;
            margin-right: auto;
            padding: 10px 3% 10px 3%;
            box-sizing: border-box;
            background-color: white;
            box-shadow: 0px 1px 2px rgb(0 0 0 / 12%), 0px 0px 0px 1px rgb(0 0 0 / 5%);
            border-radius: 5px;
        }
        h1 {
            text-align: center;
            font-family: Helvetica,Arial,sans-serif;
        }
        hr {
            height:2px;
            border-width:0;
            color:#172b4d;
            background-color:lightgray;
            margin-bottom: 15px;
        }
        input {
            width: 100%;
            height:40px;
            margin-bottom: 12px;
            padding-left: 10px ;
            box-sizing: border-box;
            background-color: #fafafa;
            border: 1px solid lightgray;
            border-radius: 5px;

        }
        label {
            display: block;
            margin-top: 8px;
            padding-left: 2px;
            padding-bottom: 3px;
        }

        .login {
            width: 100%;
            height:40px;
            margin-bottom: 12px;
            margin-top: 8px;
            padding-left: 10px ;
            box-sizing: border-box;
            background-color: rgba(30, 148, 224, 1);
            border: none;
            border-radius: 5px;
            color:white;
        }

        .create {
            display: block;
            width: 60%;
            height:40px;
            margin-bottom: 12px;
            margin-right: auto;
            margin-left: auto;
            background-color: #42b72a;
            border: none;
            border-radius: 5px;
            color:white;
        }
        a {
            display: block;
            text-decoration: none;
            text-align: center;
            color:#172b4d;
        }
    </style>
</head>
<body>
<form method="post" action="">
    <h1>ACME Corp</h1>
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <button type="submit" class="login">Create Account</button>
    <a href="./login.php">Go back to login</a>
    <br>
</form>

</body>

</html>
