<?php
    
    namespace SportBook\SDK\Share;
    
    use Abraham\TwitterOAuth\TwitterOAuth;
    
    class Twitter {
        
        public    $helper;
        public    $this;
        protected $consumer_key;
        protected $consumer_secret;
        
        public function __construct($consumer_key, $consumer_secret) {
            $this->consumer_key    = $consumer_key;
            $this->consumer_secret = $consumer_secret;
            
            if (isset($_SESSION['tw_oauth_token']) && isset($_SESSION['tw_oauth_token_secret'])) {
                $this->helper = new TwitterOAuth($this->consumer_key, $this->consumer_secret, $_SESSION['tw_oauth_token'], $_SESSION['tw_oauth_token_secret']);
            } else {
                $this->helper = new TwitterOAuth($this->consumer_key, $this->consumer_secret);
            }
        }
        
        public function getLoginURL($callback) {
            $request_token = $this->helper->oauth('oauth/request_token', ['oauth_callback' => $callback]);
            
            switch ($this->helper->getLastHttpCode()) {
                case 200:
                    $_SESSION['tw_oauth_token']        = $request_token['oauth_token'];
                    $_SESSION['tw_oauth_token_secret'] = $request_token['oauth_token_secret'];
                    
                    return $this->helper->url('oauth/authorize', ['oauth_token' => $request_token['oauth_token']]);
                    
                    break;
                default:
                    echo 'Could not connect to Twitter. Refresh the page or try again later.';
            }
            
            return 'url';
        }
        
        public function getToken() {
            if (isset($_REQUEST['oauth_verifier']) && isset($_SESSION['tw_oauth_token']) && isset($_SESSION['tw_oauth_token_secret'])) {
                $this->helper = new TwitterOAuth($this->consumer_key, $this->consumer_secret, $_SESSION['tw_oauth_token'], $_SESSION['tw_oauth_token_secret']);
                
                $access_token = $this->helper->oauth('oauth/access_token', [
                    'oauth_verifier' => $_REQUEST['oauth_verifier'],
                ]);
                
                return $_SESSION['tw_access_token'] = $access_token;
            }
            
            return false;
        }
        
    }