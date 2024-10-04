<?php

namespace UrlToolBox;

class Url
{
    private string | null $protocol;

    public function __construct(string $url)
    {
        $formattedURL = trim($url);

        $this->protocol = self::determineProtocol($formattedURL);
    }

    public function getProtocol(): string | null
    {
        return $this->protocol;
    }

    private static function determineProtocol(string $url): string | null
    {
        if (str_starts_with($url, 'http://')) {
            return 'http';
        }

        if (str_starts_with($url, 'https://')) {
            return 'https';
        }

        return null;
    }
}
