<?php
    session_start();

    require('Connection.php');

    if (isset($_POST['COUPON_ID']) && isset($_POST['RATE']) && isset($_POST['STATUS']) && isset($_POST['USER_ID']) && isset($_POST['TICKET_ID']))
    {
        $couponID = $_POST['COUPON_ID'];
        $rate = $_POST['RATE'];
        $status = $_POST['STATUS'];
        $userID = $_POST['USER_ID'];
        $ticketID = $_POST['TICKET_ID'];

        $sql = "SELECT USER_ID FROM account WHERE USER_ID = '$userID'";
        $resultAccount = mysqli_query($db, $sql);

        $fetchAccount = mysqli_fetch_assoc($resultAccount);

        $resultTicket = "";

        if ($fetchAccount['USER_ID'] != "" || $status == 'Idle')
        {
            if ($status == 'Idle')
            {
                $userID = '9999';
                $ticketID = '999999';
            }

            $sql = "UPDATE coupon SET COUPON_DISCOUNT = '$rate', COUPON_STATUS = '$status', USER_ID = '$userID', TICKET_ID = '$ticketID' 
                    WHERE COUPON_ID = '$couponID'";
            $resultCoupon = mysqli_query($db, $sql);

            $fetchCoupon = mysqli_fetch_assoc($resultCoupon);

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