<?php

namespace Feedify\BaseBundle\Service;

use Doctrine\ORM\EntityManager;

use Feedify\BaseBundle\Entity\Customer\ClicksRepository;
use Feedify\BaseBundle\Entity\Customer\Config;
use Feedify\BaseBundle\Entity\Customer\CategoryMappingRepository;
use Feedify\BaseBundle\Entity\Customer\LogExportMarketRepository;
use Feedify\BaseBundle\Entity\Customer\OrdersProductsRepository;
use Feedify\BaseBundle\Entity\Customer\OrdersRepository;
use Feedify\BaseBundle\Entity\Customer\Product;
use Feedify\BaseBundle\Entity\Customer\Product\ChannelRepository;
use Feedify\BaseBundle\Entity\Customer\Product\ProductDescriptionRepository;
use Feedify\BaseBundle\Entity\Customer\Product\ProductsToMarketsRepository;
use Feedify\BaseBundle\Entity\Customer\Product\CategoryRepository;
use Feedify\BaseBundle\Entity\Customer\ProductRepository;
use Feedify\BaseBundle\Entity\Customer\ProvidersRepository;
use Feedify\BaseBundle\Entity\Management\CountryDescriptionRepository;
use Feedify\BaseBundle\Entity\Management\CountryRepository;
use Feedify\BaseBundle\Entity\Management\Customer\RoleRepository;
use Feedify\BaseBundle\Entity\Management\CustomerRepository;
use Feedify\BaseBundle\Entity\Management\DailyStatisticRepository;
use Feedify\BaseBundle\Entity\Management\FilterRepository;
use Feedify\BaseBundle\Entity\Management\LanguageRepository;
use Feedify\BaseBundle\Entity\Management\Market;
use Feedify\BaseBundle\Entity\Management\Market\DescriptionRepository;
use Feedify\BaseBundle\Entity\Management\MarketRepository;
use Feedify\BaseBundle\Entity\Management\RulesRepository;
use Feedify\BaseBundle\Entity\Management\SchedulerRepository;
use Feedify\BaseBundle\Entity\Management\UserMailsRepository;
use Feedify\BaseBundle\Entity\Management\UserShopRepository;
use Feedify\BaseBundle\Entity\Management\UserTicketRepository;
use Feedify\BaseBundle\Entity\Management\WidgetRepository;
use Feedify\BaseBundle\Entity\Management\CategoriesBecomeRepository;
use Feedify\BaseBundle\Entity\Management\CategoriesGoogleRepository;
use Feedify\BaseBundle\Entity\Management\CategoriesMilandoRepository;
use Feedify\BaseBundle\Entity\Management\CategoriesShoppingRepository;
use Feedify\BaseBundle\Entity\Management\CategoriesYategoRepository;
use Feedify\BaseBundle\Entity\Customer\ConfigRepository;
use Feedify\BaseBundle\Entity\Management\UserTicket;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Feedify\BaseBundle\Entity\Management\SiteViewsRepository;
use Feedify\BaseBundle\Entity\Management\SiteViews;
use Feedify\BaseBundle\Entity\Management\UserMails;

/**
 * Class Configuration
 * @package Feedify\BaseBundle\Service
 */
abstract class AbstractConfiguration
{
    /** @var EntityManager $entityManager */
    protected $entityManager;

    /** @var EntityManager $customerManager */
    protected $customerManager;

