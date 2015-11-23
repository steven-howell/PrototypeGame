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

$Character = unserialize($_SESSION['character']);
$Enemy = unserialize($_SESSION[$_GET['id']]);
$World = unserialize($_SESSION['world_state']);

$Fight = new FightBehavior($Character, $Enemy);
$results = $Fight->CommenceFight();

?>
<table>
<tr>
<td style="text-align:center; vertical-align:top; width:100px; font-family:arial; font-weight:bold; size:14px; vertical-align:top;">
<?=$Character->name;?><br />
<img src="../images/<?=get_class($Character);?>.png" />
</td>
<td style="text-align:center; vertical-align:top; width:100px; font-family:arial; size:14px; vertical-align:top;"><h3>VS</h3></td>
<td style="text-align:center; vertical-align:top; width:100px; font-family:arial; font-weight:bold; size:14px; vertical-align:top;"><?=$Enemy->name;?><br />
<img src="../images/<?=get_class($Enemy);?>.png" />
</td>
</tr>
</table>

<?php

$fight_details = explode("\r\n", $results['details']);
if (!empty($fight_details)) {
    foreach ($fight_details as $value) {
        echo $value . "<br />";
    }
}

// Victory. Remove the enemy from the world.
if ($results['outcome'] == 'success') {
    $World->removeItem($_GET['id']);
    
    ?>
    <a href="../Execute.php">Back to World Map</a>
    <?

// Loss. Remove the entire world and display game over.
} else {
    $World->removeAllItems();
    echo "<h1>GAME OVER!</h1>";
}

$_SESSION['character'] = serialize($Character);
unset($_SESSION[$_GET['id']]);
$_SESSION['world_state'] = serialize($World);

?>

<br />
<a href="../Execute.php">Leave Battle</a>