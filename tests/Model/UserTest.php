<?php
/**
 * Created by PhpStorm.
 * User: thanhkhiet
 * Date: 21/04/2018
 * Time: 15:31
 */

namespace Cottect\Bundle\COTUserBundle\Tests\Model;

use Cottect\Bundle\COTUserBundle\Model\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testFirstName()
    {
        $user = new User();
        $this->assertNull($user->getFirstName());

        $user->setFirstName('Joe');
        $this->assertSame('Joe', $user->getFirstName());
    }

    public function testLastName()
    {
        $user = new User();
        $this->assertNull($user->getLastName());

        $user->setLastName('John');
        $this->assertSame('John', $user->getLastName());
    }

    public function testIsPasswordRequestNonExpired()
    {
        $user = new User();
        $passwordRequestedAt = new \DateTime('-10 seconds');

        $user->setPasswordRequestedAt($passwordRequestedAt);

        $this->assertSame($passwordRequestedAt, $user->getPasswordRequestedAt());
        $this->assertTrue($user->isPasswordRequestNonExpired(15));
        $this->assertFalse($user->isPasswordRequestNonExpired(5));
    }

    public function testIsPasswordRequestAtCleared()
    {
        $user = new User();
        $passwordRequestedAt = new \DateTime('-10 seconds');

        $user->setPasswordRequestedAt($passwordRequestedAt);
        $user->setPasswordRequestedAt(null);

        $this->assertFalse($user->isPasswordRequestNonExpired(15));
        $this->assertFalse($user->isPasswordRequestNonExpired(5));
    }
}