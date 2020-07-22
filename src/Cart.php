<?php
    
    namespace SportBook\SDK;
    
    class Cart extends Controller {
        
        public $confirm;
        
        public function __construct(array $args = []) {
            parent::__construct($args);
            
            $this->confirm = new CartConfirm($args);
        }
        
        public function get(array $params = []) {
            
            return $this->_get('/ticket/cart', $params)->SportsBook;
        }
        
        public function clear(array $params = []) {
            
            return $this->_delete('/ticket/cart', $params)->SportsBook;
        }
        
        public function add($odd_id, array $params = []) {
            
            return $this->_post('/ticket/cart/' . $odd_id, $params)->SportsBook;
        }
        
        public function delete($odd_id, array $params = []) {
            
            return $this->_delete('/ticket/cart/' . $odd_id, $params)->SportsBook;
        }
        
    }