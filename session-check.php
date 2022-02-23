<?php 
# -------------------------------------------------------------
#
# Name       : session-check.php
# Purpose    : This file is for checking session and re-directs accordingly.
#
# -------------------------------------------------------------

session_start(); # Start session

# Check if id is set on session
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1){
    header('location: dashboard.php'); # Redirect to dashboard.php
}
?>