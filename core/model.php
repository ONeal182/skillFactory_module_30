<?php
class Model
{
    public $string;
    public function __construct()
    {
        $this->string = "MVC + PHP = Awesome!";
    }

    function get_connection()
    {
        return new PDO('mysql:host=192.168.31.94;dbname=default', 'root', '357391731');
    }

    
}