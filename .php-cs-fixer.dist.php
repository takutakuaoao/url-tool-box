<?php

declare(strict_types=1);

$config = new PhpCsFixer\Config();

return $config
    ->setRules([
        '@Symfony' => true,
        '@PSR12' => true,
        'concat_space' => ['spacing' => 'one'],
        'function_typehint_space' => true,
        'binary_operator_spaces' => true,
    ]);
