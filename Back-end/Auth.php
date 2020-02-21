<?php
    require('Connection.php');
    session_start();

    if (isset($_POST['USERNAME']) && isset($_POST['PASSWORD']))
    {
        $username = $_POST['USERNAME'];
        $password = $_POST['PASSWORD'];

        $sql = "SELECT * FROM account WHERE USERNAME = '$username' AND PASSWORD = '$password'";
        $result = mysqli_query($db, $sql);

        $fetch = mysqli_fetch_assoc($result);

        if ($fetch['ID'] != "")
        {
            $_SESSION['USER_LOGON'] = $username;

            echo "<script> alert('Welcome, ".$fetch['USERNAME']."\'s'); </script>";
            echo "<script> window.history.back(); </script>";
        }
        else
        {
            echo "<script> alert('Error! : Username or Password was wrong.'); </script>";
            echo "<script> window.history.back(); </script>";
        }
    }
    else
    {
        echo "<script> alert('Error! : Username or Password was wrong.'); </script>";
        echo "<script> window.history.back(); </script>";
    }