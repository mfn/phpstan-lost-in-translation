<?php declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;
use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;

require __DIR__ . '/tools/cs-fixer/vendor/autoload.php';

$finder = Finder::create()
    ->in([__DIR__ . '/src', __DIR__ . '/tests', __DIR__ . '/e2e'])
    ->exclude(['data', 'fixtures', 'resources'])
    ->notPath('#(^|/)lang[^/]*(/|$)#')
    // notPath() matches paths relative to each in() root, so this only ever
    // matches e2e/src/* (PHPStan analyzer fixtures); the repo-root src/ is
    // an in() root itself and its files never have a leading "src/" segment.
    ->notPath('#^src/#')
    ->notName('*.blade.php');

return (new Config())
    ->setFinder($finder)
    ->setRules(\Mfn\PhpCsFixer\Config::getRules())
    ->setRiskyAllowed(true)
    ->setParallelConfig(ParallelConfigFactory::detect());
