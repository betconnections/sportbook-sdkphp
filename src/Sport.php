<?php
    
    namespace SportBook\SDK;
    
    class Sport extends Controller {
        
        public function get(array $params = []) {
            
            return $this->_get('/sports', $params)->SportBook;
        }
    
        public function lists(array $params = []) {
        
            return $this->_get('/sports-list', $params)->SportBook;
        }
        
    }