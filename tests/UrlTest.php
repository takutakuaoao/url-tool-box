<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use UrlToolBox\Url;

class UrlTest extends TestCase
{
    /**
     * @dataProvider dataProviderGetProtocol
     */
    public function test_get_protocol(string $url, string $expectedProtocol): void
    {
        $sut = new Url($url);

        $result = $sut->getProtocol();

        $this->assertEquals($expectedProtocol, $result);
    }

    /**
     * @dataProvider dataProviderInvalidProtocolURLs
     */
    public function test_get_empty_when_invalid_protocol(string $url): void
    {
        $sut = new Url($url);

        $result = $sut->getProtocol();

        $this->assertEmpty($result, '$result must be not empty. $result is ' . $result);
    }

    /**
     * @return array<string, array<string>>
     */
    public function dataProviderGetProtocol(): array
    {
        return [
            'http' => ['http://example.com', 'http'],
            'https' => ['https://example.com', 'https'],
            'URL containing leading a space' => [' https://example.com', 'https'],
        ];
    }

    /**
     * @return array<int, array<string>>
     */
    public function dataProviderInvalidProtocolURLs(): array
    {
        return [
            ['htt://example.com'],
            ['http:/example.com'],
            ['http//example.com'],
            ['http/example.com'],
        ];
    }
}
