<?php
    session_start();

    require('Connection.php');

    if (isset($_POST['TICKET_ID']) && isset($_POST['TYPE']) && isset($_POST['STATUS']) && isset($_POST['USER_ID']))
    {
        $ticketID = $_POST['TICKET_ID'];
        $type = $_POST['TYPE'];
        $status = $_POST['STATUS'];
        $userID = $_POST['USER_ID'];

        $sql = "SELECT USER_ID FROM account WHERE USER_ID = '$userID'";
        $resultAccount = mysqli_query($db, $sql);

        $fetchAccount = mysqli_fetch_assoc($resultAccount);

        $resultTicket = "";

        if ($fetchAccount['USER_ID'] != "")
        {
            if ($status == 'Idle')
                $userID = '9999';

            if ($status == 'Sell' && $userID == '9999')
                $status = 'Idle';

            $sql = "UPDATE ticket SET TYPE_ID = '$type', TICKET_STATUS = '$status', USER_ID = '$userID' WHERE TICKET_ID = '$ticketID'";
            $resultTicket = mysqli_query($db, $sql);

            $fetchTicket = mysqli_fetch_assoc($resultTicket);

            SendSuccess();
        }
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