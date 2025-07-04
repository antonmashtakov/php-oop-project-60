<?php

namespace Hexlet\Validator\Interfaces;

use Hexlet\Validator\Validators\ArrayValidator;

interface ArrayValidatorInterface
{
    public function isValid(array|null $array): bool;
    public function sizeof(int $size): ArrayValidator;
    public function getSizeof(): int|null;
    public function getShape(): array;
}
