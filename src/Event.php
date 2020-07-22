<?php
    
    namespace SportBook\SDK;
    
    class Event extends Controller {
        
        public function sport($sport_id, array $params = []) {
            
            return $this->_get("/event/sport/{$sport_id}", $params)->SportsBookPlay;
        }
    
        public function sportGroupOutcomes($sport_id, array $params = []) {
        
            return $this->_get("/event/sport/{$sport_id}/group-outcomes", $params)->SportsBookPlay;
        }
        
        public function id($event_id, array $params = []) {
            
            return $this->_get("/event/{$event_id}", $params)->SportsBookPlay;
        }
        
        public function seer(array $params = []) {
            
            return $this->_get("/event/seer", $params)->SportsBookPlay;
        }
        
        public function scores(array $params = []) {
            
            return $this->_get("/event/scores", $params)->SportsBookPlay;
        }
    
        public function upcoming(array $params = []) {
        
            return $this->_get("/event/upcoming", $params)->SportsBookPlay;
        }
    
        public function filter(array $params = []) {
        
            return $this->_get("/event/filter", $params)->SportsBookPlay;
        }
    
        public function league($league_id, array $params = []) {
        
            return $this->_get("/event/league/{$league_id}", $params)->SportsBookPlay;
        }
    
        public function sports(array $params = []) {
        
            return $this->_get("/event/sports", $params)->SportsBookPlay;
        }
        
    }