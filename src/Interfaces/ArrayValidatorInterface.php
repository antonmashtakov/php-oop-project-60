<?php

namespace Hexlet\Validator\Interfaces;

interface ArrayValidatorInterface
{
    public function isValid(array|null $array): bool;
    public function sizeof(int $size);
    public function getSizeof(): int|null;
    public function getShape(): array;
}
