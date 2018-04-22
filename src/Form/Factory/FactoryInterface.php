<?php
/**
 * Created by PhpStorm.
 * User: thanhkhiet
 * Date: 18/04/2018
 * Time: 14:58
 */
namespace Cottect\Bundle\COTUserBundle\Form\Factory;

use Symfony\Component\Form\FormInterface;

interface FactoryInterface
{
    /**
     * @return FormInterface
     */
    public function createForm();
}