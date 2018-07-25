<?php

namespace Victor\CloudinaryStorageBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class StoragePass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        $definition = $container->findDefinition(
            'cloudinary.uri_generator'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'cloudinary.transformation_generator'
        );

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall(
                'addGenerator',
                array(new Reference($id))
            );
        }
    }
}
