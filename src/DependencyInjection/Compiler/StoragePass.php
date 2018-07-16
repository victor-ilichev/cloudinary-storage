<?php

namespace Victor\FileStorageBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class StoragePass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
//        $definition = $container->findDefinition(
//            'cloudinary_storage'
//        );

    }
}
