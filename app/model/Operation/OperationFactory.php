<?php
namespace App\model\Operation;
class OperationFactory {
    public static function operationCreate ($operation){
        switch ($operation)
        {
            case "+":
                return new OperationAdd();
                break;
        }
    }
}