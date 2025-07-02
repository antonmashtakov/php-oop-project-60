<?php

namespace Php\Package\Validators;

use Php\Package\Interfaces\ArrayValidatorInterface;
use Php\Package\Validator;

class ArrayValidator extends Validator implements ArrayValidatorInterface
{
    public function isValid(array|null $array): bool
    {
        $isValid = ($this->params['required'] == true && is_null($array)) ? false : true;

        if (!is_null($array)) {
            if (!empty($this->params['sizeof'])) {
                $isValid = (sizeof($array) == $this->params['sizeof']) ? true : false;
            }

            if (!empty($this->params['shape'])) {
                $resValid = true;
                collect($array)->map(function ($value, $key) use (&$resValid) {
                    $validator = $this->params['shape'][$key];
                    $valid = $validator->isValid($value);
                    if ($valid == false) {
                        $resValid = false;
                    }
                });
                $isValid = $resValid;
            }
        }

        return $isValid;
    }

    public function sizeof(int $size)
    {
        $this->params['sizeof'] = $size;
        return new ArrayValidator($this->params);
    }

    public function shape(array $shapeArray)
    {
        $this->params['shape'] = $shapeArray;
        return new ArrayValidator($this->params);
    }
}