<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use UrlToolBox\Protocol;
use UrlToolBox\UrlToolBoxError;

class ProtocolTest extends TestCase
{
    #[DataProvider('dataProviderProtocol')]
    public function testGetProtocol(string $url, string $expectedURL): void
    {
        $sut = Protocol::fromURL($url);

        $result = $sut->get();

        $this->assertEquals($expectedURL, $result);
    }

    public function testRaiseErrorIfTheInvalidUrl(): void
    {
        $this->expectException(UrlToolBoxError::class);

        Protocol::fromURL('domain.com/directory');
    }

    #[DataProvider('dataProvidderForGetOnlyValidProtocol')]
    public function testGetOnlyValidProtocol(string $url, ?string $expected): void
    {
        $sut = Protocol::fromURL($url);

        $result = $sut->getOnlyValid();

        $this->assertEquals($expected, $result);
    }

    #[DataProvider('dataProvidderForGetFull')]
    public function testGetFull(string $url, string $expected): void
    {
        $sut = Protocol::fromURL($url);

        $result = $sut->getFull();

        $this->assertEquals($expected, $result);
    }

    #[DataProvider('dataProvidderForGetFullOnlyValid')]
    public function testGetFullOnlyValid(string $url, ?string $expected): void
    {
        $sut = Protocol::fromURL($url);

        $result = $sut->getFullOnlyValid();

        $this->assertEquals($expected, $result);
    }

    /**
     * @return array<string, array<mixed>>
     */
    public static function dataProvidderForGetFullOnlyValid(): array
    {
        return [
            'https' => ['https://example.com', 'https://'],
            'http' => ['http://example.com', 'http://'],
            'invalid_protocol' => ['htt://example.com', null],
        ];
    }

    /**
     * @return array<string, array<mixed>>
     */
    public static function dataProvidderForGetFull(): array
    {
        return [
            'https' => ['https://example.com', 'https://'],
            'http' => ['http://example.com', 'http://'],
            'invalid_protocol' => ['htt://example.com', 'htt://'],
        ];
    }

    /**
     * @return array<string, array<mixed>>
     */
    public static function dataProvidderForGetOnlyValidProtocol(): array
    {
        return [
            'valid_url_https' => ['https://example.com', 'https'],
            'valid_url_http' => ['http://example.com', 'http'],
            'invalid_url' => ['htt://example.com', null],
        ];
    }

    /**
     * @return array<string, array<string>>
     */
    public static function dataProviderProtocol(): array
    {
        return [
            'https' => ['https://example.com', 'https'],
            'http' => ['http://example.com', 'http'],
            'invalid' => ['htt://example.com', 'htt'],
        ];
    }
}
