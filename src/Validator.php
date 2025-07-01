<?php

namespace Php\Package;

use Php\Package\Validators\StringValidator;
use Php\Package\Validators\NumberValidator;
use Php\Package\Interfaces\RequiredValidatorInterface;

class Validator implements RequiredValidatorInterface
{
    protected $params = [];

    public function string()
    {
        return new StringValidator();
    }

    public function number()
    {
        return new NumberValidator();
    }
    public function required()
    {
        $this->params['required'] = true;
    }
}