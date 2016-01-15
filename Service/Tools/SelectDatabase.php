<?php
namespace Feedify\BaseBundle\Service\Tools;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManager;
use Feedify\BaseBundle\Entity\Management\Customer;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\Security\Core\SecurityContext;

/**
 * Class SelectDatabase
 * @package Feedify\BaseBundle\Service\Tools
 */
class SelectDatabase
{
    /**
     * @param SecurityContext $securityContext
     * @param Connection      $connection
     * @param EntityManager   $entityManager
     */
    public function __construct($securityContext, $connection, $entityManager)
    {
        $this->securityContext = $securityContext;
        $this->connection = $connection;
        $this->entityManager = $entityManager;
    }

    /**
     * @param FilterControllerEvent $event
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        /** @var Customer $user */
        $user = $this->getUser();
        if (isset($user) && $user instanceof Customer) {
            $this->changeDb($user);
        }
    }


    /**
     * @param Customer $customer
     */
    public function changeDb($customer)
    {
        $refConn = new \ReflectionObject($this->connection);
        $refParams = $refConn->getProperty('_params');
        $refParams->setAccessible('public'); //we have to change it for a moment
        $params = $refParams->getValue($this->connection);

        $params['dbname'] = $customer->getDbName();

        $refParams->setAccessible('private');
        $refParams->setValue($this->connection, $params);
    }

    /**
     * @param int $clientId
     */
    public function changeDatabaseByCustomerId($clientId)
    {
        $customer = $this->entityManager->getRepository('FeedifyBaseBundle:Management\Customer')->findOneBy(
            array('clientId' => $clientId)
        );

        if ($customer && $customer instanceof Customer) {
            $this->changeDb($customer);
        }
    }

    /**
     * Get a user from the Security Context
     *
     * @return mixed
     *
     * @throws \LogicException If SecurityBundle is not available
     *
     * @see Symfony\Component\Security\Core\Authentication\Token\TokenInterface::getUser()
     */
    protected function getUser()
    {
        if (null === $token = $this->securityContext->getToken()) {
            return null;
        }

        if (!is_object($user = $token->getUser())) {
            return null;
        }

        return $user;
    }
}
