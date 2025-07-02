<?php

namespace Php\Package\Interfaces;

interface RequiredValidatorInterface
{
    public function required();
    public function getRequired(): bool;
}
