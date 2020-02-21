<?php
    session_start();
    session_destroy();

    echo "<script> alert('Logout successful.'); </script>";
    echo "<script> window.history.back(); </script>";