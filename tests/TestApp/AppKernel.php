<?php

namespace Victor\CloudinaryStorageBundle\TestApp;

use Doctrine\Bundle\DoctrineBundle\DoctrineBundle;
use FOS\JsRoutingBundle\FOSJsRoutingBundle;
use Knp\Bundle\MenuBundle\KnpMenuBundle;
use Sonata\AdminBundle\SonataAdminBundle;
use Sonata\BlockBundle\SonataBlockBundle;
use Sonata\CoreBundle\SonataCoreBundle;
use Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle;
use Symfony\Bundle\AsseticBundle\AsseticBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\SecurityBundle\SecurityBundle;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
use Victor\CloudinaryStorageBundle\VictorCloudinaryStorageBundle;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        return [
            new FrameworkBundle(),
            new TwigBundle(),
            new AsseticBundle(),
            new DoctrineBundle(),
            new SecurityBundle(),
            new SonataCoreBundle(),
            new SonataBlockBundle(),
            new KnpMenuBundle(),
            new SonataDoctrineORMAdminBundle(),
            new SonataAdminBundle(),
            new FOSJsRoutingBundle(),
            new VictorCloudinaryStorageBundle(),
        ];
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__ . '/config/config.yml');
    }
}
