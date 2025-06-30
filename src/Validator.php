<?php

namespace Php\Package;

use Php\Package\Validators\StringValidator;
use Php\Package\Validators\NumberValidator;

class Validator
{
    public function string()
    {
        return new StringValidator();
    }

    public function number()
    {
        return new NumberValidator();
    }
}