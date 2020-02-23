<?php
    require('Connection.php');
    session_start();

    if (isset($_POST['USERNAME']) && isset($_POST['PASSWORD']))
    {
        $username = $_POST['USERNAME'];
        $password = $_POST['PASSWORD'];

        $sql = "SELECT * FROM account WHERE USERNAME = '$username' AND PASSWORD = '$password'";
        $result = mysqli_query($db, $sql);

        $fetch = mysqli_fetch_assoc($result);

        if ($fetch['USER_ID'] != "")
        {
            $_SESSION['USER_ID'] = $fetch['USER_ID'];
            $_SESSION['USER_LOGON'] = $fetch['USERNAME'];
            $_SESSION['USER_STATUS'] = $fetch['STATUS_ID'];
            $_SESSION['USER_BALANCE'] = $fetch['MONEY'];

            SendSuccess();
        }
        else
            SendFailed();
    }
    else
        SendFailed();

    function SendSuccess()
    {
        $sending = "<form id='SEND' action='../".$_SESSION['PRE-PAGE']."' method='post'> <input type='hidden' name='LOGIN' value='1'> </form>";

        echo $sending;
        echo "<script> window.SEND.submit(); </script>";
    }

    function SendFailed()
    {
        $sending = "<form id='SEND' action='../".$_SESSION['PRE-PAGE']."' method='post'> <input type='hidden' name='LOGIN' value='0'> </form>";

        echo $sending;
        echo "<script> window.SEND.submit(); </script>";
    }