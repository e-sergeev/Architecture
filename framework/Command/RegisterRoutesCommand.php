<?php

namespace Framework\Command;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class RegisterRoutesCommand
{
    public $routeCollection;
    public $containerBuilder;

    /**
     * @param RouteCollection $routeCollection
     * @param ContainerBuiler $containerBuilder
     */

    public function __construct(RouteCollection $routeCollection, ContainerBuilder $containerBuilder)
    {
        $this->routeCollection = $routeCollection;
        $this->containerBuilder = $containerBuilder;
    }

    public function register(): void
    {
        $this->routeCollection = require __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'routing.php';
        $this->containerBuilder->set('route_collection', $this->routeCollection);
    }
}