<?php

namespace Php\Package\Validators;

use Php\Package\Interfaces\NumberValidatorInterface;

class NumberValidator implements NumberValidatorInterface
{
    private $params = [];

    public function __construct(array $params = [])
    {
        $this->params = empty($params) ? [
            'required' => false,
            'positive' => false
        ] : $params;
    }

    public function isValid(int|null $num): bool
    {
        $isValid = ($this->params['required'] == true && is_null($num)) ? false : true;

        if ($this->params['positive'] == true && $this->params['required'] == true) {
            $isValid = $num > 0 ? true : false;
        }

        if (isset($this->params['range'])) {
            $isValid = ($num >= $this->params['range']['min']  && $num <= $this->params['range']['max']) ? true : false;
        }
        return $isValid;
    }


    public function positive()
    {
        $this->params['positive'] = true;
        return new NumberValidator($this->params);
    }
    public function required()
    {
        $this->params['required'] = true;
    }
    public function range(int $min, int $max)
    {
        $this->params['range'] = [
            'min' => $min,
            'max' => $max
        ];
    }

//    public function minLength(int $minLength): StringValidator
//    {
//        $this->params['minLength'] = $minLength;
//        return new StringValidator($this->params);
//    }
//
//    public function contains(string $subString): StringValidator
//    {
//        $this->params['subString'] = $subString;
//        return new StringValidator($this->params);
//    }
}