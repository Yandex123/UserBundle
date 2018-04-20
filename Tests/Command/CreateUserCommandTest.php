<?php

namespace Cottect\Bundle\COTUserBundle\Tests\Command;

use Cottect\Bundle\COTUserBundle\Command\CreateUserCommand;
use Cottect\Bundle\COTUserBundle\Util\UserManipulator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class CreateUserCommandTest extends TestCase
{
    public function testExecute()
    {
        $commandTester = $this->createCommandTester($this->getManipulator('user', 'pass', 'email', true, false));
        $exitCode = $commandTester->execute(array(
            'username' => 'user',
            'email' => 'email',
            'password' => 'pass',
        ), array(
            'decorated' => false,
            'interactive' => false,
        ));

        $this->assertSame(0, $exitCode, 'Returns 0 in case of success');
        $this->assertRegExp('/Created user user/', $commandTester->getDisplay());
    }

    public function testExecuteInteractiveWithQuestionHelper()
    {
        $application = new Application();

        $helper = $this->getMockBuilder('Symfony\Component\Console\Helper\QuestionHelper')
            ->setMethods(array('ask'))
            ->getMock();

        $helper->expects($this->at(0))
            ->method('ask')
            ->will($this->returnValue('user'));

        $helper->expects($this->at(1))
            ->method('ask')
            ->will($this->returnValue('email'));

        $helper->expects($this->at(2))
            ->method('ask')
            ->will($this->returnValue('pass'));

        $application->getHelperSet()->set($helper, 'question');

        $commandTester = $this->createCommandTester(
            $this->getManipulator('user', 'pass', 'email', true, false), $application
        );
        $exitCode = $commandTester->execute(array(), array(
            'decorated' => false,
            'interactive' => true,
        ));

        $this->assertSame(0, $exitCode, 'Returns 0 in case of success');
        $this->assertRegExp('/Created user user/', $commandTester->getDisplay());
    }

    /**
     * @param UserManipulator  $manipulator
     * @param Application|null $application
     *
     * @return CommandTester
     */
    private function createCommandTester(UserManipulator $manipulator, Application $application = null)
    {
        if (null === $application) {
            $application = new Application();
        }

        $application->setAutoExit(false);

        $command = new CreateUserCommand($manipulator);

        $application->add($command);

        return new CommandTester($application->find('cot:user:create'));
    }

    /**
     * @param $username
     * @param $password
     * @param $email
     * @param $active
     * @param $superadmin
     *
     * @return mixed
     */
    private function getManipulator($username, $password, $email, $active, $superadmin)
    {
        $manipulator = $this->getMockBuilder('Cottect\Bundle\COTUserBundle\Util\UserManipulator')
            ->disableOriginalConstructor()
            ->getMock();

        $manipulator
            ->expects($this->once())
            ->method('create')
            ->with($username, $password, $email, $active, $superadmin)
        ;

        return $manipulator;
    }
}
