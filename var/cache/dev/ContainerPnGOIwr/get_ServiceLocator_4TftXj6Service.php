<?php

namespace ContainerPnGOIwr;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_4TftXj6Service extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.4TftXj6' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.4TftXj6'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService, [
            'chartBuilder' => ['privates', 'chartjs.builder', 'getChartjs_BuilderService', true],
        ], [
            'chartBuilder' => '?',
        ]);
    }
}
