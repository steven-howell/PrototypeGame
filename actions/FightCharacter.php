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


$data = explode("_", $_GET['id']);  

if (!isset($_GET['world_id'])) {
    $world_id = "world_state";
} else {
    $world_id = $_GET['world_id'];
}

$class = $data[0];

// Generate the enemy class and store into sessions
if (!isset($_SESSION[$_GET['id']])) {
    $Enemy = new $class($class, rand(1,10));
    $_SESSION[$_GET['id']] = serialize($Enemy);
}    

echo json_encode(array('action' => 'goto_url', 'url' => 'https://dev.skycore.com:8012/platform/test/ProtoTypeGame/views/ShowBattle.php?id=' . $_GET['id'] . '&world_id=' . $world_id));

?>