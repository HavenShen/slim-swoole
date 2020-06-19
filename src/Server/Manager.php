<?php

namespace HavenShen\Slim\Swoole\Server;

use DI\ContainerBuilder;
use Illuminate\Support\Str;
use HavenShen\Slim\Swoole\Helpers\OS;
use Slim\App;

/**
 * Manager
 *
 * @author    Haven Shen <havenshen@gmail.com>
 * @copyright    Copyright (c) Haven Shen
 */
class Manager
{
    /**
     * Container.
     *
     * @var \DI\Container
     */
    protected $container;

    /**
     * App.
     *
     * @var \Slim\App
     */
    protected $app;

    /**
     * Server events.
     *
     * @var array
     */
    protected $events = [
        'start',
        'shutDown',
        'workerStart',
        'workerStop',
        'packet',
        'bufferFull',
        'bufferEmpty',
        'task',
        'finish',
        'pipeMessage',
        'workerError',
        'managerStart',
        'managerStop',
        'request',
    ];

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->container = $this->app->getContainer();
        $this->initialize();
    }

    /**
     * Run swoole server.
     */
    public function run()
    {
        //
    }

    protected function start()
    {
        //
    }

    /**
     * Initialize.
     */
    protected function initialize()
    {
        $this->setSwooleServerListeners();
    }

    /**
     * Set swoole server listeners.
     */
    protected function setSwooleServerListeners()
    {
        $server = $this->container->make(Server::class);
        foreach ($this->events as $event) {
            $listener = Str::camel("on_$event");
            $callback = method_exists($this, $listener) ? [$this, $listener] : function () use ($event) {
                $this->container->make('events')->dispatch("swoole.$event", func_get_args());
            };

            $server->on($event, $callback);
        }
    }

    /**
     * Set process name.
     *
     * @codeCoverageIgnore
     *
     * @param $process
     */
    protected function setProcessName($process)
    {
        // MacOS doesn't support modifying process name.
        if (OS::is(OS::MAC_OS) || $this->isInTesting()) {
            return;
        }
        $serverName = 'swoole_http_server';
        $appName = $this->container->get('server')['app_name'];

        $name = sprintf('%s: %s for %s', $serverName, $process, $appName);

        swoole_set_process_name($name);
    }

    /**
     * Indicates if it's in phpunit environment.
     *
     * @return bool
     */
    protected function isInTesting()
    {
        return defined('IN_PHPUNIT') && IN_PHPUNIT;
    }
}
