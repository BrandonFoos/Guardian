<?php
require("./connect.php");
require("./session.php");
require("./email.php");

session_unset();
if (isset($_POST['email'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM Login WHERE (`username` = '" . $email . "') AND (`cleartextpassword` = '" . $password . "')";
    //die($sql);
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    if(!$result) {
        die($sql . mysqli_error($conn));
    } else if (isset($row['userid'])) {
	    $sql = "SUCCESS: " . $sql;
	    $stmt = $conn->prepare("INSERT INTO usrQuery VALUES (null, ? );");
    $stmt->bind_param('s',$sql);
	    $stmt->execute();
	    $message = "<h1>Hello Brandon,</h1><p>A new login has occured at login.brandonfoos.com</p><br><b>IP Address</b><br><p>". $_SERVER['REMOTE_ADDR'] ."</p><br><b>Command Used</b><br><p>". $sql . "</p>";
	   send_email('brandon.foos@usu.edu',"New Login",$message);
        $_SESSION['MEMBER_ID'] = $row['userid'];
        $_SESSION['BROWSER_INFO'] = $_SERVER['HTTP_USER_AGENT'];
        echo "<script>window.location = 'index.php?id=".$row['userid']."';</script>";
    } else {
	    $sql = "FAILURE: ". $_SERVER['REMOTE_ADDR'] . " " . $sql;
            $stmt = $conn->prepare("INSERT INTO usrQuery VALUES (null, ? );");
    $stmt->bind_param('s',$sql);
    $stmt->execute();
	echo "<script>alert('Bad Username or Password');</script>";
    }
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
            <input type="email" name="email" placeholder="Email">
            <input id="password" type="password" name="password" placeholder="Password" onmouseover="mouseoverPass();" onmouseout="mouseoutPass();">
            <button class="login">Login</button>
            <a href="#">Forgot Password?</a>
            <hr>
            <input type="button" class="create" name="create" value="Create" onclick="window.location = 'newlogin.php';">

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
