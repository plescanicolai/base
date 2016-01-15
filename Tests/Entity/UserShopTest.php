<?php
namespace Feedify\BaseBundle\Tests\Entity;

use Feedify\BaseBundle\Entity\Management\UserShop;

class UserShopTest extends \PHPUnit_Framework_TestCase
{

    public function testConstructor($a = null) {
        $userShop = new UserShop();
        $userShop2 = new UserShop();
        $className = get_class($userShop);
        $this->assertClassHasAttribute('salt', $className, 'salt must be set');
        $this->assertNotEmpty($userShop->getSalt(), "salt can't be empty");
        $this->assertNotEquals($userShop->getSalt(), $userShop2->getSalt(), "salt must be random generated");

        $this->assertClassHasAttribute('role', $className, 'role must be set');
        $this->assertNotEmpty($userShop->getRole(), "role can't be empty");

        $this->assertClassHasAttribute('active', $className, 'attribute active must be set');
        $this->assertEquals(0, $userShop->getActive(), 'when setting a new UserShop object active should be 0');
    }


    public function testSetUserid()
    {
        $userShop = new UserShop();
        $userShop->setUserid('ABCDG13246546');
        $this->assertEquals('ABCDG13246546', $userShop->getUserid());
    }

    public function testSetPassword()
    {
        $userShop = new UserShop();
        $userShop->setPassword('feedify');
        $this->assertEquals('feedify', $userShop->getPassword());
    }

    public function testSetRole()
    {
        $userShop = new UserShop();
        $userShop->setUserid('ROLE_API_USER');
        $this->assertEquals('ROLE_API_USER', $userShop->getRole());
    }

    public function testSetActive()
    {
        $userShop = new UserShop();
        $userShop->setActive(1);
        $this->assertEquals(1, $userShop->getActive());
    }

    public function testSetSecret()
    {
        $userShop = new UserShop();
        $userShop->setSecret('testSecret');
        $this->assertEquals('testSecret', $userShop->getSecret());
    }

    public function testSetBridgeUrl()
    {
        $userShop = new UserShop();
        $userShop->setBridgeUrl('testSetBridgeUrl');
        $this->assertEquals('testSetBridgeUrl', $userShop->getBridgeUrl());
    }


    public function testSetPossibleConfig() {
        $userShop = new UserShop();
        $sPossibleConfig =  array(
              'langid' => array(
                  'key'  => 'lang',
                  'title' => 'Language',
                  'values' => array(
                      '0' => array(
                          'key' => 'lt',
                          'title' => 'Lithianian'
                      ),
                      '1' => array(
                          'key' => 'en',
                          'title' => 'English'
                      )
                  )
              ),
            'currency' => array(
                'key'  => 'currency',
                'title' => 'Currency',
                'values' => array(
                    '0' => array(
                        'key' => 'EUR',
                        'title' => 'Euro'
                    ),
                    '1' => array(
                        'key' => 'USD',
                        'title' => 'US Dollar'
                    )
                )
            ),
            'stock' => array(
                'key'  => 'stock',
                'title' => 'StockConfig',
                'values' => array(
                    '0' => array(
                        'key' => '1',
                        'title' => 'More when 5'
                    ),
                    '1' => array(
                        'key' => '2',
                        'title' => 'More when 0'
                    )
                )
            ),
        );

        $userShop->setPossibleConfig($sPossibleConfig);
        $this->assertEquals($sPossibleConfig, $userShop->getPossibleConfig());
    }


    public function testSetActualConfig() {
        $userShop = new UserShop();
        $sActualConfig = array(
            'lang' => 'lt',
            'currency' => 'EUR',
            'stock' => '2',
        );
        $userShop->setActualConfig($sActualConfig);
        $this->assertEquals($sActualConfig, $userShop->getActualConfig());
    }



    public function testSetTitle()
    {
        $userShop = new UserShop();
        $userShop->setTitle('testTitle');
        $this->assertEquals('testTitle', $userShop->getTitle());
    }


}