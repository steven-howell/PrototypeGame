<?php

class Core {
    
    private $maxSaveSlots = 3;
    private $db;
    private $userAuthenticated = false;
    
    public function __construct() {
        $this->db = Skycore_Db_Connection::getInstance();
    }
    
    
    private function getSlotsUsed()
    {
        $q = "SELECT count(*) FROM saved_games WHERE sg_user = '".pg_escape_string($this->userAuthenticated)."'";
        $r = $this->db->request($q);
        return $r[0]['count'];
    }
  
  
    public function authUser($user, $pass)
    {
        $q = "SELECT * FROM accounts WHERE accounts_user = '".pg_escape_string($user)."' AND accounts_pass = '".pg_escape_string($pass)."'";
        $r = $this->db->request($q);
        if (!empty($r[0]['accounts_user'])) {
            $this->userAuthenticated = $r[0]['accounts_user'];
        }
    }
  
  
    public function SaveGame($Character, $WorldState)
    {
        if ($this->getSlotsUsed() < $this->maxSaveSlots) {
            
            $q = "INSERT INTO saved_games (sg_auth_user, sg_character, sg_world_state) VALUES ('".pg_escape_string($this->userAuthenticated)."', '".serialize($Character)."', '".serialize($WorldState)."')";
            $this->db->request($q);
            if (empty($db->error)) {
                return true;
            }
        }
        
        return false;
    }
    
    
    public function LoadGame($id)
    {
        $q = "SELECT * FROM saved_games WHERE sg_id = '".(int)$id."'";
        $r = $this->db->request($q);
        if (!empty($r)) {
            $character = unserialize($r[0]['sg_character']);
            $world_state = unserialize($r[0]['sg_world_State']);
            return array("character" => $character, "world_state" => $world_state);
        }
    }
    
}





?>