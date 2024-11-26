<?php
    // Mobile_Detect library code goes here
    // This is a simplified version of the Mobile_Detect library
    // For full functionality, use the complete library from https://github.com/serbanghita/Mobile-Detect
    class Mobile_Detect {
        protected $userAgent;
        protected $isMobile = false;
        protected $isTablet = false;

        public function __construct() {
            $this->userAgent = $_SERVER['HTTP_USER_AGENT'];
            $this->detectDevice();
        }

        protected function detectDevice() {
            if (preg_match('/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|ipad|ipod|ipphone|iseries|java|j2me|midp|mini|mmp|mobile.+firefox|mobile.+safari|motorola|mot\-|nokia|opera\s+mini|palm|panasonic|philips|phone|playbook|plucker|pocket|psp|series(4|6)0|sgh\-|sharp|sie\-|smartphone|sony|symbian|treo|up\.(browser|link)|vodafone|wap|windows\s+(ce|phone)|xda|xiino)/i', $this->userAgent)) {
                $this->isMobile = true;
            }

            if (preg_match('/(ipad|tablet|(android(?!.*mobile))|(windows(?!.*phone)(.*touch))|kindle|playbook|silk|(puffin(?!.*(IP|AP|WP))))/i', $this->userAgent)) {
                $this->isTablet = true;
            }
        }

        public function isMobile() {
            return $this->isMobile;
        }

        public function isTablet() {
            return $this->isTablet;
        }
    }
    ?>
