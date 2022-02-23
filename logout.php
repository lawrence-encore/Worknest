<?php
# -------------------------------------------------------------
#
# Name       : logout.php
# Purpose    : This file logs out the user and destroy the sessions.
#
# -------------------------------------------------------------

session_start(); // Start session

require('config/config.php');
require('classes/api.php');
$api = new Api;

if (!isset($_SESSION['logged_in'])) {
	header('Location: index.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    session_unset();

    header('Location: index.php');
    exit();
}
 
?>