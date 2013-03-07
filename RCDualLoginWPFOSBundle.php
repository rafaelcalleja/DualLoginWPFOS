<?php

namespace RC\DualLoginWPFOSBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use RC\DualLoginWPFOSBundle\Security\Factory\DualLoginFactory;

class RCDualLoginWPFOSBundle extends Bundle{
	
	public function build(ContainerBuilder $container){
		parent::build($container);
	
		$extension = $container->getExtension('security');
		$extension->addSecurityListenerFactory(new DualLoginFactory());
	
	}
}
