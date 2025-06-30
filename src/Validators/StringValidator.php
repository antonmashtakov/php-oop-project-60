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
            'subString' => '',
            'minLength' => null
        ] : $params;
    }

    public function isValid(string|null $string): bool
    {
        $isValid = ($this->params['required'] == true && empty($string)) ? false : true;

        if (!empty($string) && !empty($this->params['subString'])) {
            $isValid = str_contains($string, $this->params['subString']);
        }

        if (!empty($this->params['minLength'])) {
            $isValid = (strlen($string) < $this->params['minLength']) ? false : true;
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