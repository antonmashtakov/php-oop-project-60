<?php

namespace Php\Package\Tests;

use PHPUnit\Framework\TestCase;
use Php\Package\Validator;

class ArrayValidatorTest extends TestCase
{
    public function testIsValid()
    {
        $v = new Validator();
        $schema = $v->array();
        $this->assertTrue($schema->isValid(null));
        $schema->required();
        $this->assertFalse($schema->isValid(null));
        $this->assertTrue($schema->isValid([]));
        $this->assertTrue($schema->isValid(['hexlet']));
        $schema->sizeof(2);
        $this->assertFalse($schema->isValid(['hexlet']));
        $this->assertTrue($schema->isValid(['hexlet', 'code-basics']));
    }
}
