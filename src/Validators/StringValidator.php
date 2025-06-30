<?php

namespace Php\Package\Validators;

use Php\Package\Interfaces\StringValidatorInterface;

class StringValidator implements StringValidatorInterface
{
    private $params = [];

    public function __construct(array $params = [])
    {
        $this->params = empty($params) ? [
            'required' => false,
            'string' => '',
            'subString' => '',
            'minLength' => null
        ] : $params;
    }

    public function isValid(string|null $string): bool
    {
        $this->params['string'] = $string;
        if ($this->params['required'] == true && empty($string)) {
            $isValid = false;
        } else {
            $isValid = true;
        }

        if (!empty($this->params['string']) && !empty($this->params['subString'])) {
            $isValid = str_contains($this->params['string'], $this->params['subString']);
        }

        if (!empty($this->params['minLength'])) {
            $isValid = (strlen($this->params['string']) < $this->params['minLength']) ? false : true;
        }
        return $isValid ?? true;
    }

    public function minLength(int $minLength): StringValidator
    {
        $this->params['minLength'] = $minLength;
        return new StringValidator($this->params);
    }

    public function contains(string $subString): StringValidator
    {
        $this->params['subString'] = $subString;
        return new StringValidator($this->params);
    }

    public function required()
    {
        $this->params['required'] = true;
    }
}