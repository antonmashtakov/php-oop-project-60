<?php

namespace Php\Package\Validators;

use Php\Package\Interfaces\StringValidatorInterface;
use Php\Package\Validator;

class StringValidator extends Validator implements StringValidatorInterface
{
    public function __construct(array $params = [])
    {
        $this->params = array_merge($this->params, [
            'subString' => '',
            'minLength' => null
        ]);
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
}