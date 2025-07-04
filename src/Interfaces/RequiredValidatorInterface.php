<?php

namespace Hexlet\Validator\Interfaces;

interface RequiredValidatorInterface
{
    public function required();
    public function getRequired(): bool;
}
