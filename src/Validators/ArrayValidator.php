<?php

namespace Hexlet\Validator\Validators;

use Hexlet\Validator\Interfaces\ArrayValidatorInterface;
use Hexlet\Validator\Validator;

class ArrayValidator extends Validator implements ArrayValidatorInterface
{
    public function isValid(array|null $array): bool
    {
        $isValid = ($this->getRequired() == true && is_null($array)) ? false : true;

        if (!is_null($array)) {
            if ($this->getSizeof()) {
                $isValid = (sizeof($array) == $this->getSizeof()) ? true : false;
            }

            if (!empty($this->getShape())) {
                $resValid = true;
                collect($array)->map(function ($value, $key) use (&$resValid) {
                    $validator = $this->getShape()[$key];
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

    public function sizeof(int $size): ArrayValidator
    {
        $this->params['sizeof'] = $size;
        return new ArrayValidator($this->params);
    }

    public function shape(array $shapeArray)
    {
        $this->params['shape'] = $shapeArray;
        return new ArrayValidator($this->params);
    }

    public function getSizeof(): int|null
    {
        return $this->params['sizeof'] ?? null;
    }

    public function getShape(): array
    {
        return $this->params['shape'] ?? [];
    }
}
