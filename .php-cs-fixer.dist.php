<?php

$finder = (new PhpCsFixer\Finder())
    ->in(__DIR__)
    ->exclude(['var', 'vendor']);

return (new PhpCsFixer\Config())
    ->setRules([
        '@Symfony' => true,
        'php_unit_method_casing' => ['case' => 'snake_case'],
    ])
    ->setFinder($finder);
