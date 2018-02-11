<?php
namespace App\models\Operation;
class OperationAdd extends Operation {
    public function getResult()
    {
        return $this->number1 + $this->number2;
    }
}