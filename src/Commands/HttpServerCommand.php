<?php

namespace HavenShen\Slim\Swoole\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * HttpServerCommand
 *
 * @author    Haven Shen <havenshen@gmail.com>
 * @copyright    Copyright (c) Haven Shen
 */
class HttpServerCommand extends Command
{
    protected static $defaultName = 'http:server';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        return Command::SUCCESS;
    }

    // ...
    protected function configure()
    {
        $this->setDescription('Swoole HTTP Server.')
            ->setHelp('This command allows you to create a user...');
    }

    private function start()
    {
        //
    }
}
