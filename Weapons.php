<?php


interface iWeapon {
    public function useWeapon($Opponent);
}


class Knife implements iWeapon {
    
    public function __construct() {
        $this->damage = -6;
    }

    public function useWeapon($Opponent) {
        
        echo "Opponent " . $Opponent->name . " stabbed with a knife!\r\n";
        $Opponent->setDamage($this->damage);
    }
}

class BowAndArrow implements iWeapon {

    public function __construct() {
        $this->damage = -4;
    }

    public function useWeapon($Opponent) {
        
        echo "Opponent " . $Opponent->name . " shot with an arrow!\r\n";
        $Opponent->setDamage($this->damage);
    }
}

class Axe implements iWeapon {

    public function __construct() {
        $this->damage = -7;
    }

    public function useWeapon($Opponent) {
        
        echo "Opponent " . $Opponent->name . " struck with an axe!\r\n";
        $Opponent->setDamage($this->damage); 
    }
}

class Sword implements iWeapon {

    public function __construct() {
        $this->damage = -10;
    }
    
    public function useWeapon($Opponent) {
        
        echo "Opponent " . $Opponent->name . " struck with a sword!\r\n";
        $Opponent->setDamage($this->damage);
    }
}

?>