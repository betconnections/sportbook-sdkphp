<?php
    
    namespace SportBook\SDK;
    
    class CartConfirm extends Controller {
    
        public function combinedOnline(array $params = []) {
        
            return $this->_post('/ticket/cart/confirm/online/combined', $params)->SportsBook;
        }
    
        public function singleOnline(array $params = []) {
        
            return $this->_post('/ticket/cart/confirm/online/single', $params)->SportsBook;
        }
        
        public function combinedAgency(array $params = []) {
            
            return $this->_post('/ticket/cart/confirm/agency/combined', $params)->SportsBook;
        }
    
        public function singleAgency(array $params = []) {
        
            return $this->_post('/ticket/cart/confirm/agency/single', $params)->SportsBook;
        }
    
        public function combinedSales(array $params = []) {
        
            return $this->_post('/ticket/cart/confirm/sales/combined', $params)->SportsBook;
        }
        
    }