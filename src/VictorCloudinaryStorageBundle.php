<?php

namespace Victor\CloudinaryStorageBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Victor\CloudinaryStorageBundle\DependencyInjection\Compiler\StoragePass;
use Victor\CloudinaryStorageBundle\DependencyInjection\VictorFileStorageExtension;

class VictorCloudinaryStorageBundle extends Bundle
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
