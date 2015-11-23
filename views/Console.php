<?php
require_once('functions.php');
session_start();

require_once('../Characters.php');
require_once('../Inventory.php');
require_once('../Items.php');
require_once('../Weapons.php');

$Character = unserialize($_SESSION['character']);

echo $Character->Inventory->viewInventory();

echo "<br /><br />";

echo $Character->viewCharacterStatistics();

?>

<br />
<a href="../Execute.php">Return To Game</a>