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
        $sheme = UrlParser::set($url)->pull('scheme');

        return new Protocol($sheme);
    }

    public static function init(string $url): Protocol
    {
        return new Protocol($url);
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
