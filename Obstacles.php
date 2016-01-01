<?php


abstract class Obstacle {
    
    public $breakable = false;

    abstract public function Action($Character);
}


class Bush extends Obstacle {
    
    public function __construct() {
        $this->breakable = true;
    }
    
    public function Action($Character) {
        // Item cannot be added/removed from inventory
    }
}

?>