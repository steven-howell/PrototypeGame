<?php

interface iExplore {
    public function renderExplorable($id);
}


class Store implements iExplore {
    
    public $Inventory;
    
    public function __construct() {
        
        $this->Inventory = new Inventory();
        $this->generateInventory();
    }
    
    
    public function generateInventory() {
                
        $randomItemClass = array("Helmet", "ChestPlate", "HealthPotion", "HolyHandGrenade", "Poison", "ArmorPants");        
        $maxIndex = count($randomItemClass) - 1;
        
        for ($i=0; $i<10; $i++) {
            
            $ItemIndex = rand(0, $maxIndex);
            
            $class = $randomItemClass[$ItemIndex];
            
            $object = new $class();
            
            $this->Inventory->AddItem($object);
        } 
    }
    
    
    public function BuyItem($Character, $Item) {
        
        $goldCost = 0 - $Item->buy;
        
        // Charge the character the cost of the item.
        if ($Character->setGold($goldCost)) {
        
            // Add the item to the character's inventory
            $Character->Inventory->AddItem($Item);
            
            // Subtract the item from the store's inventory
            $this->Inventory->DiscardItem($Item);
        }
    }
    
    
    public function SellItem($Character, $Item) {
    
        $itemValue = $Item->sell;
        
        // Pay the character the value of the item.
        $Character->setGold($itemValue);
        
        // Discard the item from the Character's inventory
        $Character->Inventory->DiscardItem($Item);
        
        // Add the item to the Store's inventory
        $this->Inventory->AddItem($Item);
    
    }
    
    public function renderExplorable($id) {
        
        ob_start();
        
        // Display the store's inventory
        echo $this->Inventory->viewInventoryStore($id);
        
        ?>
        YOU ARE IN A STORE!
        <?
        
        
        return ob_get_clean();
        
    }  
}

?>