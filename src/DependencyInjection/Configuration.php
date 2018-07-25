<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 01.02.16
 * Time: 12:41
 */

namespace Victor\CloudinaryStorageBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('cloudinary_storage', 'array');

        $rootNode
            ->children()
                ->scalarNode('storage_name')
                    ->end()
                ->scalarNode('key')
                    ->end()
                ->scalarNode('url')
                    ->end()
                ->scalarNode('secret')
                    ->end()
                ->scalarNode('uploaded_file_name')
                    ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
