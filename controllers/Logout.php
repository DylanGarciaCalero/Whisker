<?php

class LogoutController extends BaseController {

    protected function index () { 
        if(isset($_COOKIE["usercookie"])):
            setcookie("usercookie", '', time()-3600, '/');
        endif;
        header('Location: /');
    } 
}