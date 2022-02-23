<?php
# -------------------------------------------------------------
#
# Name       : date_default_timezone_set
# Purpose    : This sets the default timezone to PH.
#
# -------------------------------------------------------------

date_default_timezone_set('Asia/Manila');

# -------------------------------------------------------------
#
# Name       : Database Connection
# Purpose    : This is the place where your database login constants are saved
#
#              DB_HOST: database host, usually it's '127.0.0.1' or 'localhost', some servers also need port info
#              DB_NAME: name of the database. please note: database and database table are not the same thing
#              DB_USER: user for your database. the user needs to have rights for SELECT, UPDATE, DELETE and INSERT.
#              DB_PASS: the password of the above user
#
# -------------------------------------------------------------

define('DB_HOST', 'localhost');
define('DB_NAME', 'worknestdb');
define('DB_USER', 'worknest');
define('DB_PASS', 'qKHJpbkgC6t93nQr');

# -------------------------------------------------------------
#
# Name       : Encryption Key
# Purpose    : This is the serves as the encryption and decryption key of RC
#
# -------------------------------------------------------------

define('ENCRYPTION_KEY', 'DmXUT96VLxqENzLZks4M');

?>