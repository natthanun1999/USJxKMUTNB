<?php
    session_start();

    require('Connection.php');

    if (isset($_POST['USER_ID']))
    {
        $userID = $_POST['USER_ID'];

        $sql = "DELETE FROM account WHERE USER_ID = '$userID'";
        $resultAccount = mysqli_query($db, $sql);

        if ($resultAccount != null)
            SendSuccess();
        else
            SendFailed();
    }
    else
    {
        SendFailed();
    }

    function SendSuccess()
    {
        $sending = "<form id='SEND' action='../".$_SESSION['PRE-PAGE']."' method='post'> <input type='hidden' name='DELETE' value='1'> </form>";

        echo $sending;
        echo "<script> window.SEND.submit(); </script>";
    }

    function SendFailed()
    {
        $sending = "<form id='SEND' action='../".$_SESSION['PRE-PAGE']."' method='post'> <input type='hidden' name='DELETE' value='0'> </form>";

        echo $sending;
        echo "<script> window.SEND.submit(); </script>";
    }