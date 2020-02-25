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

        <link rel="stylesheet" type="text/css" href="../css/ticket-table.css">
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
                            session_start();

                            $_SESSION['PRE-PAGE'] = "Manage/Ticket-List.php";

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
                                    $sending = $sending. "<a class='dropdown-item' href='../Coupon.php'> Coupon </a>";
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
            <div class="table-content">
                <div class="limiter">
                    <div class="container-table100">
                        <div class="wrap-table100">
                            <div class="table100">
                                <div class="jumbotron jumbotron-dark text-center">
                                    <h1>Ticket List</h1>

                                    <p>
                                        If you want to edit some ticket data, You can do right here!
                                    </p>
                                </div>

                                <!-- Search Box -->
                                <form action="Ticket-List.php" method="GET">
                                    <input name="search" type="search" class="form-control input-sm half-width position-mid-v" placeholder="Search with ticket id"
                                           value="<?php if (isset($_GET['search'])) echo $_GET['search']; ?>" autofocus>
                                </form>

                                <table class="push-m">
                                    <thead>
                                        <tr class="table100-head">
                                            <th class="column1">Ticket ID</th>
                                            <th class="column2">Type</th>
                                            <th class="column3">Status</th>
                                            <th class="column4">Owner</th>
                                            <th class="column5">Edit</th>
                                            <th class="column6">Delete</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                            if (isset($_GET['search']))
                                            {
                                                // Create connection to DB
                                                require('../Back-end/Connection.php');

                                                $ticketID = $_GET['search'];

                                                $sql = "SELECT TICKET_ID, ticket_type.TYPE_NAME, TICKET_STATUS, USER_ID FROM ticket JOIN ticket_type
                                                        ON ticket.TYPE_ID = ticket_type.TYPE_ID WHERE TICKET_ID like '%".$ticketID."%' OR ticket_type.TYPE_NAME like '%".$ticketID."%'";
                                                $resultAccount = mysqli_query($db, $sql);

                                                // Fetch each row in an associative array
                                                //echo '<table border="1">';

                                                while ($row = mysqli_fetch_array($resultAccount))
                                                {
                                                    echo "<tr>";

                                                    for ($n = 1; $n <= 4; $n++)
                                                        echo "<td class='column$n'>".($row[$n - 1] !== '9999' ? htmlentities($row[$n - 1], ENT_QUOTES) : "-")."</td>"; //&nbsp

                                                    echo "<form action='Ticket-Editor.php' method='POST'> 
                                                          <td class='column5'> 
                                                            <input type='hidden' name='TICKET_ID' value='$row[0]'>
                                                            <button type='submit' class='btn btn-sm btn-primary btn-embossed'>Edit</button>
                                                          </td> </form>";

                                                    echo "<form action='../Back-end/Ticket-Delete.php' method='POST'>
                                                          <td class='column6'>
                                                            <input type='hidden' name='TICKET_ID' value='$row[0]'> 
                                                            <button type='submit' class='btn btn-sm btn-primary btn-embossed'>Delete</button>
                                                          </td> </form>";

                                                    echo "</tr>";
                                                }
                                            }
                                            else
                                            {
                                                // Create connection to DB
                                                require('../Back-end/Connection.php');

                                                $sql = "SELECT TICKET_ID, ticket_type.TYPE_NAME, TICKET_STATUS, USER_ID FROM ticket JOIN ticket_type
                                                        ON ticket.TYPE_ID = ticket_type.TYPE_ID";
                                                $resultAccount = mysqli_query($db, $sql);

                                                // Fetch each row in an associative array
                                                //echo '<table border="1">';

                                                while ($row = mysqli_fetch_array($resultAccount))
                                                {
                                                    $n = 1;

                                                    echo "<tr>";

                                                    for ($n = 1; $n <= 4; $n++)
                                                        echo "<td class='column$n'>".($row[$n - 1] !== '9999' ? htmlentities($row[$n - 1], ENT_QUOTES) : "-")."</td>"; //&nbsp

                                                    echo "<form action='Ticket-Editor.php' method='POST'> 
                                                          <td class='column5'> 
                                                            <input type='hidden' name='TICKET_ID' value='$row[0]'>
                                                            <button type='submit' class='btn btn-sm btn-primary btn-embossed'>Edit</button>
                                                          </td> </form>";

                                                    echo "<form action='../Back-end/Ticket-Delete.php' method='POST'>
                                                          <td class='column6'>
                                                            <input type='hidden' name='TICKET_ID' value='$row[0]'> 
                                                            <button type='submit' class='btn btn-sm btn-primary btn-embossed'>Delete</button>
                                                          </td> </form>";

                                                    echo "</tr>";
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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
            if (isset($_POST['EDIT']))
            {
                if ($_POST['EDIT'])
                {
                    $alert = "Swal.fire({
                                             title: 'Edit success!',
                                             text: 'Let\'s customer purchase us.',
                                             icon: 'success',
                                             confirmButtonText: 'Close'
                                           })";
                }
                else
                {
                    $alert = "Swal.fire({
                                             title: 'Edit failed!',
                                             text: 'Oop! Something went wrong.',
                                             icon: 'error',
                                             confirmButtonText: 'Close'
                                           })";
                }

                echo "<script>".$alert."</script>";
            }

            if (isset($_POST['DELETE']))
            {
                if ($_POST['DELETE'])
                {
                    $alert = "Swal.fire({
                                         title: 'Delete success!',
                                         text: 'Whew! We lost some ticket.',
                                         icon: 'success',
                                         confirmButtonText: 'Close'
                                       })";
                }
                else
                {
                    $alert = "Swal.fire({
                                         title: 'Delete failed!',
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
    </body>
</html>