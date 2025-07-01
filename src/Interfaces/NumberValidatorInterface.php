<?php

namespace Php\Package\Interfaces;

interface NumberValidatorInterface
{
    public function isValid(int|null $num): bool;
    public function positive();
    public function range(int $min, int $max);
}
