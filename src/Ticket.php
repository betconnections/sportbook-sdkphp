<?php
    
    namespace SportBook\SDK;
    
    class Ticket extends Controller {
        
        public function get($ticket_id, array $params = []) {
            
            return $this->_get('/ticket/' . $ticket_id, $params)->SportBook;
        }
        
        public function all(array $params = []) {
            
            return $this->_get('/ticket', $params)->SportBook;
        }
        
    }