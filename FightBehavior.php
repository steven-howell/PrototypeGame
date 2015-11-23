<?php

class FightBehavior {

    public $Fighters = array();
    public $coinToss;
    public $EnemyIndex;
    
    public function __construct($Character, $Enemy) {
        
        // Determine who fights first
        $this->coinToss = rand(0,1);
        
        if ($this->coinToss == 0) {
            $this->EnemyIndex = 1;
            $this->Fighters[] = $Character;
            $this->Fighters[] = $Enemy;
        } else {
            $this->EnemyIndex = 0;
            $this->Fighters[] = $Enemy;
            $this->Fighters[] = $Character;
        }

    }
    
    
    public function CommenceFight() {
        
        $i = 2;
        
        ob_start();
        
        while (!$OtherFighter->dead) {
            
            $FighterIndex = $i % 2;
            if ($FighterIndex == 0) {
                $OtherFighterIndex = 1;
            } else {
                $OtherFighterIndex = 0;
            }
            
            $Fighter = $this->Fighters[$FighterIndex];
            $OtherFighter = $this->Fighters[$OtherFighterIndex];
            
            $Fighter->useWeapon($OtherFighter);
            
            
            $i++;
            
            if ($i > 200) {
                break;
            }
        }
        
        if ($this->Fighters[$this->coinToss]->dead) {
            $outcome = "fail";
            $message = "You have lost the fight against " . $this->Fighters[$this->EnemyIndex]->name . "!\r\n";
        } else {
            
            $this->Fighters[$this->coinToss]->setScore(10);
            $this->Fighters[$this->coinToss]->setGold($this->Fighters[$this->EnemyIndex]->gold);
            
            $outcome = "success";
            $message = "You have won the fight against " . $this->Fighters[$this->EnemyIndex]->name . "!\r\n";
        }
        
        $fight_details = ob_get_clean();
        
        
        return array('outcome' => $outcome, 'message' => $message, 'details' => $fight_details);
    }
    

}





?>