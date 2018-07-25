<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 13.01.16
 * Time: 18:24
 */

namespace Victor\CloudinaryStorageBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\Config\FileLocator;

class VictorCloudinaryStorageExtension extends  Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = $this->processConfiguration(new Configuration(), $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $certsLocator = new FileLocator(__DIR__.'/../Resources/certs');
        $cacertPemPath = $certsLocator->locate('cacert.pem');

        $cloudinaryConfig = $container->getDefinition('cloudinary_storage_config');
        $cloudinaryConfig->addMethodCall('set', ['storage_name', $config['storage_name']]);
        $cloudinaryConfig->addMethodCall('set', ['key', $config['key']]);
        $cloudinaryConfig->addMethodCall('set', ['secret', $config['secret']]);
        $cloudinaryConfig->addMethodCall('set', ['url', $config['url'] . $config['storage_name']]);
        $cloudinaryConfig->addMethodCall('set', ['cacert.pem', $cacertPemPath]);

        $container->setParameter('uploaded_file_name', $config['uploaded_file_name']);
    }


    public function getAlias()
    {
        return 'cloudinary_storage';
    }
}
