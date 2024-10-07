<?php

namespace Tests;

trait Assertions
{
    public function shouldBeEquals(mixed $expected, mixed $actual): void
    {
        $this->assertEquals($expected, $actual, '$expected is' . "\n" . var_export($expected, true) . "\n\n" . '$actual is ' . "\n" . var_export($actual, true) . "\n");
    }
}
