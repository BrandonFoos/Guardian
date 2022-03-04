<?php
require("./connect.php");
require("./session.php");

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
	    mail('brandon.foos@usu.edu', 'User Authenticated','A user has logged in');
        $_SESSION['MEMBER_ID'] = $row['userid'];
        $_SESSION['BROWSER_INFO'] = $_SERVER['HTTP_USER_AGENT'];
        echo "<script>window.location = 'index.php?id=".$row['userid']."';</script>";
    } else {
	    $sql = "FAILURE: " . $sql;
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
