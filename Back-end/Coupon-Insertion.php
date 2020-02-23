<?php
    session_start();

    require('Connection.php');

    if (isset($_POST['RATE']) && isset($_POST['STATUS']) && isset($_POST['AMOUNT']))
    {
        $rate = $_POST['RATE'];
        $status = $_POST['STATUS'];
        $amount = $_POST['AMOUNT'];

        $sql = "";

        for ($n = 0; $n < $amount; $n++)
        {
            $couponID = RandomCouponID();

            $sql = "INSERT INTO coupon(COUPON_ID, COUPON_DISCOUNT, COUPON_STATUS, USER_ID, TICKET_ID) VALUES('$couponID', '$rate', '$status', '9999', '999999')";
            $resultCoupon = mysqli_query($db, $sql);
        }

        if ($resultCoupon != "")
            SendSuccess();
        else
            SendFailed();
    }
    else
    {
        SendFailed();
    }

    function RandomCouponID($length = 8)
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