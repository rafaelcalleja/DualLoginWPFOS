<?php 
namespace RC\DualLoginWPFOSBundle\Security\Authentication\Provider; 

use Symfony\Component\Security\Core\Authentication\Provider\AuthenticationProviderInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\NonceExpiredException;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

use Hypebeast\WordpressBundle\Wordpress\ApiAbstraction;
use Hypebeast\WordpressBundle\Security\Authentication\Provider\WordpressLoginAuthenticationProvider;

class DualLoginProvider extends WordpressLoginAuthenticationProvider
{
    
    public function __construct(UserProviderInterface $userProvider, $cacheDir, ApiAbstraction $api){
		parent::__construct($api, parent::isRememberMeRequested());
    }

    public function authenticate(TokenInterface $token){
    	parent::authenticate($token);
    }

    public function supports(TokenInterface $token){
    	return parent::supports($token);
    }
}