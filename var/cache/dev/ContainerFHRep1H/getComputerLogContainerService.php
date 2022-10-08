<?php

namespace ContainerFHRep1H;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getComputerLogContainerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\Service\ComputerLogContainer' shared autowired service.
     *
     * @return \App\Service\ComputerLogContainer
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'src'.\DIRECTORY_SEPARATOR.'Service'.\DIRECTORY_SEPARATOR.'ComputerLogContainer.php';

        return $container->privates['App\\Service\\ComputerLogContainer'] = new \App\Service\ComputerLogContainer();
    }
}
