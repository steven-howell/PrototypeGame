<?php
require_once('functions.php');
session_start();

require_once('../Core.php');
require_once('../FightBehavior.php');
require_once('../Weapons.php');
require_once('../Characters.php');
require_once('../Inventory.php');
require_once('../Items.php');
require_once('../World.php');
require_once('../Explore.php');


$data = explode("_", $_GET['id']);  
$class = $data[0];

$callScript = "Explore" . ucfirst(strtolower($class));

echo json_encode(array('action' => 'goto_url', 'url' => 'views/'.$callScript.'.php?id=' . $_GET['id']));

?>