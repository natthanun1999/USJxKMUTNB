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
                $balance = $money - $price;

                //Update Balance
                $sql = "UPDATE account SET account.MONEY = '$balance' WHERE account.USER_ID = '$userID'";
                mysqli_query($db, $sql) or die('Error! : Update balance failed.');

                $sql = "UPDATE ticket SET ticket.TICKET_STATUS = Sell_Ticket('$type'), ticket.USER_ID = '$userID' WHERE ticket.TICKET_ID = '$ticketID'";
                mysqli_query($db, $sql) or die('Error! : Update ticket failed.');

                $_SESSION['USER_BALANCE'] = getMoney($db, $userID);

                //All Progress success.
                $sending = "<form id='SEND' action='../".$_SESSION['PRE-PAGE']."' method='post'> <input type='hidden' name='PURCHASE' value='1'> </form>";

                echo $sending;
                echo "<script> window.SEND.submit(); </script>";
            }
            else
            {
                $sending = "<form id='SEND' action='../".$_SESSION['PRE-PAGE']."' method='post'> <input type='hidden' name='PURCHASE' value='0'> </form>";

                echo $sending;
                echo "<script> window.SEND.submit(); </script>";
            }
        }
        else
        {
            $sending = "<form id='SEND' action='../".$_SESSION['PRE-PAGE']."' method='post'> <input type='hidden' name='OUT-OF-STOCK' value='1'> </form>";

            echo $sending;
            echo "<script> window.SEND.submit(); </script>";
        }
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