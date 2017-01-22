<?php
/*
 * All rights reserved. Copyright Robert Roy 2016.
 */
include_once('header.php')
?>
<div class="contentdiv">
    <?php
    session_start();
    session_destroy();
    $_SESSION = array();
    ?>
    <p>You have been signed out.</p>
    <a href="index.php">Sign in</a>
</div>
<?php
include_once('footer.php')
?>