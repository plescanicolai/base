<?php

namespace Feedify\BaseBundle\Service;

use Feedify\BaseBundle\Constant\Customer\Product;
use Feedify\BaseBundle\Constant\Management\Mapping;
use Feedify\BaseBundle\Entity\Management\Market;
use Feedify\BaseBundle\Entity\Customer\Provider;
use Feedify\BaseBundle\Entity\Management\CategoriesGoogle;
use Feedify\BaseBundle\Constant\Management\Market as MarketConst;
use Feedify\BaseBundle\Service\Language;

/**
 * Class Markets
 * @package Feedify\BaseBundle\Service
 */
class Markets extends AbstractConfiguration
{
    /** @var Language $langService*/
    protected $langService;

    /**
     * @param Language $langService
     */
    public function __construct($langService)
    {
        $this->langService = $langService;
    }

    /**
     * Get All markets to show for customer
     *
     * @param array $countryArray
     * @return array
     */
    public function getMarkets($countryArray)
    {
        $languageId = $this->langService->getActiveLanguage()->getId();

        $activeProviders = $this->getProviderRepository()->getMarketsIdByStatus(1);

        $markets = $this->getMarketRepository()->getMarketsWithLanguage($languageId);

        $marketsResult = $marketsChosen = array();
        /** @var Market $market */
        foreach ($markets as $market) {
            $marketsData = [
                'id'          => $market->getId(),
                'image'       => $market->getImageUrl(),
                'name'        => $market->getName(),
                'type'        => $market->getType(),
                'description' => ($market->getDescriptions() && $market->getDescriptions()->current())
                    ? $market->getDescriptions()->current()->getDescription()
                    : '',
            ];

            if ($market->getType() == MarketConst::TYPE_PREMIUM) {
                $type = 'premium';
            } elseif ($market->getType() == MarketConst::TYPE_COMPARISON) {
                $type = 'price';
            } else {
                $type = 'other';
            }

            if (!in_array($market->getId(), $activeProviders)) {
                if (!$countryArray || in_array($market->getCountry()->getId(), $countryArray)) {
                    $marketsResult[$type][] = $marketsData;
                }
            } else {
                $marketsChosen[] = $marketsData;
            }
        }

        return [
            'marketsData'   => $marketsResult,
            'chosenMarkets' => $marketsChosen,
        ];
    }

    /**
     * Insert market into customer chosen markets
     *
     * @param int $id
     * @return bool
     */
    public function saveMarket($id)
    {
        $market = $this->getMarketRepository()->find($id);

        if ($market) {
            $provider = $this->getProviderRepository()->findOneBy(array('market' => $id));
            if (!$provider) {
                $provider = new Provider();
                $provider->setName($market->getName());
                $provider->setMarket($id);
                $provider->setActiveSince();
                // new changes for specified markets
                switch ($market->getId()) {
                    //for market dooyoo.de
                    case 201:
                        $provider->setClickPriceValue(0.1);
                        $provider->setClickPriceType(0);
                        break;
                    //for market Geizhals.at
                    case 203:
                        $provider->setClickPriceValue(0.15);
                        $provider->setClickPriceType(0);
                        break;
                    //for market become.de
                    case 206:
                        $provider->setClickPriceValue(0.13);
                        $provider->setClickPriceType(0);
                        $provider->setMinSalesValue(200);
                        $provider->setMinSalesType(0);
                        break;
                    //for market Shopzilla.de
                    case 237:
                        $provider->setClickPriceValue(0.2);
                        $provider->setClickPriceType(0);
                        $provider->setMinSalesValue(50);
                        $provider->setMinSalesType(0);
                        break;
                    //for market billiger.de
                    case 238:
                        $provider->setClickPriceValue(0.25);
                        $provider->setClickPriceType(0);
                        $provider->setMinSalesValue(100);
                        $provider->setMinSalesType(0);
                        break;
                    //for market shopping.com
                    case 239:
                    case 281:
                    case 282:
                    case 283:
                    case 284:
                        $provider->setClickPriceValue(0.1);
                        $provider->setClickPriceType(0);
                        break;
                    // for market hardwareschotte.de
                    case 245:
                        $provider->setClickPriceValue(0.12);
                        $provider->setClickPriceType(0);
                        $provider->setFreeClicks(100);
                        $provider->setFreeClicksType(1);
                        break;
                    //for market Preisroboter.de
                    case 251:
                        $provider->setClickPriceValue(0.14);
                        $provider->setClickPriceType(0);
                        break;
                    //for market Pricerunner.de
                    case 255:
                        $provider->setClickPriceValue(0.1);
                        $provider->setClickPriceType(0);
                        break;
                    //for market smatch.com
                    case 326:
                        $provider->setClickPriceValue(0.3);
                        $provider->setClickPriceType(0);
                        break;
                    //for market Ladenzeile.de
                    case 342:
                        $provider->setClickPriceValue(0.15);
                        $provider->setClickPriceType(0);
                        break;
                    default:
                        $provider->setClickPriceValue(0.2);
                        $provider->setClickPriceType(0);
                }
            }
            $provider->setStatus(1);
            //Activate all the products for this market
            $this->getProductRepository()->updateProductStatusMarket(Product::STATUSMARKET_DEFAULT);

            return $this->saveManager($provider);
        }

        return false;
    }

