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

    public static function init(string $value): HostName
    {
        return new HostName($value);
    }

    public function __construct(private string $value)
    {
        $this->value = trim($value);
    }

    public function get(): string
    {
        return $this->value;
    }

    public function getTopLevelDomain(): ?string
    {
        if (preg_match('/\.([a-z0-9-]+)\z/i', $this->value, $matches)) {
            return $matches[1];
        }

        return null;
    }

    public function getSecondaryLevelDomain(): ?string
    {
        if (preg_match('/([a-z0-9-]+)\.([a-z0-9-]+)\z/i', $this->value, $matches)) {
            return $matches[1];
        }

        return null;
    }

}
