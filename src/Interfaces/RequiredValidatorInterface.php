<?php

namespace Hexlet\Validator\Interfaces;

use Hexlet\Validator\Validator;

interface RequiredValidatorInterface
{
    public function required(): Validator;
    public function getRequired(): bool;
}
