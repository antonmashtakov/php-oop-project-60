<?php

namespace Hexlet\Validator\Interfaces;

use Hexlet\Validator\Validators\StringValidator;

interface StringValidatorInterface
{
    public function isValid(string|null $string): bool;
    public function minLength(int $length): StringValidator;
    public function contains(string $length): StringValidator;
    public function getMinLength(): int|null;

    public function getContains(): string;
}
