<?php

namespace Php\Package;

use Php\Package\Validators\StringValidator;

class Validator
{
    public function string()
    {
        return new StringValidator();
    }
}