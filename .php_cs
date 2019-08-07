<?php
$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__.'/src')
    ->in(__DIR__.'/tests')
    ;

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules([
        'blank_line_after_opening_tag' => true,
        'phpdoc_no_empty_return' => true,
    ])
    ->setFinder($finder)
    ;
