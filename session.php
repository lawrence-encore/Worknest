<?php
# -------------------------------------------------------------
#
# Name       : session.php
# Purpose    : This file checks the user session status.
#
# -------------------------------------------------------------

session_start(); # Start session

# Check if session logged_in is not equal to 1
if ($_SESSION['logged_in'] != 1) {
      # Destroy session
      session_unset();
      session_destroy();
      header('Location: index.php');
      exit();
}
else {
      $username = $_SESSION['username'];

      if($_SESSION['lock'] == 1){
            header('Location: lockscreen.php');
      }
}
?>