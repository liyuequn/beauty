<?php
namespace App\models\Operation;
class Operation{
    private $number1;
    private $number2;
    public function __set($property_name, $value)
    {
        $this->$property_name = $value;
    }
    public function __get($property_name)
    {
        if(isset($this->$property_name))
        {
            return($this->$property_name);
        }
        else
        {
            return(NULL);
        }
    }
    public function getResult ()
    {

    }
}