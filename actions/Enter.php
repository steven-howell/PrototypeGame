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

// Dungeon, Cave, Store, etc.
$worldType = ucfirst(strtolower($data[0]));
if ($worldType == "Store") {
    $scriptName = "ExploreStore";
} else {
    $scriptName = "ExploreWorld";
}

echo json_encode(array('action' => 'goto_url', 'url' => 'views/'.$scriptName.'.php?id=' . $_GET['id'] . "&worldType=" . $worldType));

?>