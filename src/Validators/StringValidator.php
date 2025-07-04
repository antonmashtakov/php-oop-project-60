<?php

namespace Hexlet\Validator\Validators;

use Hexlet\Validator\Interfaces\StringValidatorInterface;
use Hexlet\Validator\Traits\CallTrait;
use Hexlet\Validator\Validator;

class StringValidator extends Validator implements StringValidatorInterface
{
    use CallTrait;

    public function isValid(string|null $string): bool
    {
        $isValid = ($this->getRequired() == true && empty($string)) ? false : true;

        if (!empty($string) && !empty($this->getContains())) {
            $isValid = str_contains($string, $this->getContains());
        }

        if ($this->getMinLength()) {
            $isValid = (strlen($string) < $this->getMinLength()) ? false : true;
        }

        if (!empty($this->params['newValidator'])) {
            $isValid = $this->{$this->params['newValidator']['method']}($this->params['newValidator']);
        }

        if (is_object($this->fn)) {
            $callback = $this->fn;
            $isValid = $callback($string, implode(',', $this->args));
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

    public function getMinLength(): int|null
    {
        return $this->params['minLength'] ?? null;
    }

    public function getContains(): string
    {
        return $this->params['subString'] ?? '';
    }
}
