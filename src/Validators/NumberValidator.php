<?php

namespace Hexlet\Validator\Validators;

use Hexlet\Validator\Interfaces\NumberValidatorInterface;
use Hexlet\Validator\Validator;
use Hexlet\Validator\Traits\CallTrait;

class NumberValidator extends Validator implements NumberValidatorInterface
{
    use CallTrait;

    public function isValid(int|null $num): bool
    {
        $isValid = ($this->getRequired() && is_null($num)) ? false : true;

        if ($this->getRequired()) {
            $isValid = ($num == null) ? false : true;
        }

        if ($this->getPositive()) {
            $isValid = $num > 0 || $num == null && !$this->getRequired() ? true : false;
        }

        if ($this->getRange()) {
            $isValid = ($num >= $this->getRange()['min']  && $num <= $this->getRange()['max']) ? true : false;
        }

        if (is_object($this->fn)) {
            $callback = $this->fn;
            $isValid = $callback($num, implode(',', $this->args));
        }

        return $isValid;
    }

    public function positive(): NumberValidator
    {
        $this->params['positive'] = true;
        return new NumberValidator($this->params);
    }

    public function range(int $min, int $max): NumberValidator
    {
        $this->params['range'] = [
            'min' => $min,
            'max' => $max
        ];
        return new NumberValidator($this->params);
    }

    public function getPositive(): bool
    {
        return $this->params['positive'] ?? false;
    }
    public function getRange(): array
    {
        return $this->params['range'] ?? [];
    }
}
