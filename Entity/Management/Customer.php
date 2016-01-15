<?php

namespace Feedify\BaseBundle\Entity\Management;

use Doctrine\ORM\Mapping as ORM;
use Feedify\BaseBundle\Entity\Management\Customer\Extra;
use Feedify\BaseBundle\Entity\Management\Customer\Role;
use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Customer
 *
 * @ORM\Table(name="customers",options={"collate"="utf8_general_ci"})
 * @ORM\Entity(repositoryClass="Feedify\BaseBundle\Entity\Management\CustomerRepository")
 */
class Customer extends MessageDigestPasswordEncoder implements AdvancedUserInterface, \Serializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="client_id", type="integer", unique=true)
     */
    private $clientId;

    /**
     * @ORM\Column(type="string", length=35, unique=true)
     */
    private $username;

    /**
     * @ORM\OneToMany(targetEntity="Feedify\BaseBundle\Entity\Management\Customer\Role", mappedBy="customer", cascade={"all"}))
     */
    private $roles;

    /**
     * @ORM\OneToOne(targetEntity="Feedify\BaseBundle\Entity\Management\Customer\Extra", mappedBy="customer", cascade={"all"}))
     */
    private $extra;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $salt;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $email;

    /**
     * @ORM\Column(name="shop_name", type="string", length=64, nullable=true)
     */
    private $shopName;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $db_server;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $db_user;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $db_password;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $db_name;

    /**
     * @ORM\Column(name="active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Column(name="locked", type="boolean")
     */
    private $isLocked;

    /**
     * Possible values :
     *      0   : demo
     *      1   : normal
     *
     * @ORM\Column(name="type", type="boolean")
     */
    private $type;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $tariff;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $register;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $rules;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $conditions;

    /**
     * Customer gender
     * Possible values :
     *      0   : undefined
     *      1   : male
     *      2   : female
     *
     * @var integer
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    private $salutation;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $company;

    /**
     * @ORM\Column(name="shop_url", type="string", nullable=true)
     */
    private $shopUrl;

    /**
     * @ORM\Column(name="first_name", type="string", nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(name="last_name", type="string", nullable=true)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $street;

    /**
     * @ORM\Column(name="street_nr", type="string", length=20, nullable=true)
     */
    private $streetNr;

    /**
     * @ORM\Column(name="post_code", type="string", length=10, nullable=true)
     */
    private $postCode;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity="Feedify\BaseBundle\Entity\Management\Country")
     * @ORM\JoinColumn(name="country", referencedColumnName="id", onDelete="RESTRICT")
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $mobile;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $fax;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $tax;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $vat;

    /**
     * @ORM\Column(name="account_holder", type="string", nullable=true)
     */
    private $accountHolder;

    /**
     * @ORM\Column(name="account_number", type="string", length=100, nullable=true)
     */
    private $accountNumber;

    /**
     * @ORM\Column(name="bank_code", type="string", length=100, nullable=true)
     */
    private $bankCode;

    /**
     * @ORM\Column(name="bank_name", type="string", length=100, nullable=true)
     */
    private $bankName;

    /**
     * @ORM\Column(name="bank_swift", type="string", length=50, nullable=true)
     */
    private $bankSwift;

    /**
     * @ORM\Column(name="bank_iban", type="string", length=50, nullable=true)
     */
    private $bankIban;

    /**
     * @ORM\Column(name="credit_card_owner", type="string", length=100, nullable=true)
     */
    private $creditCardOwner;

    /**
     * @ORM\Column(name="credit_card_number", type="integer", length=16, nullable=true)
     */
    private $creditCardNumber;

    /**
     * @ORM\Column(name="credit_card_type", type="string", length=100, nullable=true)
     */
    private $creditCardType;

    /**
     * @ORM\Column(name="expiration_month", type="string", nullable=true)
     */
    private $expirationMonth;

    /**
     * @ORM\Column(name="expiration_year", type="string", nullable=true)
     */
    private $expirationYear;

    /**
     * @ORM\Column(name="security_code", type="smallint", nullable=true)
     */
    private $securityCode;

    /**
     * @ORM\Column(name="payment_type", type="integer", nullable=true)
     */
    private $paymentType;

    /**
     * @ORM\Column(name="offer_nr", type="string", nullable=true)
     */
    private $offerNr;

    /**
     * @ORM\Column(name="offer_date", type="date", nullable=true)
     */
    private $offerDate;

    /**
     * @ORM\Column(name="billerfox_contract_id", type="string", nullable=true)
     */
    private $billerfoxContractId;

    /**
     * @ORM\Column(name="billerfox_last_error", type="json_array", nullable=true)
     */
    private $billerfoxLastError;

    /**
     * @ORM\Column(name="billerfox_date", type="datetime", nullable=true)
     */
    private $billerfoxSentDate;

    /**
     * @ORM\Column(name="registration_step", type="integer", nullable=true)
     */
    private $registrationStep;

    /**
     * @ORM\Column(name="domain", type="string", length=32, nullable=true)
     */
    private $domain;

    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
        $this->roles = new ArrayCollection();
        $this->isActive = false;
        $this->isLocked = false;
        $this->salt = md5(uniqid(null, true));
        $this->rules = false;
        $this->conditions = false;
        $this->type = true;
        $this->register = new \DateTime();
        $this->shopUrl = '';
        $this->streetNr = '';
        $this->state = '';
        $this->db_server = '';
        $this->db_user = '';
        $this->db_name = '';
        $this->db_password = '';
        $this->paymentType = 0;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }


    /**
     * @return \Psr\Http\Message\RequestInterface|string
     */
    public function serialize()
    {
        return serialize([$this->id]);
    }

    /**
     * @see \Serializable::unserialize()
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        list($this->id) = unserialize($serialized);
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set clientId
     *
     * @param integer $clientId
     * @return Customer
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Get clientId
     *
     * @return integer
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Set username
     *
     * @param string $username
     * @return Customer
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Add role
     *
     * @param Role $role
     * @return Customer
     */
    public function addRole(Role $role)
    {
        $this->roles[] = $role;

        return $this;
    }

    /**
     * @return array
     */
    public function getRoles()
    {
        return $this->roles->toArray();
    }

    /**
     * Remove role
     *
     * @param \Feedify\BaseBundle\Entity\Management\Customer\Role $role
     */
    public function removeRole(Role $role)
    {
        $this->roles->removeElement($role);
    }

    /**
     * Set extra
     * @param Extra $extra
     * @return Customer
     */
    public function setExtra($extra = null)
    {
        $this->extra = $extra;

        return $this;
    }

    /**
     * Get extra
     *
     * @return Extra
     */
    public function getExtra()
    {
        return $this->extra;
    }

    /**
     * Set salt
     *
     * @param string $salt
     * @return Customer
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;

        return $this;
    }

    /**
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Customer
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Customer
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set shopName
     *
     * @param string $shopName
     * @return Customer
     */
    public function setShopName($shopName = null)
    {
        $this->shopName = $shopName;

        return $this;
    }

    /**
     * Get shopName
     *
     * @return null|string
     */
    public function getShopName()
    {
        return $this->shopName;
    }

    /**
     * Set db_server
     *
     * @param string $dbServer
     * @return Customer
     */
    public function setDbServer($dbServer)
    {
        $this->db_server = $dbServer;

        return $this;
    }

    /**
     * Get db_server
     *
     * @return string
     */
    public function getDbServer()
    {
        return $this->db_server;
    }

    /**
     * Set db_user
     *
     * @param string $dbUser
     * @return Customer
     */
    public function setDbUser($dbUser)
    {
        $this->db_user = $dbUser;

        return $this;
    }

    /**
     * Get db_user
     *
     * @return string
     */
    public function getDbUser()
    {
        return $this->db_user;
    }

    /**
     * Set db_password
     *
     * @param string $dbPassword
     * @return Customer
     */
    public function setDbPassword($dbPassword)
    {
        $this->db_password = $dbPassword;

        return $this;
    }

    /**
     * Get db_password
     *
     * @return string
     */
    public function getDbPassword()
    {
        return $this->db_password;
    }

    /**
     * Set db_name
     *
     * @param string $dbName
     * @return Customer
     */
    public function setDbName($dbName)
    {
        $this->db_name = $dbName;

        return $this;
    }

    /**
     * Get db_name
     *
     * @return string
     */
    public function getDbName()
    {
        return $this->db_name;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Customer
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set isLocked
     *
     * @param boolean $isLocked
     * @return Customer
     */
    public function setIsLocked($isLocked)
    {
        $this->isLocked = $isLocked;

        return $this;
    }

    /**
     * Get isLocked
     *
     * @return boolean
     */
    public function getIsLocked()
    {
        return $this->isLocked;
    }

    /**
     * Set type
     *
     * @param boolean $type
     * @return Customer
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return boolean
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set tariff
     *
     * @param integer $tariff
     * @return Customer
     */
    public function setTariff($tariff = null)
    {
        $this->tariff = $tariff;

        return $this;
    }

    /**
     * Get tariff
     *
     * @return null|integer
     */
    public function getTariff()
    {
        return $this->tariff;
    }

    /**
     * Set register
     *
     * @param \DateTime $register
     * @return Customer
     */
    public function setRegister($register)
    {
        $this->register = $register;

        return $this;
    }

    /**
     * Get register
     *
     * @return \DateTime
     */
    public function getRegister()
    {
        return $this->register;
    }

    /**
     * Set rules
     *
     * @param integer $rules
     * @return Customer
     */
    public function setRules($rules)
    {
        $this->rules = $rules;

        return $this;
    }

    /**
     * Get rules
     *
     * @return integer
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * Set conditions
     *
     * @param boolean $conditions
     * @return Customer
     */
    public function setConditions($conditions)
    {
        $this->conditions = $conditions;

        return $this;
    }

    /**
     * Get conditions
     *
     * @return boolean
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * Set salutation
     *
     * @param integer $salutation
     * @return Customer
     */
    public function setSalutation($salutation)
    {
        $this->salutation = $salutation;

        return $this;
    }

    /**
     * Get salutation
     *
     * @return integer
     */
    public function getSalutation()
    {
        return $this->salutation;
    }

    /**
     * Set company
     *
     * @param string $company
     * @return Customer
     */
    public function setCompany($company = null)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return null|string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set shopUrl
     *
     * @param string $shopUrl
     * @return Customer
     */
    public function setShopUrl($shopUrl = null)
    {
        $this->shopUrl = $shopUrl;

        return $this;
    }

    /**
     * Get shopUrl
     *
     * @return null|string
     */
    public function getShopUrl()
    {
        return $this->shopUrl;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Customer
     */
    public function setFirstName($firstName = null)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return null|string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Customer
     */
    public function setLastName($lastName = null)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return null|string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set street
     *
     * @param string $street
     * @return Customer
     */
    public function setStreet($street = null)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return null|string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set streetNr
     *
     * @param string $streetNr
     * @return Customer
     */
    public function setStreetNr($streetNr = null)
    {
        $this->streetNr = $streetNr;

        return $this;
    }

    /**
     * Get streetNr
     *
     * @return null|string
     */
    public function getStreetNr()
    {
        return $this->streetNr;
    }

    /**
     * Set postCode
     *
     * @param string $postCode
     * @return Customer
     */
    public function setPostCode($postCode = null)
    {
        $this->postCode = $postCode;

        return $this;
    }

    /**
     * Get postCode
     *
     * @return null|string
     */
    public function getPostCode()
    {
        return $this->postCode;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Customer
     */
    public function setCity($city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return null|string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Customer
     */
    public function setState($state = null)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return null|string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set country
     *
     * @param \Feedify\BaseBundle\Entity\Management\Country $country
     * @return Customer
     */
    public function setCountry(Country $country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return \Feedify\BaseBundle\Entity\Management\Country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Customer
     */
    public function setPhone($phone = null)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return null|string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set mobile
     *
     * @param string $mobile
     * @return Customer
     */
    public function setMobile($mobile = null)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return null|string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set fax
     *
     * @param string $fax
     * @return Customer
     */
    public function setFax($fax = null)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return null|string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set tax
     *
     * @param string $tax
     * @return Customer
     */
    public function setTax($tax = null)
    {
        $this->tax = $tax;

        return $this;
    }

    /**
     * Get tax
     *
     * @return null|string
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * Set vat
     *
     * @param string $vat
     * @return Customer
     */
    public function setVat($vat = null)
    {
        $this->vat = $vat;

        return $this;
    }

    /**
     * Get vat
     *
     * @return null|string
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * Set accountHolder
     *
     * @param string $accountHolder
     * @return Customer
     */
    public function setAccountHolder($accountHolder = null)
    {
        $this->accountHolder = $accountHolder;

        return $this;
    }

    /**
     * Get accountHolder
     *
     * @return null|string
     */
    public function getAccountHolder()
    {
        return $this->accountHolder;
    }

    /**
     * Set accountNumber
     *
     * @param string $accountNumber
     * @return Customer
     */
    public function setAccountNumber($accountNumber = null)
    {
        $this->accountNumber = $accountNumber;

        return $this;
    }

    /**
     * Get accountNumber
     *
     * @return null|string
     */
    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    /**
     * Set bankCode
     *
     * @param string $bankCode
     * @return Customer
     */
    public function setBankCode($bankCode = null)
    {
        $this->bankCode = $bankCode;

        return $this;
    }

    /**
     * Get bankCode
     *
     * @return null|string
     */
    public function getBankCode()
    {
        return $this->bankCode;
    }

    /**
     * Set bankName
     *
     * @param string $bankName
     * @return Customer
     */
    public function setBankName($bankName = null)
    {
        $this->bankName = $bankName;

        return $this;
    }

    /**
     * Get bankName
     *
     * @return null|string
     */
    public function getBankName()
    {
        return $this->bankName;
    }

    /**
     * Set bankSwift
     *
     * @param string $bankSwift
     * @return Customer
     */
    public function setBankSwift($bankSwift = null)
    {
        $this->bankSwift = $bankSwift;

        return $this;
    }

    /**
     * Get bankSwift
     *
     * @return null|string
     */
    public function getBankSwift()
    {
        return $this->bankSwift;
    }

    /**
     * Set bankIban
     *
     * @param string $bankIban
     * @return Customer
     */
    public function setBankIban($bankIban = null)
    {
        $this->bankIban = $bankIban;

        return $this;
    }

    /**
     * Get bankIban
     *
     * @return null|string
     */
    public function getBankIban()
    {
        return $this->bankIban;
    }

    /**
     * Set creditCardOwner
     *
     * @param string $creditCardOwner
     * @return Customer
     */
    public function setCreditCardOwner($creditCardOwner = null)
    {
        $this->creditCardOwner = $creditCardOwner;

        return $this;
    }

    /**
     * Get creditCardOwner
     *
     * @return null|string
     */
    public function getCreditCardOwner()
    {
        return $this->creditCardOwner;
    }

    /**
     * Set creditCardNumber
     *
     * @param integer $creditCardNumber
     * @return Customer
     */
    public function setCreditCardNumber($creditCardNumber = null)
    {
        $this->creditCardNumber = $creditCardNumber;

        return $this;
    }

    /**
     * Get creditCardNumber
     *
     * @return null|integer
     */
    public function getCreditCardNumber()
    {
        return $this->creditCardNumber;
    }

    /**
     * Set creditCardType
     *
     * @param string $creditCardType
     * @return Customer
     */
    public function setCreditCardType($creditCardType = null)
    {
        $this->creditCardType = $creditCardType;

        return $this;
    }

    /**
     * Get creditCardType
     *
     * @return null|string
     */
    public function getCreditCardType()
    {
        return $this->creditCardType;
    }

    /**
     * Set expirationMonth
     *
     * @param string $expirationMonth
     * @return Customer
     */
    public function setExpirationMonth($expirationMonth = null)
    {
        $this->expirationMonth = $expirationMonth;

        return $this;
    }

    /**
     * Get expirationMonth
     *
     * @return null|string
     */
    public function getExpirationMonth()
    {
        return $this->expirationMonth;
    }

    /**
     * Set expirationYear
     *
     * @param string $expirationYear
     * @return Customer
     */
    public function setExpirationYear($expirationYear = null)
    {
        $this->expirationYear = $expirationYear;

        return $this;
    }

    /**
     * Get expirationYear
     *
     * @return null|string
     */
    public function getExpirationYear()
    {
        return $this->expirationYear;
    }

    /**
     * Set securityCode
     *
     * @param int $securityCode
     * @return Customer
     */
    public function setSecurityCode($securityCode = null)
    {
        $this->securityCode = $securityCode;

        return $this;
    }

    /**
     * Get securityCode
     *
     * @return null|int
     */
    public function getSecurityCode()
    {
        return $this->securityCode;
    }

    /**
     * Set paymentType
     *
     * @param integer $paymentType
     * @return Customer
     */
    public function setPaymentType($paymentType = null)
    {
        $this->paymentType = $paymentType;

        return $this;
    }

    /**
     * Get paymentType
     *
     * @return null|integer
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * Set offerNr
     *
     * @param string $offerNr
     * @return Customer
     */
    public function setOfferNr($offerNr = null)
    {
        $this->offerNr = $offerNr;

        return $this;
    }

    /**
     * Get offerNr
     *
     * @return null|string
     */
    public function getOfferNr()
    {
        return $this->offerNr;
    }

    /**
     * Set offerDate
     *
     * @param \DateTime $offerDate
     * @return Customer
     */
    public function setOfferDate($offerDate)
    {
        $this->offerDate = $offerDate;

        return $this;
    }

    /**
     * Get offerDate
     *
     * @return \DateTime
     */
    public function getOfferDate()
    {
        return $this->offerDate;
    }

    /**
     * Set billerfoxContractId
     *
     * @param string $billerfoxContractId
     * @return Customer
     */
    public function setBillerfoxContractId($billerfoxContractId = null)
    {
        $this->billerfoxContractId = $billerfoxContractId;

        return $this;
    }

    /**
     * Get billerfoxContractId
     *
     * @return null|string
     */
    public function getBillerfoxContractId()
    {
        return $this->billerfoxContractId;
    }

    /**
     * Set billerfoxLastError
     *
     * @param array $billerfoxLastError
     * @return Customer
     */
    public function setBillerfoxLastError($billerfoxLastError = null)
    {
        $this->billerfoxLastError = $billerfoxLastError;

        return $this;
    }

    /**
     * Get billerfoxLastError
     *
     * @return null|array
     */
    public function getBillerfoxLastError()
    {
        return $this->billerfoxLastError;
    }

    /**
     * Set billerfoxSentDate
     *
     * @param \DateTime $billerfoxSentDate
     * @return Customer
     */
    public function setBillerfoxSentDate($billerfoxSentDate)
    {
        $this->billerfoxSentDate = $billerfoxSentDate;

        return $this;
    }

    /**
     * Get billerfoxSentDate
     *
     * @return \DateTime
     */
    public function getBillerfoxSentDate()
    {
        return $this->billerfoxSentDate;
    }

    /**
     * Set registrationStep
     *
     * @param integer $registrationStep
     * @return Customer
     */
    public function setRegistrationStep($registrationStep = null)
    {
        $this->registrationStep = $registrationStep;

        return $this;
    }

    /**
     * Get registrationStep
     *
     * @return null|integer
     */
    public function getRegistrationStep()
    {
        return $this->registrationStep;
    }

    /**
     * Set domain
     *
     * @param string $domain
     * @return Customer
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;

        return $this;
    }

    /**
     * Get domain
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Checks whether the user's account has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw an AccountExpiredException and prevent login.
     *
     * @return Boolean true if the user's account is non expired, false otherwise
     *
     * @see AccountExpiredException
     */
    public function isAccountNonExpired()
    {
        return true;
    }

    /**
     * Checks whether the user is locked.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a LockedException and prevent login.
     *
     * @return Boolean true if the user is not locked, false otherwise
     *
     * @see LockedException
     */
    public function isAccountNonLocked()
    {
        return !$this->getIsLocked();
    }

    /**
     * Checks whether the user's credentials (password) has expired.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a CredentialsExpiredException and prevent login.
     *
     * @return Boolean true if the user's credentials are non expired, false otherwise
     *
     * @see CredentialsExpiredException
     */
    public function isCredentialsNonExpired()
    {
        return true;
    }

    /**
     * Checks whether the user is enabled.
     *
     * Internally, if this method returns false, the authentication system
     * will throw a DisabledException and prevent login.
     *
     * @return Boolean true if the user is enabled, false otherwise
     *
     * @see DisabledException
     */
    public function isEnabled()
    {
        return $this->getIsActive();
    }
}
