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
                            <a class="nav-link" href="#">Promotion</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="Ticket.php">Ticket</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="Map.php">Map</a>
                        </li>

                        <?php
                            session_start();

                            $_SESSION['PRE-PAGE'] = "Promotion.php";

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
                                $sending = $sending."<a class='dropdown-item' href='Back-end/Logout.php'> Logout </a>";
                                $sending = $sending."</div>";

                                $sending = $sending."</li>";

                                echo $sending;
                            }
                        ?>

                        <!--
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                User's
                            </a>

                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="Profile.html">Profile</a>
                                <a class="dropdown-item" href="Logout.php">Logout</a>
                            </div>
                        </li>
                        -->
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
            </div>

            <div class="main-content">
                <div class="content-item">
                    <section class="resection push-bottom-lg" id="about">
                        <div class="jumbotron jumbotron-dark text-center">
                            <h1>SPECIAL OFFERS!</h1>

                            <p>
                                Make you to developer.
                            </p>
                        </div>

                        <div class="jumbotron jumbotron-dark text-center">
                            <div class="row">
                                <div class="promotion-item col-md-4">
                                    <div class="promotion-item-box">
                                        <img src="img/icons/table.png" alt="table">

                                        <p>
                                            <b>Buy 2 Days. Get  2 Days Free.</b>
                                            <br> > Double the thrills with two extra days at Universal Japan.
                                            <br> > Go all out in all three parks when you upgrade to include Volcano Bay for $40.
                                        </p>

                                        <button class="btn btn-lg btn-primary btn-embossed push-sm"
                                                onclick="window.location='Manage/Ticket-Insertion.php';">Enter</button>
                                    </div>
                                </div>

                                <div class="promotion-item col-md-4">
                                    <div class="promotion-item-box">
                                        <img src="img/icons/insert.png" alt="insert">

                                        <p>
                                            <b>Leap Year 2020</b>
                                            <br> > 29th Feb | 29% OFF*
                                            <br> > Offer is available both online and offline.
                                            <br> > This Offer is valid only on 29th February.

                                        </p>

                                        <button class="btn btn-lg btn-primary btn-embossed push-sm"
                                                onclick="window.location='Manage/Account-Insertion.php';">Enter</button>
                                    </div>
                                </div>

                                <div class="promotion-item col-md-4">
                                    <div class="promotion-item-box">
                                        <img src="img/icons/coupon.png" alt="food">

                                        <p>
                                            <b>Save 10% on Tickets<\b>
                                            <br> > Best Offer for Friends and Family.
                                            <br> > Book 7 or more tickets and save 10%.
                                        </p>

                                        <button class="btn btn-lg btn-primary btn-embossed push-sm"
                                                onclick="window.location='Manage/Coupon-Insertion.php';">Enter</button>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="promotion-item col-md-3">
                                    <div class="promotion-item-box">
                                        <img src="img/icons/tickets.png" alt="ticket">

                                        <p>
                                            Get an offer.
                                        </p>

                                        <button class="btn btn-lg btn-primary btn-embossed push-sm"
                                                onclick="window.location='Manage/Ticket-List.php';">Enter</button>
                                    </div>
                                </div>

                                <div class="promotion-item col-md-4">
                                    <div class="promotion-item-box">
                                        <img src="img/icons/edit.png" alt="edit">

                                        <p>
                                            Get an offer.
                                        </p>

                                        <button class="btn btn-lg btn-primary btn-embossed push-sm"
                                                onclick="window.location='Manage/Account-List.php';">Enter</button>
                                    </div>
                                </div>

                                <div class="promotion-item col-md-5">
                                    <div class="promotion-item-box">
                                        <img src="img/icons/discount.png" alt="discount">

                                        <p>
                                            Get an offer.
                                        </p>

                                        <button class="btn btn-lg btn-primary btn-embossed push-sm"
                                                onclick="window.location='Manage/Coupon-List.php';">Enter</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </main>



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
    </body>
</html>