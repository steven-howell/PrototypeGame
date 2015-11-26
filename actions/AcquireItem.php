<?php
require_once('functions.php');
session_start();

require_once('../Characters.php');
require_once('../Inventory.php');
require_once('../Items.php');
require_once('../World.php');

$Character = unserialize($_SESSION['character']);

if (!isset($_GET['world_id'])) {
    $world_id = "world_state";
} else {
    $world_id = $_GET['world_id'];
}

$World = unserialize($_SESSION[$world_id]);


$data = explode("_", $_GET['id']);
  
$class = $data[0];


if ($Character->Inventory->AddItem(new $class())) {

    $World->removeItem($_GET['id']);

}

$_SESSION['character'] = serialize($Character);
$_SESSION[$world_id] = serialize($World);

echo json_encode(array('action' => 'obtain_item'));

?>