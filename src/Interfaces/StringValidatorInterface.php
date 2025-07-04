<?php

namespace Hexlet\Validator\Interfaces;

interface StringValidatorInterface
{
    public function isValid(string|null $string): bool;
    public function minLength(int $length);
    public function contains(string $length);
    public function getMinLength(): int|null;

    public function getContains(): string;
}
