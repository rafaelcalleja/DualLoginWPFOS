<?php 
namespace RC\DualLoginWPFOSBundle\Security\Factory;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\SecurityFactoryInterface;


class DualLoginFactory implements SecurityFactoryInterface
{
	
    public function create(ContainerBuilder $container, $id, $config, $userProvider, $defaultEntryPoint)
    {
        $providerId = 'security.authentication.provider.duallogin.'.$id;
        $container
            ->setDefinition($providerId, new DefinitionDecorator('duallogin.security.authentication.provider'))
            ->replaceArgument(0, new Reference($userProvider))
        ;

        $listenerId = 'security.authentication.listener.duallogin.'.$id;
        $listener = $container->setDefinition($listenerId, new DefinitionDecorator('duallogin.security.authentication.listener'));
		
        return array($providerId, $listenerId, $defaultEntryPoint);
    }

    public function getPosition()
    {
        return 'pre_auth';
    }

    public function getKey()
    {
        return 'duallogin';
    }

    public function addConfiguration(NodeDefinition $node)
    {
    }
}