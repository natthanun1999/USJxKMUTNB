<html>
    <head>
        <title>Universal Studio Japan by KMUTNB</title>

        <!-- Loading Bootstrap -->
        <link rel="stylesheet" href="css/bootstrap.css">

        <!-- Loading Flat UI -->
        <link rel="stylesheet" href="css/flat-ui.css">
        <link rel="stylesheet" href="css/flat-web.css">

        <link rel="stylesheet" href="css/style.css">

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
                            <a class="nav-link" href="Map.php">Map</a>
                        </li>

                        <?php
                            session_start();

                            $_SESSION['PRE-PAGE'] = "Manage.php";

                            if (!isset($_SESSION['USER_LOGON']))
                            {
                                echo "<script> window.location.replace('index.php'); </script>";
                            }
                            else
                            {
                                if ($_SESSION['USER_STATUS'] == "1")
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
                                        $sending = $sending."<a class='dropdown-item' href='#'> Manage </a>";

                                    $sending = $sending. "<a class='dropdown-item' href='Cart.php'> Cart </a>";
                                    $sending = $sending."<a class='dropdown-item' href='Back-end/Logout.php'> Logout </a>";
                                    $sending = $sending."</div>";

                                    $sending = $sending."</li>";

                                    echo $sending;
                                }
                            }
                        ?>
                    </ul>
                </div>
            </nav>
        </header>

        <main>
            <div class="main-content">
                <div class="content-item">
                    <section class="resection push-bottom-lg" id="about">
                        <div class="jumbotron jumbotron-dark text-center">
                            <h1>Do you want to managed something?</h1>

                            <p>
                                Make you to developer.
                            </p>
                        </div>

                        <div class="jumbotron jumbotron-dark text-center">
                            <div class="row">
                                <div class="showcase-item col-md-4">
                                    <div class="showcase-item-box">
                                        <img src="img/icons/table.png" alt="table">

                                        <p>
                                            Ticket insertion.
                                        </p>

                                        <button class="btn btn-lg btn-primary btn-embossed push-sm"
                                                onclick="window.location='Manage/Ticket-Insertion.php';">Enter</button>
                                    </div>
                                </div>

                                <div class="showcase-item col-md-5">
                                    <div class="showcase-item-box">
                                        <img src="img/icons/insert.png" alt="insert">

                                        <p>
                                            Account insertion.
                                        </p>

                                        <button class="btn btn-lg btn-primary btn-embossed push-sm"
                                                onclick="window.location='Manage/Account-Insertion.php';">Enter</button>
                                    </div>
                                </div>

                                <div class="showcase-item col-md-3">
                                    <div class="showcase-item-box">
                                        <img src="img/icons/coupon.png" alt="food">

                                        <p>
                                            Discount coupon insertion.
                                        </p>

                                        <button class="btn btn-lg btn-primary btn-embossed push-sm"
                                                onclick="window.location='Manage/Coupon-Insertion.php';">Enter</button>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="showcase-item col-md-3">
                                    <div class="showcase-item-box">
                                        <img src="img/icons/tickets.png" alt="ticket">

                                        <p>
                                            Check a ticket.
                                        </p>

                                        <button class="btn btn-lg btn-primary btn-embossed push-sm"
                                                onclick="window.location='Manage/Ticket-List.php';">Enter</button>
                                    </div>
                                </div>

                                <div class="showcase-item col-md-4">
                                    <div class="showcase-item-box">
                                        <img src="img/icons/edit.png" alt="edit">

                                        <p>
                                            Check someone account.
                                        </p>

                                        <button class="btn btn-lg btn-primary btn-embossed push-sm"
                                                onclick="window.location='Manage/Account-List.php';">Enter</button>
                                    </div>
                                </div>

                                <div class="showcase-item col-md-5">
                                    <div class="showcase-item-box">
                                        <img src="img/icons/discount.png" alt="discount">

                                        <p>
                                            Check discount coupon.
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
    </body>
</html>