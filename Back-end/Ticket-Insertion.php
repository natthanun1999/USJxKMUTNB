<?php
    session_start();

    require('Connection.php');

    if (isset($_POST['TYPE']) && isset($_POST['STATUS']) && isset($_POST['AMOUNT']))
    {
        $type = $_POST['TYPE'];
        $status = $_POST['STATUS'];
        $amount = $_POST['AMOUNT'];

        $sql = "";

        for ($n = 0; $n < $amount; $n++)
        {
            $ticketID = RandomTicketID();

            $sql = "INSERT INTO ticket(TICKET_ID, TYPE_ID, TICKET_STATUS, USER_ID) VALUES('$ticketID', '$type', '$status', '9999')";

            $resultTicket = mysqli_query($db, $sql);
        }

        if ($resultTicket != "")
            SendSuccess();
        else
            SendFailed();
    }
    else
    {
        SendFailed();
    }

    function RandomTicketID($length = 6)
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
        $sending = "<form id='SEND' action='../".$_SESSION['PRE-PAGE']."' method='post'> <input type='hidden' name='INSERTION' value='1'> </form>";

        echo $sending;
        echo "<script> window.SEND.submit(); </script>";
    }

    function SendFailed()
    {
        $sending = "<form id='SEND' action='../".$_SESSION['PRE-PAGE']."' method='post'> <input type='hidden' name='INSERTION' value='0'> </form>";

        echo $sending;
        echo "<script> window.SEND.submit(); </script>";
    }