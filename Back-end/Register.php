<?php
    require('Connection.php');

    if (isset($_POST['USERNAME']) && isset($_POST['PASSWORD']))
    {
        $username = $_POST['USERNAME'];
        $password = $_POST['PASSWORD'];

        $sql = "INSERT INTO account(USERNAME, PASSWORD, STATUS_ID) VALUES('$username', '$password', '1')";
        $result = mysqli_query($db, $sql);

        if ($result != "")
        {
            echo "<script> alert('Register successful.'); </script>";
            echo "<script> window.history.back(); </script>";
        }
        else
        {
            echo "<script> alert('Error! : Register failed.'); </script>";
            echo "<script> window.history.back(); </script>";
        }
    }
    else
    {
        echo "<script> alert('Error! : Register failed.'); </script>";
        echo "<script> window.history.back(); </script>";
    }