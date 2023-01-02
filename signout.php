<?php

session_start();

unset($_SESSION['is_logged']);
unset($_SESSION['logged_user_id']);
unset($_SESSION['logged_user_login']);

header('Location: index.php');