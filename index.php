<?php
require("session.php");
require("connect.php");
confirm_logged_in();

$sql = "SELECT * FROM Login WHERE userid = " . $_GET['id'];
$result = mysqli_query($conn,$sql);
if(!$result) {
    die(mysqli_error($conn));
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Home Page</title>
        <style>
            body {
                background-color: #f4f5f7;
                color:#172b4d;
                font-family: Helvetica,Arial,sans-serif;
            }
            .wrapper {
                width: 1100px;
                margin-left: auto;
                margin-right: auto;
                padding: 10px 3% 10px 3%;
                box-sizing: border-box;
                background-color: white;
                box-shadow: 0px 1px 2px rgb(0 0 0 / 12%), 0px 0px 0px 1px rgb(0 0 0 / 5%);
                border-radius: 5px;
            }
            h1 {
                margin-top: 10vh;
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
            table {
                table-layout: fixed;
                width:730px;
                margin-top: 0px;
                margin-bottom: 20px;
                display: inline-block;
                border-collapse: collapse;
                border-style: hidden;
                /*Remove all the outside
                borders of the existing table*/
                box-shadow: 0px 1px 2px rgb(0 0 0 / 12%), 0px 0px 0px 1px rgb(0 0 0 / 5%);
                border-radius: 3px;
            }
            th {
                width: 160px;
                background-color: whitesmoke;
                padding-left: 10px;
                padding-top: 5px;
                padding-bottom: 5px;
                text-align: left;
                border-left: 1px solid lightgray;
                border-bottom: 1px solid lightgray;
            }
            .first {
                border-left: none;
            }
            td {
                height: 25px;
                max-width: 560px;
                margin:0;
                padding: 4px 10px 4px 10px;
                text-align: left;
                border-left: 1px solid lightgray;
                border-bottom: 1px solid lightgray ;
                word-wrap: break-word;
                color:gray;
            }
            img {
                width: 215px;
                display:inline-block;
                border-radius: 3px;
                float:right;
                box-shadow: 0px 1px 2px rgb(0 0 0 / 12%), 0px 0px 0px 1px rgb(0 0 0 / 5%);

            }
        </style>
    </head>
    <body>
        <h1>ACME Corp: Guardian</h1>
        <div class="wrapper">
            <h3>User Password Info</h3>
            <table>
                    <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>
                                    <th class='first'>User ID</th> <td>". $row['userid'] . "</td>
                                  </tr>
                                  <tr>
                                    <th class='first'>Username</th>
                                    <td>" . $row['username'] . "</td>
                                  </tr>
                                  <tr>
                                    <th class='first'>MFA</th>
                                    <td>" . $row['MFA'] . "</td>
                                  </tr>
                                  <tr>
                                    <th class='first'>Cleartext</th>
                                    <td>" . $row['cleartextpassword'] . "</td>
                                  </tr>
                                  <tr>
                                    <th class='first'>MD5</th>
                                    <td>" . $row['md5hashedpassword'] . "</td>
                                  </tr>
                                  <tr>
                                    <th class='first'>SHA-256</th>
                                    <td>" . $row['sha256hashedpassword'] . "</td>
                                  </tr>
                                  <tr>
                                    <th class='first'>SHA-256 Salted</th>
                                    <td>" . $row['sha256andsaltpassword'] . "</td>
                                  </tr>
                                  <tr>
                                    <th class='first'>Salt</th>
                                    <td><span style='max-width:550px;'>" . $row['passwordsalt'] . "</span></td>
                                   </tr>";
                        }
                    ?>
            </table>
            <img src="./images/person.png">
        </div>
    </body>


</html>
