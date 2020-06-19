<?php

namespace HavenShen\Slim\Swoole\Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;
use Mockery as m;
use phpmock\Mock;
use phpmock\MockBuilder;
use DI\ContainerBuilder;
use Slim\Factory\AppFactory;
use Slim\App;

/**
 * TestCase
 *
 * @author    Haven Shen <havenshen@gmail.com>
 * @copyright    Copyright (c) Haven Shen
 */
class TestCase extends BaseTestCase
{
    /**
     * @return App
     * @throws Exception
     */
    protected function getAppInstance(): App
    {
        // Instantiate PHP-DI ContainerBuilder
        $containerBuilder = new ContainerBuilder();

        $containerBuilder->addDefinitions('src/config/swoole_http.php');
        // Build PHP-DI Container instance
        $container = $containerBuilder->build();

        // Instantiate the app
        AppFactory::setContainer($container);

        $app = AppFactory::create();

        return $app;
    }

}
