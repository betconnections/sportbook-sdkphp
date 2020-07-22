<?php
    
    namespace SportBook\SDK\Auth;
    
    use SportBook\SDK\Controller;
    
    class Session extends Controller {
        
        public function online($token, array $params = []) {
            $curl = $this->_post('/auth/session/' . $token, $params, true);
            
            if (isset($curl->SportBook)) {
                $content = $curl->SportBook->response;
                
                if (isset($content->Session)) {
                    $response            = new \stdClass;
                    $response->session   = (string)$content->Session;
                    $response->timezone  = (string)$content->TimeZone;
                    $response->user_id   = (string)$content->User;
                    $response->client_id = (string)$content->Client;
                    $response->lang      = (string)$content->Lang;
                    $response->lobby     = 'http://web.sportbookapi.com/' . $response->session;
                    
                    return $response;
                } else {
                    
                    return $this->exception->_throw('Whoops! Something went wrong! ' . (string)$curl->SportBook->status->code . ' >> ' . (string)$curl->SportBook->status->description);
                }
            } else {
                
                return $this->exception->_throw('Whoops! Something went wrong! Incorrect format.');
            }
        }
        
        public function agency(array $params = []) {
            if (!isset($params['currency'])) {
                
                return $this->exception->_throw('Whoops! Something went wrong! Parameter currency required.');
            }
            
            $this->agency = true;
            $username     = (isset($params['username']) ? (string)$params['username'] : 'sportbook');
            
            $curl = $this->_post('/auth/session/username/' . $username, array_merge(['agency' => 'true'], $params), true);
            
            if (isset($curl->SportBook)) {
                $content = $curl->SportBook->response;
                
                if (isset($content->Session)) {
                    $response            = new \stdClass;
                    $response->session   = (string)$content->Session;
                    $response->timezone  = (string)$content->TimeZone;
                    $response->user_id   = (string)$content->User;
                    $response->client_id = (string)$content->Client;
                    $response->lang      = (string)$content->Lang;
                    $response->lobby     = 'http://agency.sportbookapi.com/' . $response->session;
                    
                    return $response;
                } else {
                    
                    return $this->exception->_throw('Whoops! Something went wrong! ' . (string)$curl->SportBook->status->code . ' >> ' . (string)$curl->SportBook->status->description);
                }
            } else {
                
                return $this->exception->_throw('Whoops! Something went wrong! Incorrect format.');
            }
        }
        
        public function verify($token, array $params = []) {
            
            return $this->_get('/auth/verify/' . $token, $params)->SportBook;
        }
        
    }