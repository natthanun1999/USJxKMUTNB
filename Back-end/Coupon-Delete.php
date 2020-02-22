<?php
    session_start();

    require('Connection.php');

    if (isset($_POST['COUPON_ID']))
    {
        $couponID = $_POST['COUPON_ID'];

        $sql = "DELETE FROM coupon WHERE COUPON_ID = '$couponID'";
        $resultCoupon = mysqli_query($db, $sql);

        if ($resultCoupon != null)
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