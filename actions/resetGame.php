<?php
require_once('functions.php');
session_start();


session_unset();

header("Location: ../Execute.php");
exit;

?>