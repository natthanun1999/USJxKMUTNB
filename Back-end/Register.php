<?php
    session_start();

    require('Connection.php');

    if (isset($_POST['USERNAME']) && isset($_POST['PASSWORD']))
    {
        $userID = RandomUserID();
        $username = $_POST['USERNAME'];
        $password = $_POST['PASSWORD'];

        $sql = "SELECT USERNAME FROM account";
        $resultUser = mysqli_query($db, $sql);

        $match = false;

        while ($fetch = mysqli_fetch_array($resultUser))
        {
            if ($fetch[0] == $username)
            {
                $match = true;
                break;
            }
        }

        if (!$match)
        {
            $money = 0;

            if (isset($_POST['MONEY']))
                if ($_POST['MONEY'] != "")
                    $money = $_POST['MONEY'];

            if (isset($_POST['STATUS']))
                $sql = "INSERT INTO account(USER_ID, USERNAME, PASSWORD, STATUS_ID, MONEY) 
                        VALUES('$userID', '$username', '$password', '".$_POST['STATUS']."', '$money')";
            else
                $sql = "INSERT INTO account(USER_ID, USERNAME, PASSWORD, STATUS_ID) VALUES('$userID', '$username', '$password', '1')";

            $result = mysqli_query($db, $sql);

            if ($result != "")
                SendSuccess();
            else
                SendFailed();
        }
        else
            SendFailed();
    }
    else
        SendFailed();

    function RandomUserID($length = 4)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $randomString = '';

        for ($i = 0; $i < $length; $i++)
        {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    function SendSuccess()
    {
        if (isset($_POST['STATUS']))
            $sending = "<form id='SEND' action='../".$_SESSION['PRE-PAGE']."' method='post'> <input type='hidden' name='INSERTION' value='1'> </form>";
        else
            $sending = "<form id='SEND' action='../".$_SESSION['PRE-PAGE']."' method='post'> <input type='hidden' name='REGISTER' value='1'> </form>";

        echo $sending;
        echo "<script> window.SEND.submit(); </script>";
    }

    function SendFailed()
    {
        if (isset($_POST['STATUS']))
            $sending = "<form id='SEND' action='../".$_SESSION['PRE-PAGE']."' method='post'> <input type='hidden' name='INSERTION' value='0'> </form>";
        else
            $sending = "<form id='SEND' action='../".$_SESSION['PRE-PAGE']."' method='post'> <input type='hidden' name='REGISTER' value='0'> </form>";

        echo $sending;
        echo "<script> window.SEND.submit(); </script>";
    }