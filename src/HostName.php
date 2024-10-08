<?php

declare(strict_types=1);

namespace UrlToolBox;

class HostName
{
    public static function fromURL(string $url): HostName
    {
        $hostName = UrlParser::set($url)->pull('host');

        return new HostName($hostName);
    }

    public function __construct(private string $value)
    {
        $this->value = trim($value);
    }

    public function get(): string
    {
        return $this->value;
    }

}
