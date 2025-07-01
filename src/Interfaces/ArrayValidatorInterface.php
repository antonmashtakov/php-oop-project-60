<?php

namespace Php\Package\Interfaces;

interface ArrayValidatorInterface
{
    public function isValid(array|null $array): bool;
    public function sizeof(int $size);
}
