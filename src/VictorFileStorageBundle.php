<?php

namespace Victor\FileStorageBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Victor\FileStorageBundle\DependencyInjection\Compiler\StoragePass;
use Victor\FileStorageBundle\DependencyInjection\VictorFileStorageExtension;

class VictorFileStorageBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new StoragePass());
    }

    public function getContainerExtension()
    {
        return new VictorFileStorageExtension();
    }

}
