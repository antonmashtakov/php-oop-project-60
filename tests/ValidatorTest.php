<?php

namespace Php\Package\Tests;

use PHPUnit\Framework\TestCase;
use Php\Package\Validator;

class ValidatorTest extends TestCase
{
    public function testIsValid()
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

        $schema = $v->array();
        $this->assertTrue($schema->isValid(null));
        $schema->required();
        $this->assertFalse($schema->isValid(null));
        $this->assertTrue($schema->isValid([]));
        $this->assertTrue($schema->isValid(['hexlet']));
        $schema->sizeof(2);
        $this->assertFalse($schema->isValid(['hexlet']));
        $this->assertTrue($schema->isValid(['hexlet', 'code-basics']));
        $schema->shape([
            'name' => $v->string()->required(),
            'age' => $v->number()->positive(),
        ]);
        $this->assertTrue($schema->isValid(['name' => 'kolya', 'age' => 100]));
        $this->assertTrue($schema->isValid(['name' => 'maya', 'age' => null]));
        $this->assertFalse($schema->isValid(['name' => '', 'age' => null]));
        $this->assertFalse($schema->isValid(['name' => 'ada', 'age' => -5]));

        $fn = fn($value, $start) => str_starts_with($value, $start);
        $v->addValidator('string', 'startWith', $fn);
        $schema = $v->string()->test('startWith', 'H');
        $this->assertFalse($schema->isValid('exlet'));
        $this->assertTrue($schema->isValid('Hexlet'));

        $fn = fn($value, $min) => $value >= $min;
        $v->addValidator('number', 'min', $fn);
        $schema = $v->number()->test('min', 5);
        $this->assertFalse($schema->isValid(4));
        $this->assertTrue($schema->isValid(6));
    }
}