<?php

declare(strict_types=1);

namespace UrlToolBox;

class UrlToolBoxError extends \Error
{
    public static function invalidURLError(string $location, string $url): UrlToolBoxError
    {
        return new UrlToolBoxError('The invalid url was passed to ' . $location . '. It was ' . $url);
    }

    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
