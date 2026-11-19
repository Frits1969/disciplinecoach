<?php
/**
 * ========================================================================
 * DisciplineCoach
 * Joomla 6 Component
 * ========================================================================
 *
 * File        : provider.php
 * Path        : administrator/services/provider.php
 * Purpose     : Registers the DisciplineCoach component services within
 *               Joomla's dependency injection container.
 *
 * Author      : Frits van Leeuwen
 * Created     : 2026-10-28
 * Modified    : 2026-11-12
 * Version     : 0.1.4
 *
 * Copyright   : Copyright (C) 2026 Frits van Leeuwen
 * License     : GNU General Public License version 2 or later
 *
 * ========================================================================
 */

defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\MVCComponent;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

return new class implements ServiceProviderInterface
{
    /**
     * Registers the DisciplineCoach services.
     *
     * @param Container $container Joomla dependency injection container.
     *
     * @return void
     */
    public function register(Container $container): void
    {
        $container->registerServiceProvider(
            new ComponentDispatcherFactory(
                'Fvl\Component\DisciplineCoach'
            )
        );

        $container->registerServiceProvider(
            new MVCFactory(
                'Fvl\Component\DisciplineCoach'
            )
        );

        $container->set(
            ComponentInterface::class,
            static function (Container $container): ComponentInterface {
                $component = new MVCComponent(
                    $container->get(
                        ComponentDispatcherFactoryInterface::class
                    )
                );

                $component->setMVCFactory(
                    $container->get(
                        MVCFactoryInterface::class
                    )
                );

                return $component;
            }
        );
    }
};
