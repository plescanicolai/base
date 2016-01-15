<?php

namespace Feedify\BaseBundle\Constant\Customer;

/**
 * Class Product
 * @package Feedify\BaseBundle\Constant\Customer
 */
class Product
{
    const PRODUCTS_PER_PAGE = 15;

    const AVAILABILITY_IN_STOCK = 1;
    const AVAILABILITY_OUT_OF_STOCK = 2;
    const AVAILABILITY_PREORDER = 3;

    const CONDITION_NEW = 1;
    const CONDITION_USED = 2;
    const CONDITION_REFURBISHED = 3;

    const STATUSMARKET_DEFAULT = -1;
    const STATUSMARKET_UNAVAILABLE = 0;
    const STATUSMARKET_AVAILABLE = 1;
}
