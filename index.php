<!DOCTYPE html>
<!--
All rights reserved. Copyright Robert Roy 2016.
-->
<?php
include_once('header.php')
?>

<div class="contentdiv">
    <?php
    if (!empty($_POST['email']) && !empty($_POST['pw'])) {
        include_once('sql/sqlutil.php');
        $SQLUtil = new SQLUtil();
        $email = $_POST['email'];
        $pw = $_POST['pw'];
        $blnValid = $SQLUtil->isValidLogin($email, $pw);
        //if login attempt
        if ($blnValid) {
            echo "Valid Login";
        } else {
            echo showForm("Invalid Login. Please try again.");
        }
    } else if (false) {
        // if already logged in
    } else {
        showForm("");
    }
    ?>

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
                <input type="text" name="pw" placeholder="password"></center></div>
        <br>
        <input class="crispbutton" type="submit" value="Sign In">
        <?php
        if(!($message == "")){
            echo "<br><br>" . $message;
        }
        ?>
    </form>
    <?php
}

include_once('footer.php')
?>