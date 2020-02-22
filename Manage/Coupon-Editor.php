<?php
    session_start();

    require('../Back-end/Connection.php');

    $_SESSION['PRE-PAGE'] = "Manage/Coupon-List.php";

    $fetchCoupon = "";

    if (isset($_POST['COUPON_ID']))
    {
        $couponID = $_POST['COUPON_ID'];

        $sql = "SELECT * FROM coupon WHERE COUPON_ID = '$couponID'";
        $resultCoupon = mysqli_query($db, $sql);

        $fetchCoupon = mysqli_fetch_assoc($resultCoupon);
    }
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

        <link rel="icon" href="../favicon.png">
    </head>

    <body>
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
                                if ($_SESSION['USER_STATUS'] == "1")
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
                                    $sending = $sending."<a class='dropdown-item' href='../Back-end/Logout.php'> Logout </a>";
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
                    <div class="jumbotron jumbotron-dark text-center">
                        <h1>Coupon Editor</h1>

                        <p>
                            Coupon is not perfect? Let's make it.
                        </p>
                    </div>

                    <div class="jumbotron jumbotron-dark">
                        <div class="col-md-6 mx-auto">
                            <input type="text" class="form-control push-sm" placeholder="Coupon ID"
                                   value="<?php echo $fetchCoupon['COUPON_ID']; ?>" disabled>

                            <form action="../Back-end/Coupon-Edit.php" method="POST">
                                <input type="hidden" name="COUPON_ID" value="<?php echo $fetchCoupon['COUPON_ID']; ?>">

                                <input type="text" name="RATE" class="form-control push-sm" placeholder="Discount rate(%)"
                                       value="<?php echo $fetchCoupon['COUPON_DISCOUNT']; ?>" required>

                                <select name="STATUS" class="form-control push-sm">
                                    <option value="Idle">Select coupon status</option>
                                    <option value="Idle" <?php if ($fetchCoupon['COUPON_STATUS'] == 'Idle') echo "selected"; ?> >Idle</option>
                                    <option value="Used" <?php if ($fetchCoupon['COUPON_STATUS'] == 'Used') echo "selected"; ?> >Used</option>
                                </select>

                                <input type="text" name="USER_ID" class="form-control push-sm" placeholder="Owner"
                                       value="<?php echo $fetchCoupon['USER_ID']; ?>">

                                <input type="text" name="TICKET_ID" class="form-control push-sm" placeholder="Ticket ID"
                                       value="<?php echo $fetchCoupon['TICKET_ID']; ?>">

                                <button type="submit" class="btn btn-lg btn-primary btn-embossed half-width push-m">Submit</button>
                            </form>
                        </div>
                    </div>
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