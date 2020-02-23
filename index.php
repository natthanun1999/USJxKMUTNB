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

        <link rel="stylesheet" href="sweetalert2.min.css">
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
                            <a class="nav-link" href="#">Home</a>
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

                            $_SESSION['PRE-PAGE'] = "index.php";

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

                                $sending = $sending."<a class='dropdown-item' href='Cart.php'> Cart </a>";
                                $sending = $sending."<a class='dropdown-item' href='Coupon.php'> Coupon </a>";
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
            </div>

            <div class="home-content">
                <div class="first">
                    <p class="title"> Universal Spectacle Night Parade </p>

                    <hr width="80%" class="line">

                    <p style="font-size: 2vw;">
                        <b>This enhanced parade brings new dimensions to life!</b>

                    <p style="font-size: 1vw; margin-bottom: 50px;">
                        Immerse yourself in this revolutionary parade! Experience the up-close excitement from the <br>
                        world of Harry Potter, witness the world's first transforming float from the universe of <br>
                        Transformers, feel the fury of the dinosaurs as you journey into Jurassic World, and encounter <br>
                        Minion Mayhem as the street turns into a Minions disco party.
                    </p>

                    <table width="90%" height="30%" class="image-table">
                        <tr>
                            <td width="33%" height="100%" style="padding-right: 5px">
                                <img src="img/news1-1.jpg" width="100%" height="50%">
                            </td>

                            <td width="33%" height="100%" style="padding-right: 5px">
                                <img src="img/news1-2.jpg" width="100%" height="50%">
                            </td>

                            <td width="33%" height="100%">
                                <img src="img/news1-3.jpg" width="100%" height="50%">
                            </td>
                        </tr>
                    </table>

                    <button class="btn btn-lg btn-primary btn-embossed default-width push">Read more</button>
                </div>

                <div class="second">
                    <p class="title"> Attack on Titan XR Ride <br> and Survey Corps Mess Hall </p>

                    <hr width="80%" size="10" class="line">

                    <p style="font-size: 2vw;">
                        <b>Flee for your life at mind-boggling speeds through a world of despair!</b>
                    </p>

                    <p style="font-size: 1vw; margin-bottom: 50px;">
                        Feel the terror of a Titan attack! XR technology sends you flying through the grim world of Attack on Titan. <br>
                        The Survey Corps is here with Mobility Gear to support! <br>
                        Experience the intense G-force of a roller coaster in a world of despair on this one-of-a-kind Attack on Titan attraction.
                    </p>

                    <table width="90%" height="30%" class="image-table">
                        <tr>
                            <td width="25%" height="100%" style="padding-right: 5px">
                                <img src="img/news2-1.jpg" width="100%" height="50%">
                            </td>

                            <td width="25%" height="100%" style="padding-right: 5px">
                                <img src="img/news2-2.jpg" width="100%" height="50%">
                            </td>

                            <td width="25%" height="100%" style="padding-right: 5px">
                                <img src="img/news2-3.jpg" width="100%" height="50%">
                            </td>

                            <td width="25%" height="100%">
                                <img src="img/news2-4.jpg" width="100%" height="50%">
                            </td>
                        </tr>
                    </table>

                    <button class="btn btn-lg btn-primary btn-embossed default-width push">Read more</button>
                </div>

                <div class="third">
                    <p class="title"> Detective Conan: The World </p>

                    <hr width="80%" size="10" class="line">

                    <p style="font-size: 2vw;">
                        <b>Conan faces his biggest challenge yet and needs your help!</b>
                    </p>

                    <p style="font-size: 1vw; margin-bottom: 50px;">
                        Conan fans rejoice! This year features 4 all-new experiences starring the world's littlest genius detective. Tackle puzzles with Conan and <br>
                        Akai to survive against all odds in Detective Conan: The Escape. Feel the rush of an FBI car chase in a brand-new audio adventure, <br>
                        Detective Conan x Hollywood Dream - The Ride. Become a full-fledged detective to help Heiji in Detective Conan Mystery Challenge. <br>
                        And team up with Amuro to crack a case at the Detective Conan Mystery Restaurant.
                    </p>

                    <table width="90%" height="30%" class="image-table">
                        <tr>
                            <td width="33%" height="100%" style="padding-right: 5px">
                                <img src="img/news3-1.jpg" width="100%" height="50%">
                            </td>

                            <td width="33%" height="100%" style="padding-right: 5px">
                                <img src="img/news3-2.jpg" width="100%" height="50%">
                            </td>

                            <td width="33%" height="100%" style="padding-right: 5px">
                                <img src="img/news3-3.jpg" width="100%" height="50%">
                            </td>
                        </tr>
                    </table>

                    <button class="btn btn-lg btn-primary btn-embossed default-width push">Read more</button>
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
        ?>

        <script>
            //var scroll = new SmoothScroll('a[href*="#"]', { speed: 300, speedAsDuration: true });
        </script>

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