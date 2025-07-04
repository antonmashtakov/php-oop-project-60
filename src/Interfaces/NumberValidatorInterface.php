<?php

namespace Hexlet\Validator\Interfaces;

use Hexlet\Validator\Validators\NumberValidator;

interface NumberValidatorInterface
{
    public function isValid(int|null $num): bool;
    public function positive(): NumberValidator;
    public function range(int $min, int $max): NumberValidator;
    public function getPositive(): bool;
    public function getRange(): array;
}
