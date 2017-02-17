<?php
    include("includes/function.inc.php");

    goOffline();
    session_destroy();

    echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?error=Logged%20out%21\">";
?>