<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : provider.php
 * Purpose     : Registers the component services within Joomla's
 *               dependency injection container.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-10-28
 * Modified    : 2026-10-29
 * Version     : 0.1.0
 *
 * Copyright   : Copyright (C) 2026 Frits van Leeuwen
 * License     : GNU General Public License version 2 or later
 *
 * ========================================================================
 */

defined('_JEXEC') or die;

// Register a PSR-4 autoloader for all classes in this component.
// This bypasses Joomla's namespace cache, which is not always
// automatically refreshed upon reinstallation.
spl_autoload_register(static function (string $class): void {
    $prefix  = 'Fvl\\Component\\DisciplineCoach\\Administrator\\';
    $baseDir = dirname(__DIR__) . '/src/';

    if (strncmp($prefix, $class, strlen($prefix)) !== 0) {
        return;
    }

    $relativeClass = substr($class, strlen($prefix));
    $file          = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});

use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

use Fvl\Component\DisciplineCoach\Administrator\Extension\DisciplineCoachComponent;

return new class implements ServiceProviderInterface
{
    public function register(Container $container): void
    {
        // Register the MVC infrastructure service providers.
        $container->registerServiceProvider(
            new ComponentDispatcherFactory('\\Fvl\\Component\\DisciplineCoach')
        );
        $container->registerServiceProvider(
            new MVCFactory('\\Fvl\\Component\\DisciplineCoach')
        );

        // Register the component itself.
        $container->set(
            ComponentInterface::class,
            function (Container $container) {
                $component = new DisciplineCoachComponent(
                    $container->get(ComponentDispatcherFactoryInterface::class)
                );
                $component->setMVCFactory(
                    $container->get(MVCFactoryInterface::class)
                );

                return $component;
            }
        );
    }
};
