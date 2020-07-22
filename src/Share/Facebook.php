<?php
    
    namespace SportBook\SDK\Share;
    
    use Facebook\Exceptions\FacebookSDKException;
    
    class Facebook {
        
        public $helper;
        public $this;
        
        public function __construct(array $config = []) {
            
            $fb = new \Facebook\Facebook([
                'app_id'                => $config['id'],
                'app_secret'            => $config['secret'],
                'default_graph_version' => 'v2.2',
            ]);
            
            $this->helper = $fb->getRedirectLoginHelper();
            $this->this   = $fb;
        }
        
        public function getLoginURL(array $scopes = [], $callback) {
            
            return $this->helper->getLoginUrl($callback, $scopes);
        }
        
        public function getToken() {
            try {
                if (isset($_SESSION['fb_access_token'])) {
                    if ($_SESSION['fb_access_token'] != '') {
                        $this->this->setDefaultAccessToken($_SESSION['fb_access_token']);
                        
                        return $_SESSION['fb_access_token'];
                    }
                }
                
                $_SESSION['fb_access_token'] = (string)$this->helper->getAccessToken();
                
                $this->this->setDefaultAccessToken($_SESSION['fb_access_token']);
                
                return $_SESSION['fb_access_token'];
            } catch (FacebookSDKException $e) {
                
                return false;
            }
        }
        
        public function post(array $params = []) {
            
            return json_decode($this->this->post('/me/feed', $params)->getGraphNode()->asJson());
        }
        
        public function getProfile($profile = '/me', $fields = 'id,name,email') {
            
            return json_decode($this->this->get($profile . '?fields=' . $fields)->getGraphUser()->asJson());
        }
        
        public function postPhoto(array $params = []) {
            
            return json_decode($this->this->post('/me/photos', $params)->getGraphNode()->asJson());
        }
        
    }