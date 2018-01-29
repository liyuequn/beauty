<?php
namespace App\model\Operation;
class OperationAdd extends Operation {
    public function getResult()
    {
        return $this->number1 + $this->number2;
    }
}