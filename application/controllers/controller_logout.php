<?php

class Controller_Logout extends Controller
{
    
    
    function action_index()
    {

        setcookie("id","",time()-3600,"/");
        setcookie("hash","",time()-3600,"/");


        header('HTTP/1.1 301 Moved Permanently');
        header('Location: /');
    }
}
