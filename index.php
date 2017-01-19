<!DOCTYPE html>
<!--
All rights reserved. Copyright Robert Roy 2016.
-->
<?php
include_once('header.php')
?>

<div class="contentdiv">
    <img id="loginbanner" src="img/sign.png"/>
    <br>
    <br>
    <br>
    <form action="sendmail.php" method="post" onsubmit="return false;">
        <!--label class="label" for="email">Email:</label>-->
        
        <div><center><input type="text" name="email" autocomplete="email" placeholder="email address">
                <!--label class="label"  for="pw">Password:</label>-->
        <input type="text" name="pw" placeholder="password"></center><div>
        <br>
        <input class="crispbutton" type="submit" value="Sign In">
        
    </form>
</div>

<?php
include_once('footer.php')
?>