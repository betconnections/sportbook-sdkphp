<?php
    
    namespace SportBook\SDK;
    
    class User extends Controller {
        
        public function customize(array $params = []) {
            
            return $this->_post('/user/customize', $params)->SportBook;
        }
        
    }