<?php
    session_start();

    require('Connection.php');

    if (isset($_POST['USER_ID']) && isset($_POST['USERNAME']) && isset($_POST['PASSWORD']) && isset($_POST['STATUS']) && isset($_POST['MONEY']))
    {
        $userID = $_POST['USER_ID'];
        $username = $_POST['USERNAME'];
        $password = $_POST['PASSWORD'];
        $status = $_POST['STATUS'];
        $money = $_POST['MONEY'];

        $sql = "UPDATE account SET PASSWORD = '$password', STATUS_ID = '$status', MONEY = '$money' WHERE USER_ID = '$userID'";
        $resultAccount = mysqli_query($db, $sql);

        $_SESSION['USER_BALANCE'] = getMoney($db, $userID);

        if ($resultAccount != "")
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
        $sending = "<form id='SEND' action='../".$_SESSION['PRE-PAGE']."' method='post'> <input type='hidden' name='EDIT' value='1'> </form>";

        echo $sending;
        echo "<script> window.SEND.submit(); </script>";
    }

    function SendFailed()
    {
        $sending = "<form id='SEND' action='../".$_SESSION['PRE-PAGE']."' method='post'> <input type='hidden' name='EDIT' value='0'> </form>";

        echo $sending;
        echo "<script> window.SEND.submit(); </script>";
    }

    function getMoney($db, $userID)
    {
        $sql = "SELECT MONEY FROM account WHERE USER_ID = '$userID'";
        $resultUser = mysqli_query($db, $sql);

        $fetchUser = mysqli_fetch_assoc($resultUser);

        return $fetchUser['MONEY'];
    }