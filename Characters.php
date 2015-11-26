<?php

abstract class Character {

    public $Weapon;
    public $currentHealth;
    public $currentArmor;    
    public $maxHealth;
    public $maxArmor;
    public $Inventory;
    public $name;
    public $gold = 0;
    public $score = 0;
    public $dead = false;
    
    public $Items = array();
    public $maxInventory;
    

    public function useWeapon($Opponent) {
        $this->Weapon->useWeapon($Opponent);
    }
    
    public function setWeapon($Weapon) {
        $this->Weapon = $Weapon;
    }
    
    public function setScore($score) {
        $this->score += $score;
    }
    
    public function setGold($gold) {
    
        if ($gold < 0 && ($this->gold + $gold) < 0) {
            return false;
        } else {
            $this->gold += $gold;
            return true;
        }
    }
    
    public function setDamage($damage) {
        
        if ($this->currentArmor == 0) {
            $this->setHealth($damage);
        } else {
            $this->setArmor(-1);
        }
    }
    
    public function setHealth($value) {
        
        if ( ($this->currentHealth + (int)$value) > $this->maxHealth) {
            $this->currentHealth = $this->maxHealth;
            echo $this->name . " has " . $this->currentHealth . " health!\r\n";
        } else if ( ($this->currentHealth + (int)$value) < 0) {
            $this->currentHealth = 0;

            $this->dead = true;
            echo $this->name . " has been defeated!\r\n";
            
        } else {            
            $this->currentHealth += (int)$value;
            echo $this->name . " has " . $this->currentHealth . " health!\r\n";
        }
    }
    
    public function setArmor($value) {
        
        if ( ($this->currentArmor + (int)$value) > $this->maxArmor) {
            $this->currentArmor = $this->maxArmor;
        } else if ( ($this->currentArmor + (int)$value) < 0) {
            $this->currentArmor = 0;
        } else {
            $this->currentArmor += (int)$value;
        }
        
        if ($this->currentArmor <= 0) {
            $this->removeArmor();
        }
    }
    
    public function removeArmor() {
        // Remove current armor from the inventory
        unset($this->Inventory->Items['ChestPlate']);
        unset($this->Inventory->Items['ArmorPants']);
        unset($this->Inventory->Items['Helmet']);
    }
    
    
    public function viewCharacterStatistics() {
        
        ob_start();
        
        ?>
        <table width="400">
            <tr>
                <td colspan="2" style="size:14px; font-family:arial;"><b><u>CHARACTER SUMMARY</u></b></td>
            <tr>
                <td><b>Name:</b></td>
                <td><?=$this->name;?></td>
            </tr>
            <tr>
                <td><b>Health:</b></td>
                <td><?=$this->currentHealth . "/" . $this->maxHealth;?></td>
            </tr>
            <tr>
                <td><b>Armor:</b></td>
                <td><?=$this->currentArmor . "/" . $this->maxArmor;?></td>
            </tr>
            <tr>
                <td><b>Weapon:</b></td>
                <td><?=get_class($this->Weapon);?> (Damage: <?=abs($this->Weapon->damage);?> HP)</td>
            </tr>
        </table>
        <?
        
        return ob_get_clean();
    }
}


class King extends Character {

    public function __construct($name, $gold=0) {
        
        // Set defaults
        $this->name = $name;
        $this->gold = $gold;
        $this->Weapon = new Sword();
        $this->currentHealth = 100;
        $this->currentArmor = 0;
        $this->maxHealth = 100;
        $this->maxArmor = 5;
        $this->maxInventory = 10;
        
        // Set Inventory
        $this->Inventory = new Inventory($this);
    }
}


class CitizenWoman extends Character {
    
    public function __construct($name, $gold=0) {
        $this->name = $name;
        $this->gold = $gold;
        $this->Weapon = new BowAndArrow();
        $this->currentHealth = 100;
        $this->currentArmor = 0;
        $this->maxHealth = 100;
        $this->maxArmor = 0;
        $this->maxInventory = 5;  
        
        // Set Inventory
        $this->Inventory = new Inventory($this);        
    }
}


class CitizenMan extends Character {
    
    public function __construct($name, $gold=0) {
        $this->name = $name;
        $this->gold = $gold;
        $this->Weapon = new BowAndArrow();
        $this->currentHealth = 100;
        $this->currentArmor = 0;
        $this->maxHealth = 100;
        $this->maxArmor = 0;
        $this->maxInventory = 5; 

        // Set Inventory
        $this->Inventory = new Inventory($this);        
    }
}


class CitizenChild extends Character {
    
    public function __construct($name, $gold=0) {
        $this->name = $name;
        $this->gold = $gold;
        $this->Weapon = new BowAndArrow();
        $this->currentHealth = 100;
        $this->currentArmor = 0;
        $this->maxHealth = 100;
        $this->maxArmor = 0;
        $this->maxInventory = 5;
        
        // Set Inventory
        $this->Inventory = new Inventory($this);        
    }
}


class Troll extends Character {
    
    public function __construct($name, $gold=0) {
        
        // Set defaults
        $this->name = $name;
        $this->gold = $gold;
        $this->Weapon = new Axe();
        $this->currentHealth = 15;
        $this->currentArmor = 0;
        $this->maxHealth = 15;
        $this->maxArmor = 0;
        $this->maxInventory = 5;
        
        // Set Inventory
        $this->Inventory = new Inventory($this);
    }
}


class Skeleton extends Character {
    
    public function __construct($name, $gold=0) {
        
        // Set defaults
        $this->name = $name;
        $this->gold = $gold;
        $this->Weapon = new BowAndArrow();
        $this->currentHealth = 25;
        $this->currentArmor = 0;
        $this->maxHealth = 25;
        $this->maxArmor = 0;
        $this->maxInventory = 5;
        
        // Set Inventory
        $this->Inventory = new Inventory($this);
    }
}



?>