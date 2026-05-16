<?php

use Illuminate\Contracts\View\Factory as ViewFactory;

if (\Composer\InstalledVersions::isInstalled('tomasvotruba/bladestan')) {
    require __DIR__ . '/../vendor/tomasvotruba/bladestan/bootstrap.php';
    /** @var \Illuminate\Contracts\Foundation\Application $app */
    $app->langPath(__DIR__ . '/lang');
    $app->resourcePath(__DIR__ . '/resources');
    $viewFactory = $app->make(ViewFactory::class);
    /** @var \Illuminate\View\Factory $viewFactory */
    $viewFactory
        ->getFinder()
        ->addLocation(__DIR__ . '/resources/views');
}
