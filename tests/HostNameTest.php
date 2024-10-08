<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use UrlToolBox\HostName;

class HostNameTest extends TestCase
{
    public function testGet(): void
    {
        $sut = HostName::fromURL('https://example.com');

        $result = $sut->get();

        $this->assertEquals('example.com', $result);
    }
}
