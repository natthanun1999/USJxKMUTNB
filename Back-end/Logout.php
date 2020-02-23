<?php
    session_start();
    session_destroy();

    $sending = "<form id='SEND' action='../".$_SESSION['PRE-PAGE']."' method='post'> <input type='hidden' name='LOGOUT' value='1'> </form>";

    echo $sending;
    echo "<script> window.SEND.submit(); </script>";