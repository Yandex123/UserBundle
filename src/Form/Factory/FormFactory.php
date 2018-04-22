<?php
/**
 * Created by PhpStorm.
 * User: thanhkhiet
 * Date: 18/04/2018
 * Time: 14:57
 */

namespace Cottect\Bundle\COTUserBundle\Form\Factory;

use Symfony\Component\Form\FormFactoryInterface;

class FormFactory implements FactoryInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $type;

    /**
     * @var array
     */
    private $validationGroups;

    /**
     * FormFactory constructor.
     *
     * @param FormFactoryInterface $formFactory
     * @param string               $name
     * @param string               $type
     * @param array                $validationGroups
     */
    public function __construct(FormFactoryInterface $formFactory, $name = null, $type, array $validationGroups = null)
    {
        $this->formFactory = $formFactory;
        $this->name = $name;
        $this->type = $type;
        $this->validationGroups = $validationGroups;
    }

    /**
     * {@inheritdoc}
     */
    public function createForm(array $options = array())
    {
        $options = array_merge(array('validation_groups' => $this->validationGroups), $options);

        return $this->formFactory->createNamed($this->name, $this->type, null, $options);
    }
}