    /**
     * @param EntityManager $entityManager
     */
    public function setDefaultManager(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param EntityManager $customerManager
     */
    public function setCustomerManager(EntityManager $customerManager)
    {
        $this->customerManager = $customerManager;
    }

    /**
     * @param string $key
     * @param string $value
     * @return bool
     */
    public function setConfigEntity($key, $value)
    {
        /** @var Config $entity */
        $entity = $this->getConfigEntity($key);
        if (!$entity) {
            $entity = new Config();
            $entity->setConfigurationKey($key);
        }
        $entity->setConfigurationValue($value);

        return $this->saveManager($entity);
    }

    /**
     * @param string|array $key
     * @return Config|object
     */
    public function getConfigEntity($key)
    {
        $entity = $this->getConfigRepository()->findOneBy(array('configurationKey' => $key));
        if (!$entity) {
            return null;
        }

        return $entity;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function removeConfigEntity($key)
    {
        /** @var Config $entity */
        $entity = $this->getConfigEntity($key);
        if ($entity) {
            return $this->deleteManager($entity);
        }

        return true;
    }

    /**
     * @param object    $entity
     * @param string    $manager
     * @param bool|true $flush
     * @return bool
     */
    public function saveManager($entity, $manager = 'customerManager', $flush = true)
    {
        try {
            $this->$manager->persist($entity);
            if ($flush) {
                $this->$manager->flush();
            }
        } catch (\Exception $e) {
            if (!$this->$manager->isOpen()) {
                $this->$manager = $this->$manager->create(
                    $this->$manager->getConnection(),
                    $this->$manager->getConfiguration()
                );
            }

            return false;
        }

        return true;
    }

    /**
     * Delete entity from database
     *
     * @param object $entity
     * @param string $manager
     * @return bool
     */
    public function deleteManager($entity, $manager = 'customerManager')
    {
        try {
            $this->$manager->remove($entity);
            $this->$manager->flush();
        } catch (\Exception $e) {
            if (!$this->$manager->isOpen()) {
                $this->$manager = $this->$manager->create(
                    $this->$manager->getConnection(),
                    $this->$manager->getConfiguration()
                );
            }

            return false;
        }

        return true;
    }

    /** GLOBAL functions */
    /**
     * @return array
     */
    public function getTimeList()
    {
        return [
            'total'     => 'filters.time.total',
            'today'     => 'filters.time.today',
            'yesterday' => 'filters.time.yesterday',
            '24hours'   => 'filters.time.24hours',
            '7days'     => 'filters.time.7days',
            'week'      => 'filters.time.week',
            'currmonth' => 'filters.time.current.month',
            'month'     => 'filters.time.month',
            '2months'   => 'filters.time.2months',
            '3months'   => 'filters.time.3months',
            'quarter'   => 'filters.time.quarter',
            '2quarters' => 'filters.time.2quarters',
            '6months'   => 'filters.time.6months',
            'curryear'  => 'filters.time.current.year',
            'year'      => 'filters.time.12months',
            'lastyear'  => 'filters.time.lastyear',
            'custom'    => 'filters.time.custom',
        ];
    }

    /**
     * Get start Date for Select
     *
     * @param string      $time
     * @param null|string $startDate
     * @return string
     */
    public function getTimeStart($time, $startDate = null)
    {
        if (empty($time)) {
            $time = 'currmonth';
        }
        $dateTime = new \DateTime();
        switch ($time) {
            case 'today':
                $result = $dateTime->format('Y-m-d');
                break;
            case 'yesterday':
                $result = $dateTime->modify('-1 day')->format('Y-m-d');
                break;
            case '24hours':
                $result = $dateTime->modify('-24 hours')->format('Y-m-d H:i:s');
                break;
            case '7days':
                $result = $dateTime->modify('-7 days')->format('Y-m-d');
                break;
            case 'week':
                $result = $dateTime->modify(($dateTime->format('w') === '0') ? 'monday last week' : 'monday this week')
                    ->format('Y-m-d');
                break;
            case 'currmonth':
                $result = $dateTime->format('Y-m-01');
                break;
            case 'month':
                $result = $dateTime->modify('-1 month')->format('Y-m-d');
                break;
            case '2months':
                $result = $dateTime->modify('-2 month')->format('Y-m-d');
                break;
            case '3months':
                $result = $dateTime->modify('-3 month')->format('Y-m-d');
                break;
            case 'quarter':
                $result = $dateTime->modify('-'.(($dateTime->format('n') - 1) % 3).' month')->format('Y-m-d');
                break;
            case '2quarters':
                $result = $dateTime->modify('-'.(($dateTime->format('n') - 1) % 6).' month')->format('Y-m-d');
                break;
            case '6months':
                $result = $dateTime->modify('-6 month')->format('Y-m-d');
                break;
            case 'curryear':
                $result = $dateTime->format('Y-01-01');
                break;
            case 'year':
                $result = $dateTime->modify('-1 year')->format('Y-m-d');
                break;
            case 'lastyear':
                $result = $dateTime->modify('-1 year')->format('Y-01-01');
                break;
            case 'custom':
                if ($startDate) {
                    $result = $startDate;
                } else {
                    $result = '';
                }
                break;
            default:
                $result = '';
        }

        return $result;
    }

    /**
     * Get end Date for Select
     *
     * @param string      $time
     * @param null|string $endDate
     * @return bool|string
     */
    public function getTimeEnd($time, $endDate = null)
    {
        if (empty($time)) {
            $time = 'currmonth';
        }
        $dateTime = new \DateTime();
        switch ($time) {
            case 'today':
                $result = $dateTime->format('Y-m-d H:i:s');
                break;
            case 'yesterday':
                $result = $dateTime->modify('-1 day')->format('Y-m-d 23:59:59');
                break;
            case '24hours':
                $result = $dateTime->format('Y-m-d H:i:s');
                break;
            case '7days':
                $result = $dateTime->format('Y-m-d H:i:s');
                break;
            case 'week':
                $result = $dateTime->modify(($dateTime->format('w') === '0') ? 'now' : 'sunday this week')
                    ->format('Y-m-d 23:59:59');
                break;
            case 'currmonth':
                $result = $dateTime->format('Y-m-d H:i:s');
                break;
            case 'month':
                $result = $dateTime->format('Y-m-d H:i:s');
                break;
            case '2months':
                $result = $dateTime->format('Y-m-d H:i:s');
                break;
            case '3months':
                $result = $dateTime->format('Y-m-d H:i:s');
                break;
            case 'quarter':
                $result = $dateTime->format('Y-m-d H:i:s');
                break;
            case '2quarters':
                $result = $dateTime->format('Y-m-d H:i:s');
                break;
            case '6months':
                $result = $dateTime->format('Y-m-d H:i:s');
                break;
            case 'curryear':
                $result = $dateTime->format('Y-m-d H:i:s');
                break;
            case 'year':
                $result = $dateTime->format('Y-m-d H:i:s');
                break;
            case 'lastyear':
                $result = $dateTime->format('Y');
                break;
            case 'custom':
                if ($endDate) {
                    $result = $endDate.' 23:59:59';
                } else {
                    $result = '';
                }
                break;
            default:
                $result = '';
        }

        return $result;
    }

    /**
     * Format a number by language
     *
     * @param int    $number
     * @param int    $decimals
     * @param string $langCode
     * @return int
     */
    public function getNumberFormatByLanguage($number, $decimals, $langCode)
    {
        if (!empty($number)) {
            $decimalPoint = '.';
            $thousandsSeparator = ',';
            if (!empty($langCode)) {
                switch ($langCode) {
                    case 'ru':
                        $decimalPoint = ',';
                        $thousandsSeparator = ' ';
                        break;
                    case 'de':
                    case 'it':
                        $decimalPoint = ',';
                        $thousandsSeparator = '.';
                        break;
                }
            }

            return number_format($number, $decimals, $decimalPoint, $thousandsSeparator);
        }

        return 0;
    }

    /**
     * Sort an array by key $sortField
     *
     * @param array      $data
     * @param string     $sortField
     * @param int|string $sortOrder = 4(SORT_ASC) / 3(SORT_DESC)
     * @return array $data
     */
    public function sortArrayByKey(&$data, $sortField, $sortOrder = SORT_ASC)
    {
        foreach ($data as $values) {
            $keys[] = $values[$sortField];
        }

        array_multisort($keys, $sortOrder, $data);
    }

    /**
     * Get product link for redirect
     *
     * @param int         $clientId
     * @param Market|int  $marketData
     * @param Product|int $productData
     * @param string      $url
     * @param string      $redirect
     * @return string
     */
    public function getNewProductUrl($clientId, $marketData, $productData, $url, $redirect)
    {
        if (empty($clientId) || !$marketData || !$productData || empty($url)) {
            return '';
        }

        $marketId = $marketData instanceof Market ? $marketData->getId() : $marketData;
        $productId = $productData instanceof Product ? $productData->getId() : $productData;
        $data = [
            $clientId,
            $marketId,
            $productId,
            $url,
        ];

        return $redirect.'?'.urlencode(base64_encode(gzdeflate(implode(chr(172), $data))));
    }

    /**
     * @param array        $data
     * @param string       $username
     * @param UploadedFile $attach
     * @param string       $domain
     * @return bool
     */
    public function addUserTicket($data, $username, $attach, $domain)
    {
        $userTicket = new UserTicket();
        /** @var UploadedFile $attach */
        if ($attach) {
            $path = 'images/tickets/';
            $uploadedFileInfo = pathinfo($attach->getClientOriginalName());
            $fileName = $username.'_'.time().".".$uploadedFileInfo['extension'];
            $attach->move($path, $fileName);
            $userTicket->setImage('http://'.$domain.'/web/'.$path.$fileName);
        }

        $userTicket->setUsername($username);
        $userTicket->setContent($data);
        if (!$this->saveManager($userTicket, 'entityManager')) {
            return false;
        }

        return true;
    }

    /**
     * @param string $username
     * @param string $where
     * @param string $from
     */
    public function siteViewsInsert($username, $where = '', $from = '')
    {
        $register = $this->getSiteViewsRepository()->findOneBy(['usernameOrUserIp' => $username]);
        $time = new \DateTime();

        if (!$register) {
            $register = new SiteViews();
            $register->setUsernameOrUserIp($username);
            $register->setFromUrl($from);
            $register->setWhereUrl(str_replace("www.", "", $where));
            $register->setContent([$time->format('h:i/d-m-y') => $time]);
        } else {
            if ($time->diff($register->getLastVisit())->h < 1) {
                return;
            }
            $content = $register->getContent();
            $content[$time->format('h:i/d-m-y')] = $time;
            $register->setContent($content);
        }

        $register->setLastVisit($time);
        $this->saveManager($register, 'entityManager');
    }

    /**
     * @param string       $username
     * @param string       $key
     * @param string|array $value
     */
    public function saveUserMailsInDb($username, $key, $value)
    {
        $register = $this->getUserMailsRepository()->findOneBy(array('username' => $username, 'mailKey' => $key));

        if (!$register) {
            $register = new UserMails();
            $register->setUsername($username);
            $register->setMailKey($key);
        }

        $register->setAtDate(new \DateTime());
        $register->setMailValue($value);
        $this->saveManager($register, 'entityManager');
    }


    /** ===================== REPOSITORIES ================== */
    // Customer Manager
    /**
     * @return CategoryRepository
     */
    public function getCategoriesRepository()
    {
        return $this->customerManager->getRepository('FeedifyBaseBundle:Customer\Product\Category');
    }

    /**
     * @return ChannelRepository
     */
    public function getChannelRepository()
    {
        return $this->customerManager->getRepository('FeedifyBaseBundle:Customer\Product\Channel');

    }

    /**
     * @return ProductsToMarketsRepository
     */
    public function getProductToMarketRepository()
    {
        return $this->customerManager->getRepository('FeedifyBaseBundle:Customer\Product\ProductsToMarkets');
    }

    /**
     * @return CategoryMappingRepository
     */
    public function getCategoryMappingRepository()
    {
        return $this->customerManager->getRepository('FeedifyBaseBundle:Customer\CategoryMapping');
    }

    /**
     * @return ClicksRepository
     */
    public function getClicksRepository()
    {
        return $this->customerManager->getRepository('FeedifyBaseBundle:Customer\Clicks');
    }

    /**
     * @return ConfigRepository
     */
    public function getConfigRepository()
    {
        return $this->customerManager->getRepository('FeedifyBaseBundle:Customer\Config');
    }

    /**
     * @return LogExportMarketRepository
     */
    public function getLogExportMarketRepository()
    {
        return $this->customerManager->getRepository('FeedifyBaseBundle:Customer\LogExportMarket');

    }

    /**
     * @return OrdersRepository
     */
    public function getOrdersRepository()
    {
        return $this->customerManager->getRepository('FeedifyBaseBundle:Customer\Orders');
    }

    /**
     * @return OrdersProductsRepository
     */
    public function getOrdersProductsRepository()
    {
        return $this->customerManager->getRepository('FeedifyBaseBundle:Customer\OrdersProducts');
    }

    /**
     * @return ProductRepository
     */
    public function getProductRepository()
    {
        return $this->customerManager->getRepository('FeedifyBaseBundle:Customer\Product');
    }

    /**
     * @return ProductDescriptionRepository
     */
    public function getProductDescriptionRepository()
    {
        return $this->customerManager->getRepository('FeedifyBaseBundle:Customer\Product\ProductDescription');
    }

    /**
     * @return ProvidersRepository
     */
    public function getProviderRepository()
    {
        return $this->customerManager->getRepository('FeedifyBaseBundle:Customer\Provider');
    }


    // Entity Manager
    /**
     * @return DescriptionRepository
     */
    public function getDescriptionRepository()
    {
        return $this->entityManager->getRepository('FeedifyBaseBundle:Management\Market\Description');
    }

    /**
     * @return CountryRepository
     */
    public function getCountryRepository()
    {
        return $this->entityManager->getRepository('FeedifyBaseBundle:Management\Country');
    }

    /**
     * @return CountryDescriptionRepository
     */
    public function getCountryDescriptionRepository()
    {
        return $this->entityManager->getRepository('FeedifyBaseBundle:Management\CountryDescription');
    }

    /**
     * @return CustomerRepository
     */
    public function getCustomerRepository()
    {
        return $this->entityManager->getRepository('FeedifyBaseBundle:Management\Customer');
    }

    /**
     * @return RoleRepository
     */
    public function getCustomerRoleRepository()
    {
        return $this->entityManager->getRepository('FeedifyBaseBundle:Management\Customer\Role');
    }

    /**
     * @return LanguageRepository
     */
    public function getLanguageRepository()
    {
        return $this->entityManager->getRepository('FeedifyBaseBundle:Management\Language');
    }

    /**
     * @return MarketRepository
     */
    public function getMarketRepository()
    {
        return $this->entityManager->getRepository('FeedifyBaseBundle:Management\Market');
    }

    /**
     * @return RulesRepository
     */
    public function getRulesRepository()
    {
        return $this->entityManager->getRepository('FeedifyBaseBundle:Management\Rules');
    }

    /**
     * @return CategoriesBecomeRepository
     */
    public function getCategoriesBecomeRepository()
    {
        return $this->entityManager->getRepository('FeedifyBaseBundle:Management\CategoriesBecome');
    }

    /**
     * @return CategoriesGoogleRepository
     */
    public function getCategoriesGoogleRepository()
    {
        return $this->entityManager->getRepository('FeedifyBaseBundle:Management\CategoriesGoogle');
    }

    /**
     * @return CategoriesShoppingRepository
     */
    public function getCategoriesShoppingRepository()
    {
        return $this->entityManager->getRepository('FeedifyBaseBundle:Management\CategoriesShopping');
    }

    /**
     * @return CategoriesMilandoRepository
     */
    public function getCategoriesMilandoRepository()
    {
        return $this->entityManager->getRepository('FeedifyBaseBundle:Management\CategoriesMilando');
    }

    /**
     * @return CategoriesYategoRepository
     */
    public function getCategoriesYategoRepository()
    {
        return $this->entityManager->getRepository('FeedifyBaseBundle:Management\CategoriesYatego');
    }

    /**
     * @return UserShopRepository
     */
    public function getUserShopRepository()
    {
        return $this->entityManager->getRepository('FeedifyBaseBundle:Management\UserShop');
    }

    /**
     * @return SchedulerRepository
     */
    public function getSchedulerRepository()
    {
        return $this->entityManager->getRepository('FeedifyBaseBundle:Management\Scheduler');
    }

    /**
     * @return WidgetRepository
     */
    public function getWidgetRepository()
    {
        return $this->entityManager->getRepository('FeedifyBaseBundle:Management\Widget');
    }

    /**
     * @return FilterRepository
     */
    public function getFilterRepository()
    {
        return $this->entityManager->getRepository('FeedifyBaseBundle:Management\Filter');
    }

    /**
     * @return DailyStatisticRepository
     */
    public function getDailyStatisticRepository()
    {
        return $this->entityManager->getRepository('FeedifyBaseBundle:Management\DailyStatistic');
    }

    /**
     * @return UserTicketRepository
     */
    public function getUserTicketRepository()
    {
        return $this->entityManager->getRepository('FeedifyBaseBundle:Management\UserTicket');
    }

    /**
     * @return SiteViewsRepository
     */
    public function getSiteViewsRepository()
    {
        return $this->entityManager->getRepository('FeedifyBaseBundle:Management\SiteViews');
    }

    /**
     * @return UserMailsRepository
     */
    public function getUserMailsRepository()
    {
        return $this->entityManager->getRepository('FeedifyBaseBundle:Management\UserMails');
    }
}
