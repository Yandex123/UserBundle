<?php
/**
 * Created by PhpStorm.
 * User: thanhkhiet
 * Date: 18/04/2018
 * Time: 14:57
 */

namespace Cottect\Bundle\COTUserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Cottect\Bundle\COTUserBundle\Model\User;

class RegistrationFormType extends AbstractType
{
    /**
     * @var string
     */
    private $class;

    /**
     * @param string $class The User class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'firstName', TextType::class, ['label' => false, 'attr' => ['placeholder' => 'label.firstName']])
            ->add('lastName',TextType::class,['label' => false,'attr' => ['placeholder' => 'label.lastName']])
            ->add('emailOrPhone',TextType::class,['label' => false,'attr' => ['placeholder' => 'label.emailOrPhone']])
            ->add('birthday',BirthdayType::class,['label_format' => "label.%name%"])
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'options' => array(
                    'translation_domain' => 'FOSUserBundle',
                    'attr' => array(
                        'autocomplete' => 'new-password',
                    ),
                ),
                'first_options' => array('label' => 'form.password'),
                'second_options' => array('label' => 'form.password_confirmation'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
            ->add('gender',ChoiceType::class,['choices' => ['Male' => 1,'Female' => 0],'expanded' => true,'multiple' => false,'label' => false, 'attr' => ['class' => 'form-check-inline']]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class,
            'csrf_token_id' => 'registration',
        ));
    }
}