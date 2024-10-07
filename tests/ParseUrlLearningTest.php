<?php

namespace Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class ParseUrlLearningTest extends TestCase
{
    use Assertions;

    #[DataProvider('dataProvidder')]
    public function testLearningParseUrl(string $url, mixed $expectedReturn): void
    {
        $result = parse_url($url);

        $this->shouldBeEquals($expectedReturn, $result);
    }

    /**
     * @return array<string, array<mixed>>
     */
    public static function dataProvidder(): array
    {
        return [
            'invalid_url_1' => ['domain.com/test', ['path' => 'domain.com/test']],
        ];
    }
}
