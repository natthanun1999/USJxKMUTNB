<?php
    session_start();

    $_SESSION['PRE-PAGE'] = "Ticket.php";

    require('Back-end/Connection.php');

    $sql = "SELECT * FROM ticket_idle";
    $resultTicket = mysqli_query($db, $sql);

    $ticketData = array(
            array('NULL', 0, 0),
            array('NULL', 0, 0),
            array('NULL', 0, 0)
    );

    $n = 0;

    while ($fetchTicket = mysqli_fetch_assoc($resultTicket))
    {
        $ticketData[$n][0] = $fetchTicket['NAME'];
        $ticketData[$n][1] = $fetchTicket['PRICE'];
        $ticketData[$n][2] = $fetchTicket['AMOUNT'];

        $n++;
    }
?>

<html>
    <head>
        <title>Universal Studio Japan by KMUTNB</title>

        <!-- Loading Bootstrap -->
        <link rel="stylesheet" href="css/bootstrap.css">

        <!-- Loading Flat UI -->
        <link rel="stylesheet" href="css/flat-ui.css">
        <link rel="stylesheet" href="css/flat-web.css">

        <link rel="stylesheet" href="css/style.css">

        <link rel="stylesheet" href="css/Map.css">

        <link rel="icon" href="favicon.png">

        <link href="https://fonts.googleapis.com/css?family=Staatliches|Lobster|Slabo+27px&display=swap" rel="stylesheet">
    </head>

    <body>
        <header>
            <nav id="topbar" class="navbar navbar-expand-lg navbar-light bg-light navbared shadow-sm">
                <a class="navbar-brand" href="index.php">USJ</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="width: 100%">
                    <ul class="navbar-nav mr-auto"> <!-- mr-auto -->
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="Promotion.php">Promotion</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">Ticket</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="Map.php">Map</a>
                        </li>

                        <?php
                            if (!isset($_SESSION['USER_LOGON']))
                            {
                                $sending = "<li class='nav-item'>"."\n";
                                $sending = $sending."<a class='nav-link' href='#' onclick=\"modalShow('modal-wrapper');\">Login</a>"."\n";
                                $sending = $sending."</li>";

                                echo $sending;
                            }
                            else
                            {
                                $sending = "<li class='nav-item dropdown'>"."\n";

                                $sending = $sending."<a class='nav-link dropdown-toggle' href='' id='navbarDropdown' role='button'";
                                $sending = $sending."data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                ".$_SESSION['USER_LOGON']."'s [Balance : $".$_SESSION['USER_BALANCE']."]</a>";

                                $sending = $sending."<div class='dropdown-menu' aria-labelledby='navbarDropdown'>";

                                if ($_SESSION['USER_STATUS'] == "99")
                                    $sending = $sending."<a class='dropdown-item' href='Manage.php'> Manage </a>";

                                $sending = $sending. "<a class='dropdown-item' href='Cart.php'> Cart </a>";
                                $sending = $sending. "<a class='dropdown-item' href='Coupon.php'> Coupon </a>";
                                $sending = $sending."<a class='dropdown-item' href='Back-end/Logout.php'> Logout </a>";
                                $sending = $sending."</div>";

                                $sending = $sending."</li>";

                                echo $sending;
                            }
                        ?>
                    </ul>
                </div>
            </nav>
        </header>

        <main>
            <div class="pop-up">
                <!-- AUTHENTICATION MODAL -->
                <div id="modal-wrapper" class="modal">
                    <form class="modal-content animate" action="Back-end/Auth.php" method="post">
                        <div class="img-container">
                            <span onclick="modalClose('modal-wrapper');" class="close" title="Close PopUp">&times;</span>
                            <img src="1.png" alt="Avatar" class="avatar">
                            <h1 style="text-align: center;">Login or Register</h1>
                        </div>



                        <div class="container">
                            <input type="text" placeholder="Enter Username" name="USERNAME" required>
                            <input type="password" placeholder="Enter Password" name="PASSWORD" required>
                            <button type="submit" class="login">Login</button>
                            <button type="button" class="register" onclick="modalClose('modal-wrapper'); modalShow('register-modal');">Register</button>
                            <!--
                            <input type="checkbox" style="margin:26px 30px;"> Remember me
                            <a href="#" style="text-decoration:none; float:right; margin-right:34px; margin-top:26px;">Forgot Password ?</a>
                            -->
                        </div>
                    </form>
                </div>

                <!-- REGISTER MODAL -->
                <div id="register-modal" class="modal">
                    <form class="modal-content animate" action="Back-end/Register.php" method="post">
                        <div class="img-container">
                            <span onclick="modalClose('register-modal');" class="close" title="Close PopUp">&times;</span>
                            <img src="1.png" alt="Avatar" class="avatar">
                            <h1 style="text-align: center;">Register</h1>
                        </div>



                        <div class="container">
                            <input type="text" placeholder="Enter Username" name="USERNAME" required>
                            <input type="password" placeholder="Enter Password" name="PASSWORD" required>
                            <button type="submit" class="confirm">Register</button>
                            <button type="button" class="cancel" onclick="modalClose('register-modal');">Cancel</button>
                        </div>
                    </form>
                </div>

                <!-- TICKET BUY MODAL -->
                <div id="buy-modal" class="modal">
                    <form class="modal-content animate" action="Back-end/Buy-Ticket.php" method="post">
                        <div class="img-container">
                            <span onclick="modalClose('buy-modal')" class="close" title="Close PopUp">&times;</span>
                            <img src="1.png" alt="Avatar" class="avatar" id="ticket-img">
                            <h1 style="text-align: center;" id="ticket-item">Ticket Sell System</h1>
                            <h2 style="text-align: center;" id="ticket-price">$68</h2>
                            <h3 style="text-align: center;" id="ticket-amount">In stock : 99</h3>
                        </div>

                        <div class="container">
                            <input type="text" placeholder="Enter Coupon Code (Optional)" name="COUPON">
                            <input type="hidden" name="USER_ID" value="<?php if (isset($_SESSION['USER_ID'])) echo $_SESSION['USER_ID']; ?>">
                            <input type="hidden" name="TYPE" id="send-item">
                            <input type="hidden" name="PRICE" id="send-price">
                            <input type="hidden" name="AMOUNT" id="send-amount">

                            <button type="submit" class="confirm" name="BUY" value="true">Confirm</button>
                            <button type="button" onclick="modalClose('buy-modal')" class="cancel">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="ticket-content">
                <div class="container">
                    <div class="container-item">
                        <div>
                            <p class="title">Ticket</p>
                        </div>

                        <table width="100%" height="50%">
                            <tr height="100%">
                                <td align="center" width="33%">
                                    <div class="content-item">
                                        <img src="img/Adult.png" width="80%" height="45%" style="margin-top: 10%">
                                        <p style="margin-top: 7%">Adult Ticket</p>
                                        <p><?php echo "$".$ticketData[0][1]; ?></p>

                                        <?php
                                            if (isset($_SESSION['USER_LOGON']))
                                            {
                                                $sending = "<button class='btn btn-lg btn-primary btn-embossed half-width'
                                                onclick=\"buyTicketShow('buy-modal', 
                                                '".$ticketData[0][0]."', '".$ticketData[0][1]."', '".$ticketData[0][2]."');\">Buy</button>";

                                                echo $sending;
                                            }
                                            else
                                            {
                                                $sending = "<button class='btn btn-lg btn-primary btn-embossed half-width'
                                                onclick=\"modalShow('modal-wrapper');\">Buy</button>";

                                                echo $sending;
                                            }
                                        ?>
                                    </div>
                                </td>

                                <td align="center" width="33%">
                                    <div class="content-item">
                                        <img src="img/Children.png" width="80%" height="45%" style="margin-top: 10%">
                                        <p style="margin-top: 7%">Children Ticket</p>
                                        <p><?php echo "$".$ticketData[1][1]; ?></p>

                                        <?php
                                            if (isset($_SESSION['USER_LOGON']))
                                            {
                                                $sending = "<button class='btn btn-lg btn-primary btn-embossed half-width'
                                                    onclick=\"buyTicketShow('buy-modal', 
                                                    '".$ticketData[1][0]."', '".$ticketData[1][1]."', '".$ticketData[1][2]."');\">Buy</button>";

                                                echo $sending;
                                            }
                                            else
                                            {
                                                $sending = "<button class='btn btn-lg btn-primary btn-embossed half-width'
                                                    onclick=\"modalShow('modal-wrapper');\">Buy</button>";

                                                echo $sending;
                                            }
                                        ?>
                                    </div>
                                </td>

                                <td align="center" width="33%">
                                    <div class="content-item">
                                        <img src="img/Seniors.png" width="80%" height="45%" style="margin-top: 10%">
                                        <p style="margin-top: 7%">Seniors Ticket</p>
                                        <p><?php echo "$".$ticketData[2][1]; ?></p>

                                        <?php
                                            if (isset($_SESSION['USER_LOGON']))
                                            {
                                                $sending = "<button class='btn btn-lg btn-primary btn-embossed half-width'
                                                        onclick=\"buyTicketShow('buy-modal', 
                                                        '".$ticketData[2][0]."', '".$ticketData[2][1]."', '".$ticketData[2][2]."');\">Buy</button>";

                                                echo $sending;
                                            }
                                            else
                                            {
                                                $sending = "<button class='btn btn-lg btn-primary btn-embossed half-width'
                                                        onclick=\"modalShow('modal-wrapper');\">Buy</button>";

                                                echo $sending;
                                            }
                                        ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-custom">
                <div class="footer-item">
                    <table border="0">
                        <tr>
                            <td width="50%">
                                <p class="footertext">
                                    <img src="img/locate.png" class="Pic">  2 Chome-1-33 Sakurajima, Konohana Ward, Osaka, 554-0031, Japan<br>
                                    <img src="img/phone_contact.png" class="Pic">  +81 570-200-606<br>
                                </p>
                            </td>

                            <td width="50%">
                                <p class="footertext">
                                <p class="txt">"Let's share something special together"</p><br>
                                &nbsp<img src="img/facebook.png" class="Pic">&nbsp
                                &nbsp<img src="img/twitter.png" class="Pic">&nbsp
                                &nbsp<img src="img/instagram.png" class="Pic">&nbsp
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </footer>

        <!-- ========== [SCRIPT] ========== -->
        <script src="vendor/jquery/jquery-3.2.1.min.js"></script>

        <script src="vendor/bootstrap/js/popper.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

        <script src="vendor/select2/select2.min.js"></script>

        <script src="js/main.js"></script>

        <script src="js/smooth-scroll.js"></script>

        <script src="js/sweetalert2.all.min.js"></script>

        <?php
            if (isset($_POST['LOGIN']))
            {
                if ($_POST['LOGIN'])
                {
                    $alert = "Swal.fire({
                                         title: 'Login success!',
                                         text: 'Welcome ".$_SESSION['USER_LOGON']."\'s to Universal Studio Japan.',
                                         icon: 'success',
                                         confirmButtonText: 'Close'
                                       })";
                }
                else
                {
                    $alert = "Swal.fire({
                                         title: 'Login failed!',
                                         text: 'Oop! Something went wrong.',
                                         icon: 'error',
                                         confirmButtonText: 'Close'
                                       })";
                }

                echo "<script>".$alert."</script>";
            }

            if (isset($_POST['REGISTER']))
            {
                if ($_POST['REGISTER'])
                {
                    $alert = "Swal.fire({
                                         title: 'Register success!',
                                         text: 'Thank you, Have fun with your Holiday.',
                                         icon: 'success',
                                         confirmButtonText: 'Close'
                                       })";
                }
                else
                {
                    $alert = "Swal.fire({
                                         title: 'Register failed!',
                                         text: 'Oop! Something went wrong.',
                                         icon: 'error',
                                         confirmButtonText: 'Close'
                                       })";
                }

                echo "<script>".$alert."</script>";
            }

            if (isset($_POST['LOGOUT']))
            {
                $alert = "Swal.fire({
                                         title: 'Logout success!',
                                         text: 'Good bye, See you later.',
                                         icon: 'success',
                                         confirmButtonText: 'Close'
                                       })";

                echo "<script>".$alert."</script>";
            }

            if (isset($_POST['PURCHASE']))
            {
                if ($_POST['PURCHASE'])
                {
                    $alert = "Swal.fire({
                                         title: 'Purchase success!',
                                         text: 'Thank you, Let\'s play.',
                                         icon: 'success',
                                         confirmButtonText: 'Close'
                                        })";
                }
                else
                {
                    $alert = "Swal.fire({
                                         title: 'Purchase failed!',
                                         text: 'Oop! Money not enough.',
                                         icon: 'error',
                                         confirmButtonText: 'Close'
                                       })";
                }

                echo "<script>".$alert."</script>";
            }

            if (isset($_POST['PURCHASE-COUPON']))
            {
                if ($_POST['PURCHASE-COUPON'])
                {
                    $alert = "Swal.fire({
                                             title: 'Purchase success!',
                                             text: 'Thank you, Let\'s play.',
                                             icon: 'success',
                                             confirmButtonText: 'Close'
                                            })";
                }
                else
                {
                    $alert = "Swal.fire({
                                             title: 'Purchase failed!',
                                             text: 'Oop! Coupon is invalid.',
                                             icon: 'error',
                                             confirmButtonText: 'Close'
                                           })";
                }

                echo "<script>".$alert."</script>";
            }

            if (isset($_POST['OUT-OF-STOCK']))
            {
                $alert = "Swal.fire({
                                     title: 'Purchase failed!',
                                     text: 'Oop! Out of stock.',
                                     icon: 'error',
                                     confirmButtonText: 'Close'
                                   })";

                echo "<script>".$alert."</script>";
            }
        ?>

        <!--
        <script>
            var scroll = new SmoothScroll('a[href*="#"]', { speed: 300, speedAsDuration: true });
        </script>
        -->

        <script>
            var idSelected = "Nothing";

            function modalShow(id) {
                window.idSelected = id;
                document.getElementById(id).style.display='block';
            }

            function buyTicketShow(id, item, price, amount) {
                window.idSelected = id;
                document.getElementById(id).style.display='block';

                document.getElementById('ticket-img').src = "img/" + item + ".png";
                document.getElementById('ticket-item').innerHTML = item + " Ticket";
                document.getElementById('ticket-price').innerHTML = "$" + price;
                document.getElementById('ticket-amount').innerHTML = "In stock : " + amount;

                if (item == "Adult")
                    item = 1;
                else if (item == "Children")
                    item = 2;
                else if (item == "Seniors")
                    item = 3;

                document.getElementById('send-item').value = item;
                document.getElementById('send-price').value = price;
                document.getElementById('send-amount').value = amount;
            }

            function modalClose(id) {
                window.idSelected = id;
                document.getElementById(id).style.display='none';
            }
        </script>
    </body>
</html>