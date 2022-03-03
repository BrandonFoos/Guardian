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
    if(!$result) {
        die($sql . mysqli_error($conn));
    } else {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['MEMBER_ID'] = $row['userid'];
        echo "<script>window.location = 'index.php';</script>";
    }
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
                color:whitesmoke;
                background-color:whitesmoke;
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
                font-size: 16px;
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
                font-size: 16px;
                transition: transform .2s;
            }
            .login:hover {
                transform: scale(1.02);
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
                transition: transform .2s;
            }
            .create:hover {
                transform: scale(1.02);
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
