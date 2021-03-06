<?php
namespace Cottect\Bundle\COTUserBundle\Security;

/**
 * Created by PhpStorm.
 * User: banhvinh
 * Date: 4/15/18
 * Time: 23:44
 */



/**
 * Class PhoneUserProvider
 * @package Cottect\Bundle\COTUserBundle\Security
 */
class PhoneUserProvider extends UserProvider
{

    /**
     * {@inheritdoc}
     */
    protected function findUser($phone)
    {
        return $this->userManager->findUserByEmailOrPhone($phone);
    }
}