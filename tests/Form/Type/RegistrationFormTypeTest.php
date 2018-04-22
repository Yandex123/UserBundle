<?php
/**
 * Created by PhpStorm.
 * User: thanhkhiet
 * Date: 21/04/2018
 * Time: 16:17
 */
namespace Cottect\Bundle\COTUserBundle\Tests\Form\Type;

use Cottect\Bundle\COTUserBundle\Form\Type\RegistrationFormType;
use Cottect\Bundle\COTUserBundle\Tests\TestUser;
use FOS\UserBundle\Tests\Form\Type\ValidatorExtensionTypeTestCase;

class RegistrationFormTypeTest extends ValidatorExtensionTypeTestCase
{
    public function testSubmit()
    {
        $user = new TestUser();

        $form = $this->factory->create(RegistrationFormType::class, $user);
        $formData = array(
            'firstName'=>'Doe',
            'lastName' => 'John',
            'emailOrPhone' => 'john@doe.com',
            'birthday'=> array("year" => "1907", "month" => "5", "day" => "11"),
            'plainPassword' => array(
                'first' => '123456@',
                'second' => '123456@',
            ),
            'gender'=>1
        );
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertSame($user, $form->getData());
        $this->assertSame('Doe', $user->getFirstName());
        $this->assertSame('John', $user->getLastName());
        $this->assertSame('john@doe.com', $user->getEmailOrPhone());
//        $this->assertSame('1907', $user->getBirthday());
        $this->assertSame('123456@', $user->getPlainPassword());
        $this->assertSame(1, $user->getGender());
    }

    /**
     * @return array
     */
    protected function getTypes()
    {
        return array_merge(parent::getTypes(), array(
            new RegistrationFormType('Cottect\Bundle\COTUserBundle\Tests\TestUser'),
        ));
    }
}