<?php

declare(strict_types=1);

namespace UrlToolBox;

class Protocol
{
    /** @var array<string> */
    private static array $validProtocols = ['https', 'http'];

    /**
     * @throws UrlToolBoxError
     */
    public static function fromURL(string $url): Protocol
    {
        $parsed = parse_url($url);

        if (!is_array($parsed) || !array_key_exists('scheme', $parsed)) {
            throw UrlToolBoxError::invalidURLError('Protocol::fromURL', $url);
        }

        return new Protocol($parsed['scheme']);
    }

    public function __construct(private string $value)
    {
    }

    public function get(): string
    {
        return $this->value;
    }

    public function getFull(): string
    {
        return $this->makeFull($this->value);
    }

    public function getOnlyValid(): ?string
    {
        return $this->isValidProtocol() ? $this->value : null;
    }

    public function getFullOnlyValid(): ?string
    {
        return $this->isValidProtocol() ? $this->makeFull($this->value) : null;
    }

    private function makeFull(string $protocol): string
    {
        return $protocol . '://';
    }

    private function isValidProtocol(): bool
    {
        return in_array($this->value, self::$validProtocols, true);
    }
}
