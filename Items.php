<?php


abstract class Item {
    
    public $frequency;
    public $buy;
    public $sell;
    public $description;
    public $addToInventory = true;
    public $MaxInventoryItem = 1;

    abstract public function AddItAction($Character);
    abstract public function UseItAction($Character);
    abstract public function RemoveItAction($Character);
}


class Heart extends Item {
    
    public function __construct() {
        $this->frequency = 10;
        $this->buy = 10;
        $this->sell = 5;
        $this->description = "Heart";
        $this->addToInventory = false;
    }
    
    
    public function AddItAction($Character)
    {
        // Item cannot be added/removed from inventory
    }
    
    public function UseItAction($Character)
    {
        $Character->setHealth(10);
    }
    
    public function RemoveItAction($Character)
    {
        // Item cannot be added/removed from inventory
    }    
    
}


class HealthPotion extends Item {
    
    public function __construct() {
        $this->frequency = 70;
        $this->buy = 40;
        $this->sell = 20;
        $this->description = "Health Potion";
        $this->MaxInventoryItem = 3;
    }
    
    public function AddItAction($Character) {
        // No action when added to inventory
    }
    
    public function UseItAction($Character)
    {
        $Character->setHealth(100);
    }
    
    public function RemoveItAction($Character) {
        // No action when removed from inventory
    }
}


class Poison extends Item {
    
    public function __construct() {
        $this->frequency = 80;
        $this->buy = 30;
        $this->sell = 15;
        $this->description = "Poison";
        $this->MaxInventoryItem = 3;
    }
    
    public function AddItAction($Character) {
        // No action when added to inventory
    }
    
    public function UseItAction($Character)
    {
        // Poison the target character
        $Character->setHealth(-20);
    }
    
    public function RemoveItAction($Character) {
        // No action when removed from inventory
    }
    
}


class HolyHandGrenade extends Item {
 
    public function __construct() {
        $this->frequency = 20;
        $this->buy = 150;
        $this->sell = 75;
        $this->description = "Holy Hand Grenade";
    }
    
    public function AddItAction($Character) {
        // No action when added to inventory
    }
    
    public function UseItAction($Character)
    {
        // Poison the target character
        $Character->setDamage(-50);
    }
    
    public function RemoveItAction($Character) {
        // No action when removed from inventory
    }
}


class Helmet extends Item {
    
    public function __construct() {
        $this->frequency = 50;
        $this->buy = 200;
        $this->sell = 100;
        $this->description = "Helmet";
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


class ChestPlate extends Item {
    
    public function __construct() {
        $this->frequency = 50;
        $this->buy = 250;
        $this->sell = 125;
        $this->description = "Chest Plate";
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


class ArmorPants extends Item {
    
    public function __construct() {
        $this->frequency = 50;
        $this->buy = 250;
        $this->sell = 125;
        $this->description = "Armored Pants";
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


class Gold extends Item {
    
    public function __construct() {
        $this->frequency = 10;
        $this->buy = 0;
        $this->sell = 0;
        $this->description = "Gold";
        $this->addToInventory = false;
    }
    
    
    public function AddItAction($Character)
    {
        // Gold cannot be added/removed from inventory.
    }
    
    
    public function UseItAction($Character)
    {
        $goldAmount = rand(1,10);
        $Character->setGold($goldAmount);
    }
    
    public function RemoveItAction($Character)
    {
        // No Remove action. Gold cannot be added/removed from inventory.
    }    
    
}

?>