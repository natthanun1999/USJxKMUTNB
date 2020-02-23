<?php
    session_start();

    require('Connection.php');

    if (isset($_POST['BUY']))
    {
        $userID = $_POST['USER_ID'];
        $type = $_POST['TYPE'];
        $price = $_POST['PRICE'];
        $amount = $_POST['AMOUNT'];

        if ($amount > 0)
        {
            $ticketID = selectTicket($db, $type);

            $money = getMoney($db, $userID);

            if ($money >= $price)
            {
                $couponValidate = false;
                $couponStatus = false;

                //Discount
                if (isset($_POST['COUPON']))
                {
                    if ($_POST['COUPON'] != "")
                    {
                        $coupon_ID = $_POST['COUPON'];

                        $sql = "SELECT COUPON_DISCOUNT, COUPON_STATUS FROM coupon WHERE COUPON_ID = '$coupon_ID'";
                        $resultCoupon = mysqli_query($db, $sql);

                        $fetchCoupon = mysqli_fetch_assoc($resultCoupon);

                        if ($fetchCoupon['COUPON_DISCOUNT'] != "")
                        {
                            if ($fetchCoupon['COUPON_STATUS'] == "Idle")
                            {
                                $discount = $fetchCoupon['COUPON_DISCOUNT'] / 100;

                                $price = $price - ($price * $discount);

                                $sql = "UPDATE coupon SET COUPON_STATUS = 'Used', USER_ID = '$userID', TICKET_ID = '$ticketID' WHERE COUPON_ID = '$coupon_ID'";
                                $resultUpdate = mysqli_query($db, $sql);

                                $couponValidate = true;

                                $couponStatus = true;
                            }
                        }
                    }
                    else
                    {
                        $couponValidate = true;
                        $couponStatus = true;
                    }
                }
                else
                {
                    $couponValidate = true;
                    $couponStatus = true;
                }

                if ($couponValidate)
                {
                    if ($couponStatus)
                    {
                        $balance = $money - $price;

                        //Update Balance
                        $sql = "UPDATE account SET account.MONEY = '$balance' WHERE account.USER_ID = '$userID'";
                        mysqli_query($db, $sql) or die('Error! : Update balance failed.');

                        $sql = "UPDATE ticket SET ticket.TICKET_STATUS = Sell_Ticket('$type'), ticket.USER_ID = '$userID' WHERE ticket.TICKET_ID = '$ticketID'";
                        mysqli_query($db, $sql) or die('Error! : Update ticket failed.');

                        $_SESSION['USER_BALANCE'] = getMoney($db, $userID);

                        //All Progress success.
                        if (isset($_POST['COUPON']))
                            $sending = "<form id='SEND' action='../".$_SESSION['PRE-PAGE']."' method='post'> <input type='hidden' name='PURCHASE-COUPON' value='1'> </form>";
                        else
                            $sending = "<form id='SEND' action='../".$_SESSION['PRE-PAGE']."' method='post'> <input type='hidden' name='PURCHASE' value='1'> </form>";
                    }
                    else
                    {
                        //Invalid Coupon
                        $sending = "<form id='SEND' action='../".$_SESSION['PRE-PAGE']."' method='post'> <input type='hidden' name='PURCHASE-COUPON' value='0'> </form>";
                    }
                }
                else
                {
                    //Invalid Coupon
                    $sending = "<form id='SEND' action='../".$_SESSION['PRE-PAGE']."' method='post'> <input type='hidden' name='PURCHASE-COUPON' value='0'> </form>";
                }
            }
            else
            {
                //Money not enough
                $sending = "<form id='SEND' action='../".$_SESSION['PRE-PAGE']."' method='post'> <input type='hidden' name='PURCHASE' value='0'> </form>";
            }
        }
        else
        {
            //Out of stock
            $sending = "<form id='SEND' action='../".$_SESSION['PRE-PAGE']."' method='post'> <input type='hidden' name='OUT-OF-STOCK' value='1'> </form>";
        }

        //Send Result
        echo $sending;
        echo "<script> window.SEND.submit(); </script>";
    }

    function selectTicket($db, $type)
    {
        $sql = "SELECT ticket.TICKET_ID FROM ticket WHERE ticket.TYPE_ID = '$type' AND ticket.TICKET_STATUS = 'Idle'";
        $resultTicket = mysqli_query($db, $sql);

        $fetchTicket = mysqli_fetch_assoc($resultTicket);

        return $fetchTicket['TICKET_ID'];
    }

    function getMoney($db, $userID)
    {
        $sql = "SELECT MONEY FROM account WHERE USER_ID = '$userID'";
        $resultUser = mysqli_query($db, $sql);

        $fetchUser = mysqli_fetch_assoc($resultUser);

        return $fetchUser['MONEY'];
    }