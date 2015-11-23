<?php

require_once('functions.php');
session_start();

require_once('../Characters.php');
require_once('../Inventory.php');
require_once('../Items.php');
require_once('../Explore.php');

$Character = unserialize($_SESSION['character']);
$Store = unserialize($_SESSION[$_GET['store']]);

// Count the number of the item in inventory
$quantityInStock = $Store->Inventory->getItemCountByType($_GET['item']);

if ($quantityInStock > 0) {
    
    $maxIndex = $quantityInStock - 1;
    
    // Grab from store's inventory
    $Store->BuyItem($Character, $Store->Inventory->Items[$_GET['item']][$maxIndex]);
}

$_SESSION['character'] = serialize($Character);
$_SESSION[$_GET['store']] = serialize($Store);

header("Location: ../views/ExploreStore.php?id=" . $_GET['store']);
exit;


?>