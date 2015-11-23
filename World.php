<?php

class World {
    
    public $Items = array();
    public $enemies = 0;
    public $level = 1;
    public $type = "Main";
    
    
    public function __construct($type="Main") {
        
        $this->type = $type;
        $this->generateNewWorld();
    }
    
    public function generateNewWorld()
    {        
        // Depending on the type of world we generate (main, dungeon, cave, etc) we generate world-specific entities and generate them at random
        $func = "generate" . $this->type;
        $entitiesToGen = $this->$func();
        
        $maxClassIndex = count($entitiesToGen['classes']) - 1;
        
        $min = $this->level * 10;
        $max = $min + 10;

        $ItemsQty = rand($min, $max);
        
        for ($i=0; $i<$ItemsQty; $i++) {
            
            $classIndex = rand(0, $maxClassIndex);            
            $subClassIndex = rand(0, count($entitiesToGen['classes'][$classIndex])-1);
            
            if ($entitiesToGen['classTypes'][$classIndex] == 'FightCharacter') {
                $this->enemies++;
            }
            
            $this->Items[$entitiesToGen['classes'][$classIndex][$subClassIndex] . '_' . $i] = array(
                'left' => rand(0,1400),
                'top' => rand(0,800),
                'desc' => $entitiesToGen['descriptions'][$classIndex][$subClassIndex],
                'entity' => $entitiesToGen['classes'][$classIndex][$subClassIndex],
                'class' => $entitiesToGen['classTypes'][$classIndex]
            );
        }
    }
    
    
    private function generateMain()
    {
        $Classes[0] = array('HealthPotion', 'Poison', 'Helmet', 'ChestPlate');
        $Descriptions[0] = array('Health Potion', 'Poison', 'Helmet', 'Chest Plate');
        
        $Classes[1] = array('Troll');
        $Descriptions[1] = array('Troll');
        
        $Classes[2] = array('Store', 'Dungeon');
        $Descriptions[2] = array('Store', 'Dungeon');
        
        $ClassTypes = array('AcquireItem','FightCharacter','Enter');

        return array("classes" => $Classes, "descriptions" => $Descriptions, "classTypes" => $ClassTypes);
    }
    
    
    private function generateDungeon() 
    {
        $Classes[0] = array('HealthPotion', 'Poison', 'Helmet', 'ChestPlate');
        $Descriptions[0] = array('Health Potion', 'Poison', 'Helmet', 'Chest Plate');
        
        $Classes[1] = array('Skeleton');
        $Descriptions[1] = array('Skeleton'); 

        $ClassTypes = array('AcquireItem', 'FightCharacter');

        return array("classes" => $Classes, "descriptions" => $Descriptions, "classTypes" => $ClassTypes);
    }
    
        
    private function generateCave()
    {
        
    }
    
    
    private function generateStore()
    {
        
    }
        
    
    public function removeItem($id)
    {
        if ($this->Items[$id]['class'] == 'FightCharacter') {
            $this->enemies--;
            
            if ($this->enemies == 0) {
                $this->proceedNextLevel(); 
            }
        }
        
        unset($this->Items[$id]);
    }
    
    public function removeAllItems()
    {
        $this->Items = array();
    }
    
    
    public function ProceedNextLevel() {
        $this->level++;
        $this->generateNewWorld();
    }
    
}





?>