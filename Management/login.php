<?php
session_start();

if (isset($_POST['password'])) {
    $pw = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    
    if ($pw == 'admin') {
        $_SESSION['logged-in'] = 'admin';
    }
     else {
        unset($_SESSION['logged-in']);
    }
}

if (isset($_POST['logout'])) {
    unset($_SESSION['logged-in']);
}

header('Location: view.php');

?>