<?php

namespace Php\Package\Interfaces;

interface NumberValidatorInterface
{
    public function isValid(int|null $string): bool;
    public function positive();
    public function required();
    public function range(int $min, int $max);
}
