<?php

namespace Innova\ActivityBundle;

use Claroline\CoreBundle\Library\PluginBundle;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Claroline\KernelBundle\Bundle\AutoConfigurableInterface;
use Claroline\KernelBundle\Bundle\ConfigurationProviderInterface;
use Claroline\KernelBundle\Bundle\ConfigurationBuilder;
use Innova\PathBundle\Installation\AdditionalInstaller;


class InnovaActivityBundle extends PluginBundle implements AutoConfigurableInterface, ConfigurationProviderInterface
{
    public function supports($environment)
    {
        return true;
    }

    public function getConfiguration($environment)
    {
        $config = new ConfigurationBuilder();

        return $config->addRoutingResource(__DIR__ . '/Resources/config/routing.yml', null, 'innova_activity_sequence');
    }

    public function suggestConfigurationFor(Bundle $bundle, $environment)
    {
        
    }

    public function getAdditionalInstaller()
    {
        return new AdditionalInstaller();
    }
}