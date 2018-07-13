<?php

namespace Victor\FileStorageBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class StoragePass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        $definition = $container->findDefinition(
            'file_storage'
        );
        $taggedServices = $container->findTaggedServiceIds(
            'file_storage'
        );

        foreach ($taggedServices as $id => $tags) {
            foreach ($tags as $attributes) {
                $definition->addMethodCall(
                    'setStorage',
                    array(new Reference($id))
                );
            }
        }
    }
}
