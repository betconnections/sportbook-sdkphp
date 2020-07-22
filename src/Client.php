<?php
    
    namespace SportBook\SDK;
    
    class Client extends Controller {
        
        public function tec(array $params = []) {
            
            return $this->_get('/client/terms', $params)->SportBook;
        }
    
        public function config(array $params = []) {
        
            return $this->_get('/client/config', $params)->SportBook;
        }
        
    }