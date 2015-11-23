<?php
require_once('functions.php');
session_start();

require_once('../Characters.php');
require_once('../Inventory.php');
require_once('../Items.php');

$Character = unserialize($_SESSION['character']);

$count = $Character->Inventory->getItemCountByType($_GET['item']);
$maxIndex = $count - 1;

if ($maxIndex >= 0) {
    $Character->Inventory->UseItem($Character->Inventory->Items[$_GET['item']][$maxIndex], $Character);
}

$_SESSION['character'] = serialize($Character);

header("Location: ../views/Console.php");
exit;

?>