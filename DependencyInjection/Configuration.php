<?php

namespace Italia\SpidSymfonyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('spid');

        $rootNode->children()
            ->scalarNode('sp_entityid')->isRequired()->cannotBeEmpty()->defaultValue('%spid_symfony.sp_entityid%')->end()
            ->scalarNode('sp_key_file')->isRequired()->cannotBeEmpty()->defaultValue('%spid_symfony.sp_key_file%')->end()
            ->scalarNode('sp_cert_file')->isRequired()->cannotBeEmpty()->defaultValue('%spid_symfony.sp_cert_file%')->end()
            ->arrayNode('sp_attributeconsumingservice')->isRequired()->prototype('array')->requiresAtLeastOneElement()->prototype('scalar')->end()->end()->requiresAtLeastOneElement()->end()
            ->arrayNode('sp_assertionconsumerservice')->isRequired()->prototype('scalar')->end()->requiresAtLeastOneElement()->end()
            ->scalarNode('sp_singlelogoutservice')->isRequired()->cannotBeEmpty()->defaultValue('%spid_symfony.sp_singlelogoutservice%')->end()
            ->scalarNode('sp_org_name')->isRequired()->cannotBeEmpty()->defaultValue('%spid_symfony.%')->end()
            ->scalarNode('sp_org_display_name')->isRequired()->cannotBeEmpty()->defaultValue('%spid_symfony.sp_org_name%')->end()
            ->scalarNode('idp_metadata_folder')->isRequired()->cannotBeEmpty()->defaultValue('%spid_symfony.idp_metadata_folder%')->end()
            ->arrayNode('sp_key_cert_values')->prototype('array')
                ->children()
                ->scalarNode('countryName')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('stateOrProvinceName')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('localityName')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('commonName')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('emailAddress')->isRequired()->cannotBeEmpty()->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
