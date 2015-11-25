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

$Character = unserialize($_SESSION['character']);
$World = unserialize($_SESSION['world_state']);

if (isset($_SESSION[$_GET['id']])) {
    $ExploreEntity = unserialize($_SESSION[$_GET['id']]);
}

if (!$ExploreEntity instanceof Store) {
    $ExploreEntity = new Store();
}


echo $ExploreEntity->renderExplorable($_GET['id']);

$_SESSION['character'] = serialize($Character);
$_SESSION['world_state'] = serialize($World);
$_SESSION[$_GET['id']] = serialize($ExploreEntity);
?>

<br /><br />
<a href="../Execute.php">Leave Store</a>