<?php

namespace Hexlet\Validator;

use Hexlet\Validator\Validators\StringValidator;
use Hexlet\Validator\Validators\NumberValidator;
use Hexlet\Validator\Validators\ArrayValidator;
use Hexlet\Validator\Interfaces\RequiredValidatorInterface;

class Validator implements RequiredValidatorInterface
{
    protected $params = [
        'required' => false,
    ];

    public function __construct(array $params = [])
    {
        $this->params = array_merge($this->params, $params);
    }

    public function string()
    {
        return new StringValidator($this->params);
    }
    public function number()
    {
        return new NumberValidator($this->params);
    }
    public function array()
    {
        return new ArrayValidator();
    }
    public function required()
    {
        $this->params['required'] = true;
        return $this;
    }
    public function getRequired(): bool
    {
        return $this->params['required'] ?? false;
    }

    public function addValidator(string $schemaType, string $methodName, callable $fn)
    {
        if (empty($schemaType) || !$this->isSchema($schemaType))
            throw new \Exception('You must provide a Validator schema constructor function');

        if (empty($methodName))
            throw new \Exception('A Method name must be provided');

        if (!is_object($fn))
            throw new \Exception('Method function must be provided');

        $this->params['customValidator'] = [
            'schemaType' => $schemaType,
            'method' => $methodName,
            'fn' => $fn,
        ];
    }

    private function isSchema(string $schemaType): bool
    {
        return method_exists(self::class, $schemaType);
    }

    public function test(string $methodName, $value)
    {
        if ($methodName != $this->params['customValidator']['method'])
            throw new \Exception('Method not found');

        $schema = $this->params['customValidator']['schemaType'];
        $fn = $this->params['customValidator']['fn'];
        $validator = $this->{$schema}();

        return $validator->{$methodName}($value, $fn);
    }
}