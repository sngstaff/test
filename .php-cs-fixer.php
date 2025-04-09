<?php

return (new PhpCsFixer\Config)
    ->setRules([
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
        'single_quote' => true,
        'no_unused_imports' => true,
        'php_unit_method_casing' => ['case' => 'snake_case']
    ])
    ->setFinder(
        (new PhpCsFixer\Finder)
            ->in(['app', 'routes', 'config', 'tests'])
    );