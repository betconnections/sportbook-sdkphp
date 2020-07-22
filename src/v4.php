<?php
    
    namespace SportBook\SDK;
    
    use SportBook\SDK\Auth\Session;
    
    class v4 {
        
        public $args = [];
        
        public function __construct(array $args = []) {
            if (isset($args['token'])) {
                $this->args['token'] = $args['token'];
            }
            
            if (isset($args['lang'])) {
                $this->args['lang'] = $args['lang'];
            }
        }
        
        public function auth(array $args = []) {
            
            return new Session(array_merge($this->args, $args));
        }
        
        public function ticket(array $args = []) {
            
            return new Ticket(array_merge($this->args, $args));
        }
        
        public function sport(array $args = []) {
            
            return new Sport(array_merge($this->args, $args));
        }
        
        public function client(array $args = []) {
            
            return new Client(array_merge($this->args, $args));
        }
        
        public function user(array $args = []) {
            
            return new User(array_merge($this->args, $args));
        }
        
        public function event(array $args = []) {
            
            return new Event(array_merge($this->args, $args));
        }
    
        public function cart(array $args = []) {
        
            return new Cart(array_merge($this->args, $args));
        }
        
    }