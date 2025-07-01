<?php

namespace Php\Package\Interfaces;

interface StringValidatorInterface
{
    public function isValid(string|null $string): bool;
    public function minLength(int $length);
    public function contains(string $length);
}
