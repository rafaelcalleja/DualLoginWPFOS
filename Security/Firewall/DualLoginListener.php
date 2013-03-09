<?php 
namespace RC\DualLoginWPFOSBundle\Security\Firewall;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Http\Firewall\ListenerInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\Security\Core\Authentication\AuthenticationManagerInterface;

use Hypebeast\WordpressBundle\Security\Authentication\Token\WordpressCookieToken;
use Hypebeast\WordpressBundle\Security\User\WordpressUser;



class DualLoginListener implements ListenerInterface
{
	protected $securityContext;
    protected $authenticationManager;
    

    public function __construct(SecurityContextInterface $securityContext, AuthenticationManagerInterface $authenticationManager)
    {
        $this->securityContext = $securityContext;
        $this->authenticationManager = $authenticationManager;
        
    }

    public function handle(GetResponseEvent $event)
    {
   		 try {
				$token = $this->authenticationManager->authenticate(new WordpressCookieToken);
				$this->securityContext->setToken($token);
        } catch (AuthenticationException $e) {
           
        }
    }
}