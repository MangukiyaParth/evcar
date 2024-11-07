<?php
if (session_status() == PHP_SESSION_NONE || !isset($_SESSION)) {
    @session_start();
}

define("IS_DEVELOPMENT", true);
define("IS_PRODUCTION", (!IS_DEVELOPMENT));
if (IS_PRODUCTION) {
    define("API_SERVICE_URL", "https://" . $_SERVER['HTTP_HOST'] . "/api_services/");
    define("ADMIN_PANEL_URL", "https://" . $_SERVER['HTTP_HOST'] . "/admin_panel/");
    define("ROOT_URL", "https://" . $_SERVER['HTTP_HOST'] . "/");
    define("ALLOW_EXTERNAL_SCRIPT", "1");
    define("ALLOW_MIXPANEL_SCRIPT", "1");
} else {
    define("API_SERVICE_URL", "http://" . $_SERVER['HTTP_HOST'] . "/product/HTML/evcar/admin_panel/api_services/");
    define("ADMIN_PANEL_URL", "http://" . $_SERVER['HTTP_HOST'] . "/product/HTML/evcar/admin_panel/");
    define("ROOT_URL", "http://" . $_SERVER['HTTP_HOST'] . "/product/HTML/evcar/");
    define("ALLOW_EXTERNAL_SCRIPT", "0");
    define("ALLOW_MIXPANEL_SCRIPT", "0");
}
// dynamic end
class user_rights {
    private $rights;

    public function setRights($rights) {
        // $this->rights = $rights;
        $_SESSION['rights']=$rights;
    }
    public function getRights() {
        // return $this->rights;
        return isset($_SESSION['rights']) ? $_SESSION['rights'] : [];
    }
}

class user_details {
    private $user;

    public function setUser($user) {
        // $this->user = $user;
        $_SESSION['user']=$user;
    }
    public function getUser() {
        // return $this->user;
        return isset($_SESSION['user']) ? $_SESSION['user'] : [];
    }
}

class user_token {
    // private $token;
    public function setToken($token) {
        // $this->token = $token;
        $_SESSION['auth_token']=$token;
    }
    public function getToken() {
        // return $this->token;
        return isset($_SESSION['auth_token']) ? $_SESSION['auth_token'] : '';
    }
}