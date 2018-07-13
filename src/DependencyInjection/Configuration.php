<?php
/**
 * Created by PhpStorm.
 * User: victor
 * Date: 01.02.16
 * Time: 12:41
 */

namespace Victor\FileStorageBundle\DependencyInjection;


use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('file_storage', 'array');

        $rootNode
            ->children()
                ->scalarNode('default_storage')
                    ->end()
                ->arrayNode('storages')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('storage_name')
                                ->end()
                            ->scalarNode('key')
                                ->end()
                            ->scalarNode('url')
                                ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
