<?php

session_start();

function logged_in()
{
    checkExpiration();
    return isset($_SESSION['MEMBER_ID']);
}

function confirm_logged_in()
{
    if (!logged_in()) {
        header("location:login.php");
        die();
    }
}
function checkExpiration()
{
    $expireAfter = 4320;
    if (isset($_SESSION['last_action'])) {

        $timeInactive = time() - $_SESSION['last_action'];

        //min to sec
        $expireAfterSeconds = $expireAfter * 60;


        if ($timeInactive >= $expireAfterSeconds || $_SESSION['BROWSER_INFO'] != $_SERVER['HTTP_USER_AGENT']) {
            session_unset();
            session_destroy();
        }
    }
    $_SESSION['last_action'] = time();
}
?>
