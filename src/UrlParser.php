<?php

declare(strict_types=1);

namespace UrlToolBox;

class UrlParser
{
    public static function set(string $url): UrlParser
    {
        return new UrlParser($url);
    }

    public function __construct(private string $url)
    {
    }

    /**
     * @throws UrlToolBoxError
     */
    public function pull(string $part): string
    {
        $parsed = $this->tryParse();

        if (!array_key_exists($part, $parsed)) {
            throw UrlToolBoxError::invalidURLError($this->url);
        }

        return (string) $parsed[$part];
    }

    /**
     * @return array{scheme?: string, host?: string, port?: int, user?: string, pass?: string, query?: string, path?: string, fragment?: string}
     */
    private function tryParse(): array
    {
        $parsed = parse_url($this->url);

        if (!is_array($parsed)) {
            throw UrlToolBoxError::invalidURLError($this->url);
        }

        return $parsed;
    }
}
