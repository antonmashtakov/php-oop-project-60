<?php

namespace Hexlet\Validator\Traits;

trait CallTrait
{
    private $fn;
    private $args;

    function __call($methodName, $args)
    {
        collect($args)->map(function ($arg) {
            if (is_object($arg)) {
                $this->fn = $arg;
            } else {
                $this->args[] = $arg;
            }
        });

        return $this;
    }
}