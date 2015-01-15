<?php

namespace Innova\ActivityBundle;

use Claroline\CoreBundle\Library\PluginBundle;
use Claroline\KernelBundle\Bundle\AutoConfigurableInterface;
use Claroline\KernelBundle\Bundle\ConfigurationBuilder;

/**
 * Innova Activity Bundle
 */
class InnovaActivityBundle extends PluginBundle implements AutoConfigurableInterface
{
    public function supports($environment)
    {
        return true;
    }

    public function getRequiredFixturesDirectory($environment)
    {
        return 'DataFixtures/Required';
    }

    public function getConfiguration($environment)
    {
        $config = new ConfigurationBuilder();

        return $config->addRoutingResource(__DIR__ . '/Resources/config/routing.yml', null, 'innova_activity_sequence');
    }
}