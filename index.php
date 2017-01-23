<!DOCTYPE html>
<!--
All rights reserved. Copyright Robert Roy 2016.
-->
<?php
include_once('header.php')
?>

<div class="centerxy">
    <div class="contentdiv">
        <?php
        session_start();
        if (isset($_SESSION['userid'])) {
            //if already logged in
            $sessionMinutes = ini_get('session.gc_maxlifetime') / 60;
            ?>
            <p>You are already logged in.</p>
            <p>Your session will last <?= $sessionMinutes ?> minutes.</p>
            <a href="signout.php">Sign Out</a>
            <?php
        } else if (!empty($_POST['email']) && !empty($_POST['pw'])) {
            //if login attempt
            include_once('sql/sqlutil.php');
            $SQLUtil = new SQLUtil();
            $email = $_POST['email'];
            $pw = $_POST['pw'];
            $userid = $SQLUtil->tryLogin($email, $pw);
            if ($userid !== -1) {
                echo "You have been signed in.";
                $_SESSION['userid'] = $userid;
            } else {
                echo showForm("Invalid Login. Please try again.");
            }
        } else {
            showForm("");
        }
        ?>

    </div>
    <br>
    <span class="colorwhite">Don't have an account?</span>
    <a class="colorwhite" href="index.php">Sign up.</a>
</div>
<?php

function showForm($message) {
    ?>

    <img id="loginbanner" src="img/sign.png"/>
    <br>
    <br>
    <br>
    <form action="index.php" method="post" onsubmit="">
        <div><center><input type="text" name="email" autocomplete="email" placeholder="email address">
                <input type="password" name="pw" placeholder="password"></center></div>
        <br>
        <input class="crispbutton" type="submit" value="Sign In">
        <?php
        if (!($message === "")) {
            // only print a message if there is one to print
            echo "<br><br>" . $message;
        }
        ?>
    </form>
    <?php
}

include_once('footer.php')
?>