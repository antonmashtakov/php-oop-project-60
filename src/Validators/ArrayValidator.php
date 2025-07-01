<?php

namespace Php\Package\Validators;

use Php\Package\Interfaces\ArrayValidatorInterface;
use Php\Package\Validator;

class ArrayValidator extends Validator implements ArrayValidatorInterface
{
    public function __construct(array $params = [])
    {
        $this->params = array_merge($this->params, $params);
    }

    public function isValid(array|null $array): bool
    {
        $isValid = ($this->params['required'] == true && is_null($array)) ? false : true;

        if (!empty($this->params['sizeof'])) {
            $isValid = (sizeof($array) == $this->params['sizeof']) ? true : false;
        }

        return $isValid;
    }

    public function sizeof(int $size)
    {
        $this->params['sizeof'] = $size;
        return new ArrayValidator($this->params);
    }
}