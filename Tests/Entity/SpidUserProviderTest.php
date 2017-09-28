<?php
namespace Italia\SpidSymfonyBundle\Tests\Entity;

use Italia\SpidSymfonyBundle\Entity\SpidUserProvider;
use Italia\SpidSymfonyBundle\LogConstants;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class SpidUserProviderTest
 */
class SpidUserProviderTest extends TestCase
{
    /**
     * @var SpidUserProvider
     */
    private $userProvider;

    public function testUserProviderLogsSpidUserCreation()
    {
        $this->markTestIncomplete('WIP');
        $mockLogger = $this->getMockBuilder(LoggerInterface::class)->disableOriginalConstructor()->getMock();
        $mockLogger->expects($this->exactly(1))
            ->method('info')
            ->with(LogConstants::SPID_USER_CREATED);

        $mockUser = $this->getMockBuilder(UserInterface::class)->disableOriginalConstructor()->getMock();

        $this->userProvider = new SpidUserProvider($mockLogger);

        $user = $this->userProvider->refreshUser($mockUser);
    }

}
