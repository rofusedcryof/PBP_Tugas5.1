<?php
// session_start();
// session_destroy();
// header("Location: index.php");
// exit();
require_once "config.php";
session_destroy();
header("Location: index.php");
exit();