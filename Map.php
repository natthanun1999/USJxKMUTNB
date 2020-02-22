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
                            <a class="nav-link" href="#">Map</a>
                        </li>

                        <?php
                            session_start();

                            $_SESSION['PRE-PAGE'] = "Map.php";

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

            <div class="map-content">
                <div id="titletext" class="title">Studio Map</div>
            </div>

            <div class="map-content" align="center" >
                <img src="img/Map.jpg"  id="mapimage" >
            </div>
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-custom">
                <p class="footer-item"> Footer </p>
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