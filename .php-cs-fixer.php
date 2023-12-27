<?php

// declare(strict_types=1);

$finder = PhpCsFixer\Finder::create()
    ->in(
        [
            __DIR__.DIRECTORY_SEPARATOR.'src',
        ]
    )
    ->append(
        [
            __DIR__.DIRECTORY_SEPARATOR.'.php-cs-fixer.php',
        ]
    )
;

return (new PhpCsFixer\Config())
    ->setRules( [
        '@PSR12' => true,
        '@PhpCsFixer' => true,
        'braces_position' => [
            'functions_opening_brace' => 'same_line',
            'classes_opening_brace' => 'same_line',
        ],
        'control_structure_continuation_position' => [
            'position' => 'next_line',
        ],
        'spaces_inside_parentheses' => [
            'space' => 'single',
        ],
        'declare_parentheses' => true,
        'no_spaces_after_function_name' => true,
    ] )
    ->setFinder( $finder )
    ->setCacheFile( __DIR__.DIRECTORY_SEPARATOR.'.php_cs.cache' )
;
