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
                            <a class="nav-link" href="Ticket.php">Ticket</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="Map.php">Map</a>
                        </li>

                        <?php
                            session_start();

                            $_SESSION['PRE-PAGE'] = "Coupon.php";

                            if (!isset($_SESSION['USER_LOGON']))
                            {
                                echo "<script> window.location.replace('index.php'); </script>";
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
                                $sending = $sending. "<a class='dropdown-item' href='#'> Coupon </a>";
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
                <!-- SHOW COUPON MODAL -->
                <div id="show-modal" class="modal">
                    <form class="modal-content animate">
                        <div class="img-container">
                            <span onclick="modalClose('show-modal');" class="close" title="Close PopUp">&times;</span>
                            <h1 style="text-align: center;">Coupon Information</h1>
                            <h3 style="text-align: center;" id="couponID">Coupon ID : </h3>
                            <h3 style="text-align: center;" id="couponDiscount">Discount : </h3>
                            <h3 style="text-align: center;" id="couponStatus">Status : </h3>
                        </div>

                        <div class="container">
                            <button type="button" class="cancel" onclick="modalClose('show-modal')">Close</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="main-content">
                <div class="content-item">
                    <div class="jumbotron jumbotron-dark text-center">
                        <h1>Your coupon</h1>

                        <p>
                            You can check your coupon below.
                        </p>
                    </div>

                    <div class="jumbotron jumbotron-dark text-center">
                        <?php
                            require('Back-end/Connection.php');

                            $sql = "SELECT * FROM coupon WHERE USER_ID = '".$_SESSION['USER_ID']."'";
                            $resultCoupon = mysqli_query($db, $sql);

                            $row = 1;

                            echo "<div class='row'>";

                            while ($fetchCoupon = mysqli_fetch_assoc($resultCoupon))
                            {
                                if ($fetchCoupon['COUPON_ID'] != "")
                                {
                                    $src = "";

                                    if ($row % 5 == 0)
                                        echo "<div class='row'>";

                                    if ($fetchCoupon['COUPON_STATUS'] == 'Idle')
                                        $src = "img/icons/coupon.png";
                                    else
                                        $src = "img/icons/discount.png";

                                    $sending = "<div class='showcase-item col-md-3'>
                                                    <div class='showcase-item-box'>
                                                        <img src='$src'>
                        
                                                        <p>
                                                            Discount ".$fetchCoupon['COUPON_DISCOUNT']."% (".$fetchCoupon['COUPON_STATUS'].")
                                                        </p>
                        
                                                        <button type='button' class='btn btn-lg btn-primary btn-embossed push-sm'
                                                        onclick=\"modalShow('show-modal', '".$fetchCoupon['COUPON_ID']."', '".$fetchCoupon['COUPON_DISCOUNT']."', '".$fetchCoupon['COUPON_STATUS']."')\"> More </button>
                                                    </div>
                                                </div>";

                                    echo $sending;

                                    if ($row % 4 == 0)
                                        echo "</div>";

                                    $row++;
                                }
                            }

                            echo "</div>";
                        ?>
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
        ?>

        <script>
            var idSelected = "Nothing";

            function modalShow(id, couponID, couponDiscount, couponStatus) {
                window.idSelected = id;
                document.getElementById(id).style.display='block';

                document.getElementById('couponID').innerText = "Coupon ID : " + couponID;
                document.getElementById('couponDiscount').innerText = "Discount : " + couponDiscount + "%";
                document.getElementById('couponStatus').innerText = "Status : " + couponStatus;
            }

            function modalClose(id) {
                window.idSelected = id;
                document.getElementById(id).style.display='none';
            }
        </script>
    </body>
</html>