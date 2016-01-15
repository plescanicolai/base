<?php
namespace Feedify\BaseBundle\Service\Management;

use Doctrine\DBAL\DBALException;
use Doctrine\DBAL\Driver\Statement;
use Doctrine\ORM\EntityManager;
use Feedify\BaseBundle\Entity\Management\Customer as CustomerEntity;
use Feedify\BaseBundle\Entity\Management\Customer\Role;
use Feedify\BaseBundle\Entity\Management\Customer\Extra;
use Feedify\BaseBundle\Constant\Management\Customer as CustomerConstant;
use Feedify\BaseBundle\Entity\Management\CustomerRepository;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;

/**
 * Class Customer
 * @package Feedify\BaseBundle\Service\Management
 */
class Customer
{
    /**
     * @param EntityManager  $management
     * @param EntityManager  $customer
     * @param EncoderFactory $encoderFactory
     */
    public function __construct($management, $customer, $encoderFactory)
    {
        $this->managementEm = $management;
        $this->customerEm = $customer;
        $this->encoderFactory = $encoderFactory;
    }

    /**
     * @param string $username
     * @return CustomerEntity
     */
    public function getCustomer($username)
    {
        /** @var CustomerRepository $customerRepository */
        $customerRepository = $this->managementEm->getRepository('FeedifyBaseBundle:Management\Customer');

        return $customerRepository->loadUserByUsername($username);
    }

    /**
     * Save customer Entity
     *
     * @param CustomerEntity $customer
     * @return bool
     */
    public function saveCustomer(CustomerEntity $customer)
    {
        try {
            $this->managementEm->persist($customer);
            $this->managementEm->flush();
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * @return mixed
     */
    public function getNewClientId()
    {
        /** @var CustomerRepository $customer */
        $customer = $this->managementEm
            ->getRepository('FeedifyBaseBundle:Management\Customer');

        return $customer->getMaxClientId();
    }

    /**
     * @return mixed
     */
    public function getNewUserName()
    {
        /** @var CustomerRepository $customer */
        $customer = $this->managementEm
            ->getRepository('FeedifyBaseBundle:Management\Customer');

        return $customer->getMaxUserName();
    }

    /**
     * @return string
     */
    public function getDbServer()
    {
        return $this->customerEm->getConnection()->getHost();
    }

    /**
     * @return string
     */
    public function getDbUser()
    {
        return $this->customerEm->getConnection()->getUsername();
    }

    /**
     * @param string $username
     * @return string
     */
    public function getDbName($username)
    {
        return 'db_'.$username;
    }

    /**
     * @return string
     */
    public function getDbPassword()
    {
        return $this->customerEm->getConnection()->getPassword();
    }

    /**
     * @param integer $username
     * @return bool
     */
    public function createUserDB($username)
    {
        try {
            $sql = 'create database if not exists db_'.$username.' CHARACTER SET UTF8;';
            $this->customerEm->getConnection()->exec($sql);
        } catch (\Exception $e) {
            return false;
        }

        $sql = 'mysqldump -h '.$this->getDbServer().' -u '.$this->getDbUser().'  -p'.$this
                ->getDbPassword().' fd_referenz | mysql -h '.$this->getDbServer().' -u '.$this
                ->getDbUser().' -p'.$this->getDbPassword().' db_'.$username.'';

        try {
            exec($sql);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * Create User entity and save into DB
     *
     * @param array $data
     * @throws \Exception
     * @return mixed
     */
    public function createRegistrationCustomer($data)
    {
        if (!$data) {
            return false;
        }

        if ($customer = $this->checkCustomerExist($data)) {
            return $customer;
        }

        list($customer, $password) = $this->createNewCustomer($data);

        try {
            $this->managementEm->persist($customer);
            $this->managementEm->flush();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }

        /** @var CustomerEntity $customer */
        if ($this->createUserDB($customer->getUsername())) {
            return array('customer' => $customer, 'password' => $password);
        }

        return false;
    }

    /**
     * @param array $data
     * @return array
     */
    public function createNewCustomer($data)
    {
        $customer = new CustomerEntity();

        $maxUserName = (int) $this->getNewUserName() + 1;
        $customer->setClientId($maxUserName);
        $customer->setUsername($maxUserName);

        $customer->setSalutation($data['salutation']);
        $customer->setEmail($data['email']);
        $customer->setFirstName($data['firstName']);
        $customer->setLastName($data['lastName']);
        $customer->setDomain($data['domain']);

        $encoder = $this->encoderFactory->getEncoder($customer);
        $password = $this->generateRandomString();
        $customer->setPassword($encoder->encodePassword($password, $customer->getSalt()));

        $customer->setIsActive(true);
        $customer->setDbServer($this->getDbServer());
        $customer->setDbUser($this->getDbUser());
        $customer->setDbName($this->getDbName($customer->getUsername()));
        $customer->setDbPassword($this->getDbPassword());

        if (!isset($data['plan'])) {
            $data['plan'] = 269;
        }
        $customer->setTariff($data['plan']);

        $this->addNewRole($customer);

        $this->addNewExtra($data, $customer);

        return array($customer, $password);
    }

    /**
     * @param CustomerEntity $customer
     */
    public function addNewRole($customer)
    {
        $role = new Role();
        $role->setCustomer($customer)->setRole(CustomerConstant::ROLE_SETUP);
        $customer->addRole($role);
    }

    /**
     * @param array          $data
     * @param CustomerEntity $customer
     */
    public function addNewExtra($data, $customer)
    {
        if ($data['token']) {
            $extra = new Extra();
            $extra->setCustomer($customer);
            if (isset($data['partnerId'])) {
                $extra->setPartnerId($data['partnerId']);
            }
            $extra->setSetupStep(0);
            $extra->setTarifId($data['plan']);
            $extra->setToken($data['token']);
        } else {
            $extra = null;
        }

        $customer->setExtra($extra);
    }

    /**
     * Check if customer was created earlier
     *
     * @param array $data
     * @return bool|CustomerEntity
     */
    public function checkCustomerExist($data)
    {
        $customer = $this->managementEm->getRepository('FeedifyBaseBundle:Management\Customer\Extra')->findOneBy(
            [
                'token' => $data['token'],
            ]
        );

        if ($customer) {
            return $customer->getCustomer();
        }

        return false;
    }

    /**
     * Generate random string for salt and new Password
     *
     * @return string
     */
    public function generateRandomString()
    {
        $char = 'abcdefghijklmnopqrstuvwxyz';
        $charUpper = strtoupper($char);
        $numeric = '0123456789';

        $string = $char.$charUpper.$numeric;
        $maxLength = strlen($string) - 1;

        $randomString = '';
        for ($index = 0; $index < 9; $index++) {
            $randomString .= substr($string, rand(0, $maxLength), 1);
        }

        return str_shuffle($randomString);
    }

    /**
     * @param string|int $username
     * @return bool|Statement
     * @throws DBALException
     */
    public function dropCustomerDB($username)
    {
        if ($this->checkCustomerDatabase($username)) {
            return $this->customerEm
                ->getConnection()
                ->exec("DROP DATABASE db_".$username);
        }

        return false;
    }

    /**
     * @param string $username
     * @return mixed
     * @throws DBALException
     */
    protected function checkCustomerDatabase($username)
    {
        return $this->customerEm
            ->getConnection()
            ->fetchColumn('SHOW DATABASES LIKE :username', ['username' => 'db_'.$username]);
    }
}
