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

    #[DataProvider('dataProvidderForGetTopLevelDomain')]
    public function testGetTopLevelDomain(string $host, ?string $expected): void
    {
        $sut = HostName::init($host);

        $result = $sut->getTopLevelDomain();

        $this->assertEquals($expected, $result);
    }

    /**
     * @return array<string, array<mixed>>
     */
    public static function dataProvidderForGetTopLevelDomain(): array
    {
        return [
            'second_domain' => ['example.com', 'com'],
            'sub_domain' => ['www.example.com', 'com'],
            'start_dot' => ['.com', 'com'],
            'include_hyhun' => ['example.c-om', 'c-om'],
        ];
    }

    #[DataProvider('dataProvidderNoTopLevelDomainHostNames')]
    public function testGetEmptyIfHasNoTopLevelDomain(string $host): void
    {
        $sut = HostName::init($host);

        $result = $sut->getTopLevelDomain();

        $this->assertSame(null, $result);
    }

    /**
     * @return array<string, array<mixed>>
     */
    public static function dataProvidderNoTopLevelDomainHostNames(): array
    {
        return [
            'end_dot' => ['error-domain.'],
            'not_dot' => ['error-domain'],
            'include_underbar' => ['www.example.c_om'],
        ];
    }
}
