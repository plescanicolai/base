<?php

namespace Feedify\BaseBundle\Service;

use Doctrine\ORM\EntityManager;
use Feedify\BaseBundle\Entity\Management\UserShop as UserShopEntity;
use Symfony\Component\Security\Core\Encoder\EncoderFactory;

/**
 * Class UserShop
 * @package Feedify\BaseBundle\Service
 */
class UserShop
{
    /** @var  EntityManager */
    protected $entityManager;

    /** @var  EncoderFactory */
    protected $securityFactory;

    /**
     * @param EntityManager  $entityManager
     * @param EncoderFactory $encoderFactory
     * @param UserShopEntity $userShop
     */
    public function __construct(EntityManager $entityManager, EncoderFactory $encoderFactory, UserShopEntity $userShop = null)
    {
        $this->entityManager = $entityManager;
        $this->securityFactory = $encoderFactory;

        if ($userShop === null) {
            /** @var UserShopEntity usershop */
            $this->usershop = new UserShopEntity();
        } else {
            /** @var UserShopEntity usershop */
            $this->usershop = $userShop;
        }
    }

    /**
     * Get userShop
     *
     * @return UserShopEntity
     */
    public function getUserShop()
    {
        return $this->usershop;
    }

    /**
     * Set userShop
     *
     * @param UserShopEntity $userShop
     */
    public function setUserShop($userShop)
    {
        $this->usershop = $userShop;
    }

    /**
     * Preparing user data and assigning it to userShop object
     *
     * @param array|string $data
     */
    public function prepareUserShopData($data)
    {
        $this->setUserid($data)
            ->setPassword($data)
            ->setActive($data)
            ->setRole($data)
            ->setSecret($data)
            ->setBridgeUrl($data)
            ->setUrlParams($data)
            ->setTitle($data)
            ->setActualConfig($data)
            ->setActualFields($data)
            ->setPossibleConfig($data)
            ->setPossibleFields($data)
            ->setShopName($data);
    }

    /**
     * Set userShop userid
     *
     * @param array|string $data
     * @return $this
     */
    public function setUserid($data)
    {
        if (!empty($data['userid'])) {
            $this->usershop->setUserid($data['userid']);
        }

        return $this;
    }

    /**
     * Set userShop new password
     *
     * @param array|string $data
     * @return $this
     */
    public function setPassword($data)
    {
        $encoder = $this->securityFactory->getEncoder($this->usershop);

        if (!empty($data['password'])) {
            $existingPassword = $this->usershop->getPassword();
            $newPassword = $encoder->encodePassword($data['password'], $this->usershop->getSalt());
            if ($existingPassword != $newPassword) {
                $this->usershop->setPassword($newPassword);
            }
        }

        return $this;
    }

    /**
     * Set userShop active parameter
     *
     * @param array|string $data
     * @return $this
     */
    public function setActive($data)
    {
        if (!empty($data['active'])) {
            $this->usershop->setActive($data['active']);
        } else {
            $this->usershop->setActive(1);
        }

        return $this;
    }

    /**
     * Set userShop role
     *
     * @param array|string $data
     * @return $this
     */
    public function setRole($data)
    {
        if (!empty($data['role'])) {
            $this->usershop->setRole($data['role']);
        }

        return $this;
    }

    /**
     * Set userShop secret
     *
     * @param array|string $data
     * @return $this
     */
    public function setSecret($data)
    {
        if (!empty($data['secret'])) {
            $this->usershop->setSecret($data['secret']);
        }

        return $this;
    }

    /**
     * Set userShop bridgeUrl
     *
     * @param array|string $data
     * @return $this
     */
    public function setBridgeUrl($data)
    {
        if (!empty($data['bridgeUrl'])) {
            $this->usershop->setBridgeUrl($data['bridgeUrl']);
        }

        return $this;
    }

    /**
     * Set userShop urlParams
     *
     * @param array|string $data
     * @return $this
     */
    public function setUrlParams($data)
    {
        if (isset($data['urlParams'])) {
            $this->usershop->setUrlParams($data['urlParams']);
        }

        return $this;
    }

    /**
     * Set userShop title
     *
     * @param array|string $data
     * @return $this
     */
    public function setTitle($data)
    {
        if (isset($data['title'])) {
            $this->usershop->setTitle($data['title']);
        }

        return $this;
    }

    /**
     * Set userShop actualConfig
     *
     * @param array|string $data
     * @return $this
     */
    public function setActualConfig($data)
    {
        if (isset($data['actualConfig'])) {
            $this->usershop->setActualConfig($data['actualConfig']);
        }

        return $this;
    }

    /**
     * Set userShop actualFields
     *
     * @param array|string $data
     * @return $this
     */
    public function setActualFields($data)
    {
        if (isset($data['actualFields'])) {
            $this->usershop->setActualFields($data['actualFields']);
        }

        return $this;
    }

    /**
     * Set userShop possibleConfig
     *
     * @param array|string $data
     * @return $this
     */
    public function setPossibleConfig($data)
    {
        if (isset($data['possibleConfig'])) {
            $this->usershop->setPossibleConfig($data['possibleConfig']);
        }

        return $this;
    }

    /**
     * Set userShop possibleFields
     *
     * @param array|string $data
     * @return $this
     */
    public function setPossibleFields($data)
    {
        if (isset($data['possibleFields'])) {
            $this->usershop->setPossibleFields($data['possibleFields']);
        }

        return $this;
    }

    /**
     * Set userShop user shop name
     *
     * @param array|string $data
     * @return $this
     */
    public function setShopName($data)
    {
        if (isset($data['shopName'])) {
            $this->usershop->setShopName($data['shopName']);
        }

        return $this;
    }

    /**
     * Save UserShopEntity into DB
     *
     * @return bool
     * @throws \Exception
     */
    public function save()
    {
        try {
            $this->entityManager->persist($this->usershop);
            $this->entityManager->flush();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return true;
    }

    /**
     * Delete UserShopEntity
     *
     * @return bool
     * @throws \Exception
     */
    public function delete()
    {
        try {
            $this->entityManager->remove($this->usershop);
            $this->entityManager->flush();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }

        return true;
    }
}
