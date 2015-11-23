<?php
require_once('functions.php');
session_start();

require_once('../Characters.php');
require_once('../Inventory.php');
require_once('../Items.php');
require_once('../World.php');

$Character = unserialize($_SESSION['character']);
$World = unserialize($_SESSION['world_state']);


$data = explode("_", $_GET['id']);
  
$class = $data[0];


$Character->Inventory->AddItem(new $class());

$World->removeItem($_GET['id']);

$_SESSION['character'] = serialize($Character);
$_SESSION['world_state'] = serialize($World);

echo json_encode(array('action' => 'obtain_item'));

?>