<?php


interface iItem {

    public function AddItAction($Character);
    public function UseItAction($Character);
    public function RemoveItAction($Character);

}


class Heart implements iItem {
    
    public function __construct() {
        $this->buy = 10;
        $this->sell = 5;
        $this->description = "Heart";
        $this->addtoInventory = false;
        $this->maxInventoryItem = 0;
    }
    
    public function AddItAction($Character) {
        // Item cannot be added/removed from inventory
    }
    
    public function UseItAction($Character) {
        
        echo "Heart used on " . $Character->name . "\r\n";
        $Character->setHealth(10);
    }
    
    public function RemoveItAction($Character) {
        // Item cannot be added/removed from inventory
    }
}


class HealthPotion implements iItem {
    
    public function __construct() {
        $this->buy = 40;
        $this->sell = 20;
        $this->description = "Health Potion";
        $this->addToInventory = true;
        $this->MaxInventoryItem = 3;
    }
    
    public function AddItAction($Character) {
        // No action when added to inventory
    }
    
    public function UseItAction($Character)
    {
        echo "Health potion used on " . $Character->name . "\r\n";
        $Character->setHealth(100);
    }
    
    public function RemoveItAction($Character) {
        // No action when removed from inventory
    }
}


class Poison implements iItem {
    
    public function __construct() {
        $this->buy = 30;
        $this->sell = 15;
        $this->description = "Poison";
        $this->addToInventory = true;
        $this->MaxInventoryItem = 3;
    }
    
    public function AddItAction($Character) {
        // No action when added to inventory
    }
    
    public function UseItAction($Character)
    {
        // Poison the target character
        echo "Poison used on " . $Character->name . "\r\n";
        $Character->setHealth(-20);
    }
    
    public function RemoveItAction($Character) {
        // No action when removed from inventory
    }
    
}


class HolyHandGrenade implements iItem {
 
    public function __construct() {
        $this->buy = 150;
        $this->sell = 75;
        $this->description = "Holy Hand Grenade";
        $this->addToInventory = true;
        $this->MaxInventoryItem = 1;
    }
    
    public function AddItAction($Character) {
        // No action when added to inventory
    }
    
    public function UseItAction($Character)
    {
        // Poison the target character
        echo "Holy Hand Grenade used on " . $Character->name . "\r\n";
        $Character->setDamage(-50);
    }
    
    public function RemoveItAction($Character) {
        // No action when removed from inventory
    }
}


class Helmet implements iItem {
    
    public function __construct() {
        $this->buy = 200;
        $this->sell = 100;
        $this->description = "Helmet";
        $this->addToInventory = true;
        $this->MaxInventoryItem = 1;
    }
    
    public function AddItAction($Character)
    {
        $Character->setArmor(1);    
    }
    
    public function UseItAction($Character)
    {
        // Item is in use when added to inventory
    }
    
    public function RemoveItAction($Character)
    {
        $Character->setArmor(-1);
    }
}


class ChestPlate implements iItem {
    
    public function __construct() {
        $this->buy = 250;
        $this->sell = 125;
        $this->description = "Chest Plate";
        $this->addToInventory = true;
        $this->MaxInventoryItem = 1;
    }
    
    
    public function AddItAction($Character)
    {
        $Character->setArmor(2);
    }
    
    public function UseItAction($Character)
    {
        // Item is in use when added to inventory
    }
    
    public function RemoveItAction($Character)
    {
        $Character->setArmor(-2);
    }
}


class ArmorPants implements iItem {
    
    public function __construct() {
        $this->buy = 250;
        $this->sell = 125;
        $this->description = "Armored Pants";
        $this->addToInventory = true;
        $this->MaxInventoryItem = 1;
    }
    
    public function AddItAction($Character)
    {
        $Character->setArmor(2);
    }
    
    public function UseItAction($Character)
    {
        // Item is in use when added to inventory
    }
    
    public function RemoveItAction($Character)
    {
        $Character->setArmor(-2);
    }
}

?>