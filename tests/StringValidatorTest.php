<?php

namespace Hexlet\Validator\Tests;

use PHPUnit\Framework\TestCase;
use Hexlet\Validator\Validator;

class StringValidatorTest extends TestCase
{
    public function testIsValid(): void
    {
        $v = new Validator();
        $schema = $v->string();
        $schema2 = $v->string();
        $this->assertTrue($schema->isValid(''));
        $this->assertTrue($schema->isValid(null));
        $this->assertTrue($schema->isValid('what does the fox say'));
        $schema->required();
        $this->assertFalse($schema->isValid(null));
        $this->assertTrue($schema2->isValid(''));
        $this->assertTrue($schema2->isValid(null));
        $this->assertTrue($schema2->isValid('what does the fox say'));
        $this->assertTrue($schema->isValid('hexlet'));
        $this->assertTrue($schema->contains('what')->isValid('what does the fox say'));
        $this->assertTrue($v->string()->minLength(10)->minLength(5)->isValid('Hexlet'));
    }
}
