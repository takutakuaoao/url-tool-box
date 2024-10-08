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

    #[DataProvider('dataProvidderForSecondaryLevelDomain')]
    public function testGetSecondaryLevelDomain(string $host, string $expected): void
    {
        $sut = HostName::init($host);

        $result = $sut->getSecondaryLevelDomain();

        $this->assertSame($expected, $result);
    }

    /**
     * @return array<string, array<mixed>>
     */
    public static function dataProvidderForSecondaryLevelDomain(): array
    {
        return [
            'only_secondary_domain' => ['example.com', 'example'],
            'sub_domain' => ['www.example.com', 'example'],
        ];
    }

    #[DataProvider('dataProvidderEqualy')]
    public function testEqual(string $selfHost, string $otherHost): void
    {
        $sut = HostName::init($selfHost);
        $compare = HostName::init($otherHost);

        $this->assertTrue($sut->equal($compare));
    }

    /**
     * @return array<string, array<mixed>>
     */
    public static function dataProvidderEqualy(): array
    {
        return [
            'normal' => ['www.example.com', 'www.example.com'],
            'with_start_space' => [' www.example.com', 'www.example.com'],
            'with_end_space' => ['www.example.com ', 'www.example.com'],
            'both_space' => [' www.example.com ', 'www.example.com'],
        ];
    }

    #[DataProvider('dataProvidderNotEqualy')]
    public function testNotEqual(string $selfHost, string $otherHost): void
    {
        $sut = HostName::init($selfHost);
        $compare = HostName::init($otherHost);

        $this->assertFalse($sut->equal($compare));
    }

    /**
     * @return array<string, array<mixed>>
     */
    public static function dataProvidderNotEqualy(): array
    {
        return [
            'not_equal' => ['www.example.com', 'www.test.com'],
            'not_equal_sub_domain' => ['www.example.com', 'sub.example.com'],
        ];
    }
}
