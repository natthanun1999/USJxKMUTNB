<?php
    session_start();

    $_SESSION['PRE-PAGE'] = "Games/Follow.php";

    require('../Back-end/Connection.php');

    $sql = "SELECT * FROM coupon_idle";
    $resultCoupon = mysqli_query($db, $sql);

    $sql = "SELECT COUNT(COUPON_ID) AS AMOUNT FROM coupon_idle";
    $resultAmount = mysqli_query($db, $sql);

    $fetchAmount = mysqli_fetch_assoc($resultAmount);

    $picked = rand(1, $fetchAmount['AMOUNT']);

    $couponID = "";
    $couponDiscount = "";

    $count = 1;

    while ($fetchCoupon = mysqli_fetch_assoc($resultCoupon))
    {
        if ($count == $picked)
        {
            $couponID = $fetchCoupon['COUPON_ID'];
            $couponDiscount = $fetchCoupon['COUPON_DISCOUNT'];
            break;
        }

        $count++;
    }

    echo "<script> var couponID = '$couponID'; var couponDiscount = '$couponDiscount'; var userID = '".$_SESSION['USER_ID']."'; </script>";
?>

<html>
    <head>
        <title>Universal Studio Japan by KMUTNB</title>

        <!-- Loading Bootstrap -->
        <link rel="stylesheet" href="../css/bootstrap.css">

        <!-- Loading Flat UI -->
        <link rel="stylesheet" href="../css/flat-ui.css">
        <link rel="stylesheet" href="../css/flat-web.css">

        <link rel="stylesheet" href="../css/style.css">

        <link rel="stylesheet" href="../css/Follow-Games.css">

        <link rel="icon" href="../favicon.png">
    </head>

    <body id="body">
        <header>
            <nav id="topbar" class="navbar navbar-expand-lg navbar-light bg-light navbared shadow-sm">
                <a class="navbar-brand" href="../index.php">USJ</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="width: 100%">
                    <ul class="navbar-nav mr-auto"> <!-- mr-auto -->
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="../Promotion.php">Promotion</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="../Ticket.php">Ticket</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="../Map.php">Map</a>
                        </li>

                        <?php
                            if (!isset($_SESSION['USER_LOGON']))
                            {
                                echo "<script> window.location.replace('../index.php'); </script>";
                            }
                            else
                            {
                                $sending = "<li class='nav-item dropdown'>"."\n";

                                $sending = $sending."<a class='nav-link dropdown-toggle' href='' id='navbarDropdown' role='button'";
                                $sending = $sending."data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                            ".$_SESSION['USER_LOGON']."'s [Balance : $".$_SESSION['USER_BALANCE']."]</a>";

                                $sending = $sending."<div class='dropdown-menu' aria-labelledby='navbarDropdown'>";

                                if ($_SESSION['USER_STATUS'] == "99")
                                    $sending = $sending."<a class='dropdown-item' href='../Manage.php'> Manage </a>";

                                $sending = $sending. "<a class='dropdown-item' href='../Cart.php'> Cart </a>";
                                $sending = $sending. "<a class='dropdown-item' href='../Coupon.php'> Coupon </a>";
                                $sending = $sending."<a class='dropdown-item' href='../Back-end/Logout.php'> Logout </a>";
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
                    <form class="modal-content animate" action="../Back-end/Auth.php" method="post">
                        <div class="img-container">
                            <span onclick="modalClose('modal-wrapper');" class="close" title="Close PopUp">&times;</span>
                            <img src="../1.png" alt="Avatar" class="avatar">
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
                    <form class="modal-content animate" action="../Back-end/Register.php" method="post">
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
            </div>

            <div class="games-content">
                <div class="container-item">
                    <div class="jumbotron jumbotron-dark text-center">
                        <h1>Follow the . . .</h1>

                        <p>
                            Follow something to get some reward.
                        </p>
                    </div>

                    <table class="content-item">
                        <tr>
                            <td id="R0-C0" class="trap-box" onmouseenter="HitTrap();"></td>
                            <td id="R0-C1" class="start-box" onclick="StartPath();">START</td>
                            <td id="R0-C2" class="trap-box" onmouseenter="HitTrap();"></td>
                            <td id="R0-C3" class="win-box" onmouseenter="EndPath();">WIN</td>
                            <td id="R0-C4" class="trap-box" onmouseenter="HitTrap();"></td>
                        </tr>

                        <tr>
                            <td id="R1-C0" class="trap-box" onmouseenter="HitTrap();"></td>
                            <td id="R1-C1" class="path-box" onmouseenter="ChangePathColor(id);"></td>
                            <td id="R1-C2" class="trap-box" onmouseenter="HitTrap();"></td>
                            <td id="R1-C3" class="path-box" onmouseenter="ChangePathColor(id);"></td>
                            <td id="R1-C4" class="trap-box" onmouseenter="HitTrap();"></td>
                        </tr>

                        <tr>
                            <td id="R2-C0" class="trap-box" onmouseenter="HitTrap();"></td>
                            <td id="R2-C1" class="path-box" onmouseenter="ChangePathColor(id);"></td>
                            <td id="R2-C2" class="trap-box" onmouseenter="HitTrap();"></td>
                            <td id="R2-C3" class="path-box" onmouseenter="ChangePathColor(id);"></td>
                            <td id="R2-C4" class="trap-box" onmouseenter="HitTrap();"></td>
                        </tr>

                        <tr>
                            <td id="R3-C0" class="trap-box" onmouseenter="HitTrap();"></td>
                            <td id="R3-C1" class="path-box" onmouseenter="ChangePathColor(id);"></td>
                            <td id="R3-C2" class="trap-box" onmouseenter="HitTrap();"></td>
                            <td id="R3-C3" class="path-box" onmouseenter="ChangePathColor(id);"></td>
                            <td id="R3-C4" class="trap-box" onmouseenter="HitTrap();"></td>
                        </tr>

                        <tr>
                            <td id="R4-C0" class="trap-box" onmouseenter="HitTrap();"></td>
                            <td id="R4-C1" class="path-box" onmouseenter="ChangePathColor(id);"></td>
                            <td id="R4-C2" class="path-box" onmouseenter="ChangePathColor(id);"></td>
                            <td id="R4-C3" class="path-box" onmouseenter="ChangePathColor(id);"></td>
                            <td id="R4-C4" class="trap-box" onmouseenter="HitTrap();"></td>
                        </tr>
                    </table>
                </div>
            </div>
        </main>

        <!-- ========== [SCRIPT] ========== -->
        <script src="../vendor/jquery/jquery-3.2.1.min.js"></script>

        <script src="../vendor/bootstrap/js/popper.js"></script>
        <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

        <script src="../vendor/select2/select2.min.js"></script>

        <script src="../js/main.js"></script>

        <script src="../js/smooth-scroll.js"></script>

        <script src="../js/sweetalert2.all.min.js"></script>

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

            function modalClose(id) {
                window.idSelected = id;
                document.getElementById(id).style.display='none';
            }
        </script>

        <script>
            var isStart = false;
            var isEnd = false;
            var previousPath = "";

            function StartPath() {
                if (!window.isEnd)
                {
                    document.getElementById('R0-C1').style.color = "#ffffff";
                    window.isStart = true;
                }
            }

            function EndPath() {
                var lastPath = document.getElementById('R1-C3').className;

                if (window.isStart && (lastPath == "pass-box"))
                {
                    document.getElementById('R0-C3').style.color = "#fff";

                    window.isStart = false;
                    window.isEnd = true;

                    Swal.fire({
                        title: 'Congratulation!',
                        text: 'You got ' + window.couponDiscount + '% discount. | Coupon Code : ' + window.couponID,
                        icon: 'success',
                        confirmButtonText: 'Close',
                        onClose: updateCoupon
                    });
                }
            }

            function ChangePathColor(id) {
                if (window.isStart)
                {
                    if (window.previousPath == "")
                    {
                        document.getElementById(id).className = "pass-box";
                        window.previousPath = document.getElementById(id).className;
                    }
                    else if (window.previousPath == "pass-box")
                    {
                        document.getElementById(id).className = "pass-box";
                        window.previousPath = document.getElementById(id).className;
                    }
                }
            }

            function HitTrap() {
                if (window.isStart && !window.isEnd)
                {
                    window.previousPath = "trap-box";

                    window.isStart = false;
                    window.isEnd = true;

                    Swal.fire({
                        title: 'Game over!',
                        text: 'Ah! You have lose this game T^T.',
                        icon: 'error',
                        confirmButtonText: 'Close'
                    });
                }
            }

            function updateCoupon() {
                var form = document.createElement('form');
                form.setAttribute('action', '../Back-end/Coupon-Edit.php');
                form.setAttribute('method', 'POST');
                form.setAttribute('id', 'CouponUpdate');

                var couponID = document.createElement('input');
                couponID.setAttribute('type', 'hidden');
                couponID.setAttribute('name', 'COUPON_ID');
                couponID.setAttribute('value', window.couponID);

                var couponDiscount = document.createElement('input');
                couponDiscount.setAttribute('type', 'hidden');
                couponDiscount.setAttribute('name', 'RATE');
                couponDiscount.setAttribute('value', window.couponDiscount);

                var status = document.createElement('input');
                status.setAttribute('type', 'hidden');
                status.setAttribute('name', 'STATUS');
                status.setAttribute('value', 'Idle');

                var userID = document.createElement('input');
                userID.setAttribute('type', 'hidden');
                userID.setAttribute('name', 'USER_ID');
                userID.setAttribute('value', window.userID);

                var ticketID = document.createElement('input');
                ticketID.setAttribute('type', 'hidden');
                ticketID.setAttribute('name', 'TICKET_ID');
                ticketID.setAttribute('value', '999999');

                form.appendChild(couponID);
                form.appendChild(couponDiscount);
                form.appendChild(status);
                form.appendChild(userID);
                form.appendChild(ticketID);

                document.getElementById('body').appendChild(form);

                window.CouponUpdate.submit();
            }
        </script>
    </body>
</html>