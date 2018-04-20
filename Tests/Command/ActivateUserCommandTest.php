<?php

namespace Cottect\Bundle\COTUserBundle\Tests\Command;

use Cottect\Bundle\COTUserBundle\Command\ActivateUserCommand;
use Cottect\Bundle\COTUserBundle\Util\UserManipulator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class ActivateUserCommandTest extends TestCase
{
    public function testExecute()
    {
        $commandTester = $this->createCommandTester($this->getManipulator('user'));
        $exitCode = $commandTester->execute(array(
            'username' => 'user',
        ), array(
            'decorated' => false,
            'interactive' => false,
        ));

        $this->assertSame(0, $exitCode, 'Returns 0 in case of success');
        $this->assertRegExp('/User "user" has been activated/', $commandTester->getDisplay());
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

        $application->getHelperSet()->set($helper, 'question');

        $commandTester = $this->createCommandTester($this->getManipulator('user'), $application);
        $exitCode = $commandTester->execute(array(), array(
            'decorated' => false,
            'interactive' => true,
        ));

        $this->assertSame(0, $exitCode, 'Returns 0 in case of success');
        $this->assertRegExp('/User "user" has been activated/', $commandTester->getDisplay());
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

        $command = new ActivateUserCommand($manipulator);

        $application->add($command);

        return new CommandTester($application->find('cot:user:activate'));
    }

    /**
     * @param $username
     *
     * @return mixed
     */
    private function getManipulator($username)
    {
        $manipulator = $this->getMockBuilder('Cottect\Bundle\COTUserBundle\Util\UserManipulator')
            ->disableOriginalConstructor()
            ->getMock();

        $manipulator
            ->expects($this->once())
            ->method('activate')
            ->with($username)
        ;

        return $manipulator;
    }
}
