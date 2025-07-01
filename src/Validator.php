<?php

namespace Php\Package;

use Php\Package\Validators\StringValidator;
use Php\Package\Validators\NumberValidator;
use Php\Package\Validators\ArrayValidator;
use Php\Package\Interfaces\RequiredValidatorInterface;

class Validator implements RequiredValidatorInterface
{
    protected $params = [
        'required' => false,
    ];
    public function string()
    {
        return new StringValidator();
    }
    public function number()
    {
        return new NumberValidator();
    }
    public function array()
    {
        return new ArrayValidator();
    }
    public function required()
    {
        $this->params['required'] = true;
    }
}