<?php


class Inventory {
    
    public $Items;
    public $Character;
    public $currentItems = 0;
    public $maxInventory = 20;
    
    public function __construct($Character="")
    {
        $this->Character = $Character;
    }
    
    public function getItemCountByType($className) {
        return count($this->Items[$className]);
    }
    
    public function UseItem($Item, $targetCharacter) {
        
        $className = get_class($Item);
        
        $itemCount = $this->getItemCountByType($className);
        
        if ($itemCount > 0) {
        
            // Use the item on the target character
            $Item->UseItAction($targetCharacter);
            
            // Now discard the item from the inventory.
            $this->DiscardItem($Item);
            
        } else {
            echo "Cannot use " . $className . "! It is not in your inventory!\r\n";
        }
    } 
    
    
    public function AddItem($Item) {
        
        $className = get_class($Item);
        
        $itemCount = $this->getItemCountByType($className);
        
        // If item can only be used on-the-spot and not added to the inventory
        if (!$Item->addToInventory) {
           
            // If the character object is set, then use the item
            if (is_object($this->Character)) {
                $Item->UseItAction($this->Character);
                return true;
            }
            
        // If item can be added to inventory and inventory size is less than maximum, add item and execute Add action
        } else {

            if ($this->currentItems < $this->maxInventory && $itemCount < $Item->MaxInventoryItem) {
                $this->Items[$className][] = $Item;
    
                if (is_object($this->Character)) {
                    $Item->AddItAction($this->Character);
                }
                
                $this->currentItems++;
                
                return true;
            }
        }
        
        return false;       
    }
    
    public function DiscardItem($Item) {
        
        $className = get_class($Item); 
        
        $maxIndex = $this->getItemCountByType($className) - 1;
                
        if ($maxIndex >= 0) {
            
            // Removes the item from inventory
            unset($this->Items[$className][$maxIndex]);
            
            if (empty($this->Items[$className])) {
                unset($this->Items[$className]);
            }

            // Executes any action upon removing item from inventory
            if (is_object($this->Character)) {
                $Item->RemoveItAction($this->Character); 
            }
            
            $this->currentItems--;
        
            return true;
        } else {
            
            return false;
        }
    }


    public function viewInventory()
    {        
        ob_start();
        
        ?>
        <table width="400">
            <tr>
                <td colspan="4" style="size:14px; font-family:arial;"><b><u>INVENTORY</u></b></td>
            </tr>
            <tr>
                <td><b>Items</b></td>
                <td><b>Quantity</b></td>
                <td><b>Use</b></td>
                <td><b>Remove</b></td>
            </tr>
            <?php
            if (!empty($this->Items)) {
                
                foreach ($this->Items as $Item_Array) {
                    ?>
                    <tr>
                        <td><?=$Item_Array[0]->description;?></td>
                        <td><?=count($Item_Array);?></td>
                        <td><a href="../actions/UseItem.php?item=<?=get_class($Item_Array[0]);?>">Use</a></td>
                        <td><a href="../actions/RemoveItem.php?item=<?=get_class($Item_Array[0]);?>">Remove</a></td>
                    </tr>
                    <?
                }
            } else {
                ?>
                <tr>
                    <td colspan="4" style="text-align:center;"><i>No items in your inventory</i></td>
                </tr>
                <?
            }
            ?>
        </table>
        <?
        
        return ob_get_clean();
        
    }

    
    public function viewInventoryStore($storeid)
    {       
        ob_start();
        
        ?>
        <table width="400">
            <tr>
                <td colspan="4" style="size:14px; font-family:arial;"><b><u>WELCOME TO THIS STORE!</u></b></td>
            </tr>
            <tr>
                <td><b>For Sale</b></td>
                <td><b>Quantity</b></td>
                <td><b>Cost</b></td>
                <td><b>Buy</b></td>
            </tr>
            <?php
            if (!empty($this->Items)) {
                
                foreach ($this->Items as $Item_Array) {
                    ?>
                    <tr>
                        <td><?=$Item_Array[0]->description;?></td>
                        <td><?=count($Item_Array);?></td>
                        <td><?=$Item_Array[0]->buy;?></td>
                        <td><a href="../actions/BuyItem.php?item=<?=get_class($Item_Array[0]);?>&store=<?=$storeid;?>">Buy</a></td>
                    </tr>
                    <?
                }
            } else {
                ?>
                <tr>
                    <td colspan="4" style="text-align:center;"><i>No items in the Store's Inventory</i></td>
                </tr>
                <?
            }
            ?>
        </table>
        <?
        
        return ob_get_clean();    
    }
    
}

?>