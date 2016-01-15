<?php

namespace Feedify\BaseBundle\Constant\Management;

/**
 * Class Management
 * @package Feedify\BaseBundle\Constant\Management
 */
class Management
{
    const IGNORED_USER_IPS = '192.168.33.1,91.65.113.211,192.168.11.167,178.168.31.64,91.65.211.70,127.0.0.1,192.168.56.1';

    const USER_MAIL_CONFIRM_REGISTER = 'CONFIRM_REGISTER';
    const USER_MAIL_CONFIRM_REGISTER_FREE = 'CONFIRM_REGISTER_FREE';
    const USER_MAIL_REMIND_PASSWORD = 'REMIND_PASSWORD';
    const USER_MAIL_CHANGE_PASSWORD = 'CHANGE_PASSWORD';
    const USER_MAIL_UPGRADE = 'UPGRADE';
    const USER_MAIL_HOME_PAGE = 'HOME_PAGE';
}
