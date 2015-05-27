<?php

namespace Innova\ActivityBundle;

use Claroline\CoreBundle\Library\PluginBundle;
use Claroline\KernelBundle\Bundle\AutoConfigurableInterface;
use Claroline\KernelBundle\Bundle\ConfigurationBuilder;
use Claroline\KernelBundle\Bundle\ConfigurationProviderInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Innova Activity Bundle
 */
class InnovaActivityBundle extends PluginBundle implements AutoConfigurableInterface, ConfigurationProviderInterface
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

        return $config->addRoutingResource(__DIR__ . '/Resources/config/routing.yml', null, 'innova_activity');
    }
    
    public function suggestConfigurationFor(Bundle $bundle, $environment)
    {
        $bundleClass = get_class($bundle);
        $config = new ConfigurationBuilder();
        $emptyConfigs = array(
            'Innova\AngularJSBundle\InnovaAngularJSBundle',
            'Innova\AngularUIBootstrapBundle\InnovaAngularUIBootstrapBundle',
            'Innova\AngularUITranslationBundle\InnovaAngularUITranslationBundle',
            'Innova\AngularUIResourcePickerBundle\InnovaAngularUIResourcePickerBundle',
            'Innova\AngularUITinyMCEBundle\InnovaAngularUITinyMCEBundle',
            'Innova\AngularUISortableBundle\InnovaAngularUISortableBundle',
        );
        if (in_array($bundleClass, $emptyConfigs)) {
            return $config;
        }
        return false;
    }
}