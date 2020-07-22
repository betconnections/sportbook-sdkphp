<?php
    
    namespace SportBook\SDK;
    
    class Controller {
        
        protected $version = 'x1';
        protected $url_base_web;
        protected $url_base_agency;
        protected $agency  = false;
        protected $client_token;
        protected $url;
        protected $exception;
        public    $token   = 'tokenFake';
        public    $args;
        
        public function __construct(array $args = []) {
            $this->url_base_web    = (function_exists('env') ? env('API_SPORTBOOKv4', 'http://v4.api.online.sportsbookplay.com') : 'http://v4.api.online.sportsbookplay.com');
            $this->url_base_agency = (function_exists('env') ? env('API_SPORTBOOKv4', 'http://v4.api.agency.sportsbookplay.com') : 'http://v4.api.agency.sportsbookplay.com');
            
            if (isset($args['agency'])) {
                if (is_bool($args['agency'])) {
                    $this->agency = $args['agency'];
                }
            }
            
            if (isset($args['token'])) {
                $this->client_token = (string)$args['token'];
            } else {
                $this->client_token = $this->token;
            }
            
            $this->args = $args;
            
            $this->exception = new Exception;
        }
        
        protected function _build_url($method) {
            $this->url = ($this->agency ? $this->url_base_agency : $this->url_base_web);
            
            return $this->url . '/' . $this->version . $method;
        }
        
        protected function _build_client_token() {
            
            return [
                'sportbookapi-token' => $this->client_token,
                'sbapi-token'        => $this->client_token,
            ];
        }
        
        public function _get($method, array $params = [], $api = true) {
            
            return $this->_curl($this->_build_url($method) . '?' . http_build_query(array_merge($this->args, $this->_build_client_token(), $params)), 'GET', [], $api);
        }
    
        public function _delete($method, array $params = [], $api = true) {
        
            return $this->_curl($this->_build_url($method) . '?' . http_build_query(array_merge($this->args, $this->_build_client_token(), $params)), 'DELETE', [], $api);
        }
        
        public function _post($method, array $params = [], $api = true) {
            
            return $this->_curl($this->_build_url($method), 'POST', ['data' => array_merge($this->args, $this->_build_client_token(), $params)], $api);
        }
        
        protected function _curl($url, $method, array $o = [], $api = true) {
            $options['http']['method'] = $method;
            
            if (isset($o['header'])) {
                $options['http']['header'] = $o['header'];
            }
            
            if (isset($o['data'])) {
                $options['http']['content'] = @http_build_query($o['data']);
            }
            
            $context = @stream_context_create($options);
            $content = @file_get_contents($url, false, $context);
            
            if ($api) {
                
                return json_decode($content);
            } else {
                
                return $content;
            }
        }
        
    }