    /**
     * Get market category data
     *
     * @param int    $marketId
     * @param int    $marketCategoryId
     * @param string $parameter
     * @param string $languageCode
     * @return null|string
     */
    public function getMarketCategoryData($marketId, $marketCategoryId, $parameter = '', $languageCode = '')
    {
        if ($languageCode) {
            $languageCode = ucfirst(strtolower($languageCode));
        }

        switch ($marketId) {
            case Mapping::GOOGLE_SHOPPING_EN_ID:
            case Mapping::GOOGLE_SHOPPING_DE_ID:
            case Mapping::GOOGLE_SHOPPING_UK_ID:
            case Mapping::GOOGLE_SHOPPING_IT_ID:
            case Mapping::GOOGLE_SHOPPING_FR_ID:
            case Mapping::GOOGLE_SHOPPING_PL_ID:
                $google = new CategoriesGoogle();
                !method_exists($google, 'getName'.$languageCode) && $languageCode = '';
                if ($parameter == 'children') {
                    $response = $this->getCategoriesGoogleRepository()->getCategoriesByParent(
                        $marketCategoryId,
                        $languageCode
                    );
                } else {
                    $response = ($marketCategory = $this->getCategoriesGoogleRepository()->find($marketCategoryId))
                        ? call_user_func(array($marketCategory, 'getFull'.$languageCode))
                        : null;
                }
                break;
            case Mapping::YATEGO_ID:
                if ($parameter == 'children') {
                    $response = $this->getCategoriesYategoRepository()->getCategoriesByParent($marketCategoryId);
                } else {
                    $marketCategory = $this->getCategoriesYategoRepository()->find($marketCategoryId);
                    $response = $marketCategory ? $marketCategory->getFull() : null;
                }
                break;
            case Mapping::BECOME_DE_ID:
            case Mapping::BECOME_IT_ID:
                if ($parameter == 'children') {
                    $response = $this->getCategoriesBecomeRepository()->getCategoriesByParent($marketCategoryId);
                } else {
                    $marketCategory = $this->getCategoriesBecomeRepository()->find($marketCategoryId);
                    $response = $marketCategory ? $marketCategory->getFull() : null;
                }
                break;
            case Mapping::SHOPPING_DE_ID:
            case Mapping::SHOPPING_US_ID:
            case Mapping::SHOPPING_UK_ID:
            case Mapping::SHOPPING_FR_ID:
            case Mapping::SHOPPING_AU_ID:
                if ($parameter == 'children') {
                    $response = $this->getCategoriesShoppingRepository()->getCategoriesByParent($marketCategoryId);
                } elseif ($parameter == 'id') {
                    $marketCategory = $this->getCategoriesShoppingRepository()->find($marketCategoryId);
                    $response = $marketCategory ? $marketCategory->getCategoryId() : null;
                } else {
                    $marketCategory = $this->getCategoriesShoppingRepository()->find($marketCategoryId);
                    $response = $marketCategory ? $marketCategory->getFull() : null;
                }
                break;
            case Mapping::MILANDO_ID:
                if ($parameter == 'children') {
                    $response = $this->getCategoriesMilandoRepository()->getCategoriesByParent($marketCategoryId);
                } else {
                    $marketCategory = $this->getCategoriesMilandoRepository()->find($marketCategoryId);
                    $response = $marketCategory ? $marketCategory->getFull() : null;
                }
                break;
            default:
                $response = null;
        }

        return $response;
    }
}
