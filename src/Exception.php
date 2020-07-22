<?php
    
    namespace SportBook\SDK;
    
    final class Exception {
        
        public function _throw($msg) {
            throw new \Exception($msg);
        }
        
    }