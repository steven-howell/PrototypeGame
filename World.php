<?php

class World {
    
    public $Items = array();
    public $enemies = 0;
    public $level = 1;
    public $type = "Main";
    public $global_id;
    
    
    public function __construct($type="Main", $id="world_state") {
        
        $this->type = $type;
        $this->global_id = $id;
        $this->generateNewWorld();
    }
        
    public function determineEntityCoordinates($EntityName) {
        
        $img_url = "https://dev.skycore.com:8012/platform/test/ProtoTypeGame/images/" . $EntityName . ".png";
        $size = getimagesize($img_url);
        
        $offlimit = true;
        
        $i = 0;
        
        while ($offlimit || $i >= 5) {
        
            $init_l1 = rand(0,1400);
            $init_t1 = rand(0,800);
            
            $init_l2 = $init_l1 + $size[0];
            $init_t2 = $init_t1 + $size[1];
            
            $offlimit = $this->checkOffLimit($init_l1, $init_t1, $init_l2, $init_t2);
            
            $i++;
        }
        
        if (!$offlimit) {
            return array($init_l1, $init_t1, $init_l2, $init_t2);
        }
        
        return false;
    }
    
    
    public function checkOffLimit($x3, $y3, $x4, $y4)
    {   
        if (!empty($this->Items)) {
            foreach ($this->Items as $value) {
            
                $x_off_limit = $y_off_limit = false;
                
                $x1 = $value['coordinates'][0];
                $y1 = $value['coordinates'][1];
                $x2 = $value['coordinates'][2];
                $y2 = $value['coordinates'][3];
                
                if ( ($x3 >= $x1 && $x3 <= $x2) || ($x4 >= $x1 && $x4 <= $x2) || ($x3 <= $x1 && $x4 >= $x2) ) {
                    $x_off_limit = true;
                }
                
                if ( ($y3 >= $y1 && $y3 <= $y2) || ($y4 >= $y1 && $y4 <= $y2) || ($y3 <= $y1 && $y4 >= $y2) ) {
                    $y_off_limit = true;
                }
                
                if ($x_off_limit && $y_off_limit) {
                    return true;
                }
            }
        }
        
        return false;
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
            
            // Make sure the new entity doesn't intersect with other entities already on the map
            $coordinates = $this->determineEntityCoordinates($entitiesToGen['classes'][$classIndex][$subClassIndex]);
            
            if ($coordinates !== false) {
            
                $this->Items[$entitiesToGen['classes'][$classIndex][$subClassIndex] . '_' . $i] = array(
                    'desc' => $entitiesToGen['descriptions'][$classIndex][$subClassIndex],
                    'entity' => $entitiesToGen['classes'][$classIndex][$subClassIndex],
                    'class' => $entitiesToGen['classTypes'][$classIndex],
                    'coordinates' => $coordinates
                );
            }
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