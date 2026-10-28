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
 * Created     : 2026-09-16
 * Modified    : 2026-09-16
 * Version     : 0.1.0
 *
 * Copyright   : Copyright (C) 2026 Frits van Leeuwen
 * License     : GNU General Public License version 2 or later
 *
 * ========================================================================
 */

defined('_JEXEC') or die;

use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

return new class implements ServiceProviderInterface
{
    public function register(Container $container): void
    {
        $container->registerServiceProvider(
            new MVCFactory('\\Fvl\\Component\\DisciplineCoach')
        );

        $container->registerServiceProvider(
            new ComponentDispatcherFactory('\\Fvl\\Component\\DisciplineCoach')
        );
    }
};
