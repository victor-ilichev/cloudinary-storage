<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 13.01.16
 * Time: 18:24
 */

namespace Victor\FileStorageBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\FileLocator;

class VictorFileStorageExtension extends  Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        if (empty($config['default_storage'])) {
            $keys = array_keys($config['storages']);
            $config['default_storage'] = reset($keys);
        }

        $currentStorage = $config['storages'][$config['default_storage']];

        $definition = $container->getDefinition('file_storage');
        $definition->replaceArgument(0, $currentStorage['key']);
        $definition->replaceArgument(0, $currentStorage['url']);

        //$this->addTemplateLayoutToRender($container, $config);

    }

    private function addTemplateLayoutToRender(ContainerBuilder $containerBuilder, $layout)
    {
        //$containerBuilder->getDefinition('widget.editor_configuration_preview')->replaceArgument(0, $layout['preview']);
    }

    public function getAlias()
    {
        return 'file_storage';
    }
}
