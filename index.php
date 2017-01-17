<!DOCTYPE html>
<!--
All rights reserved. Copyright Robert Roy 2016.
-->
<?php
include_once('header.php')
?>

<div class="contentdiv">
    <h2>Please sign in</h2>
    <form action="sendmail.php" method="post" onsubmit="return false;">
        <label class="label" for="email">Email:</label>
        <input type="text" name="email" autocomplete="email" placeholder="johndoe@gmail.com">
        <br>
        <label class="label"  for="pw">Password:</label>
        <input type="text" name="pw" placeholder="Password123">
        <br>
        <input class="crispbutton" type="submit" value="Clock In">
    </form>
</div>

<?php
include_once('footer.php')
?>