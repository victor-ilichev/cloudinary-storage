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

        $certsLocator = new FileLocator(__DIR__.'/../Resources/certs');
        $r = $certsLocator->locate('cacert.pem');
        $definition = $container->getDefinition('cloudinary_storage_service');
        $guzzleClient = $container->getDefinition('guzzle.client');

        $guzzleClient->replaceArgument('base_uri', $config['url']);
        $definition->replaceArgument(0, $config['storage_name']);
        $definition->replaceArgument(1, $config['key']);
        $definition->replaceArgument(2, $config['secret']);
        $definition->replaceArgument(3, $config['url']);
        $definition->replaceArgument(4, $r);
        $definition->replaceArgument(5, $guzzleClient);
    }


    public function getAlias()
    {
        return 'cloudinary_storage';
    }
}
