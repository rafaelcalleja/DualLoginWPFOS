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
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class DualLoginListener implements ListenerInterface
{
	protected $securityContext;
    protected $authenticationManager;
    protected $container;

    public function __construct(SecurityContextInterface $securityContext, AuthenticationManagerInterface $authenticationManager, $api)
    {
        $this->securityContext = $securityContext;
        $this->authenticationManager = $authenticationManager;
        $this->api = $api;
    }

    public function handle(GetResponseEvent $event)
    {
   		 try {
	
				if( $event->getRequest()->get('_password') !== NULL ){
						
					$wpUser = $this->api->wp_signon(array(
							'user_login' => $event->getRequest()->get('_username'),
							'user_password' => $event->getRequest()->get('_password') ,
							'remember' => true
					));
					
					if ($wpUser instanceof \WP_User) {
						
						$user = new WordpressUser($wpUser);
						$authenticatedToken = new UsernamePasswordToken(
								$user, $event->getRequest()->get('_password'), '_user_wp', array());
					
						$newtoken = $this->authenticationManager->authenticate($authenticatedToken);
											$this->securityContext->setToken($newtoken);
						
						
						
					
					} else if ($wpUser instanceof \WP_Error) {
						throw new AuthenticationException(implode(', ', $wpUser->get_error_messages()));
					}
	           
			}
            
                        
        } catch (AuthenticationException $e) {
          
        }
    }
}