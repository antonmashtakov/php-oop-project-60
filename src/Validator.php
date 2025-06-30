<?php

namespace Php\Package;

use Php\Package\Validators\StringValidator;

class Validator
{
    public function string()
    {
        return new StringValidator();
    }
//    public function __construct($level = 'easy')
//    {
//        switch ($level) {
//            case 'easy':
//                $this->strategy = new strategies\Easy();
//                break;
//            case 'normal':
//                $this->strategy = new strategies\Normal();
//                break;
//        }
//        $this->map = [
//            1 => array_fill(1, 3, null),
//            2 => array_fill(1, 3, null),
//            3 => array_fill(1, 3, null)
//        ];
//    }
}