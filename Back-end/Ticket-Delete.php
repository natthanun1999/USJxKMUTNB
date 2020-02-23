<?php
    session_start();

    require('Connection.php');

    if (isset($_POST['TICKET_ID']))
    {
        $ticketID = $_POST['TICKET_ID'];

        $sql = "DELETE FROM ticket WHERE TICKET_ID = '$ticketID'";
        $resultTicket = mysqli_query($db, $sql);

        if ($resultTicket != null)
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