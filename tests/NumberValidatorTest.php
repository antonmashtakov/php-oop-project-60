<?php

namespace Hexlet\Validator\Tests;

use PHPUnit\Framework\TestCase;
use Hexlet\Validator\Validator;

class NumberValidatorTest extends TestCase
{
    public function testIsValid(): void
    {
        $v = new Validator();
        $schema = $v->number();
        $this->assertTrue($schema->isValid(null));
        $schema->required()->positive();
        $this->assertFalse($schema->isValid(-5));
        $this->assertFalse($schema->isValid(null));
        $this->assertTrue($schema->isValid(7));
        $this->assertTrue($schema->positive()->isValid(10));
        $schema->range(-5, 5);
        $this->assertTrue($schema->isValid(-3));
        $this->assertTrue($schema->isValid(5));
        $this->assertFalse($schema->isValid(-6));
        $this->assertFalse($schema->isValid(10));
    }
}
