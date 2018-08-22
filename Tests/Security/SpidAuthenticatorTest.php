<?php

namespace Italia\SpidSymfonyBundle\Tests\Security;

use Italia\SpidSymfonyBundle\Security\SpidAuthenticator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

/**
 * Class SpidAuthenticatorTest
 */
class SpidAuthenticatorTest extends TestCase
{

    /**
     * @test
     */
    public function testSpidAuthenticatorExtendsAbstractGuardAuthenticator()
    {
        $authenticator = new SpidAuthenticator();
        $this->assertTrue($authenticator instanceof AbstractGuardAuthenticator);
    }

    /**
     * @test
     */
    public function testIGetAnExceptionIfUserProviderIsNotASpidUserProvider()
    {
        $this->expectException(\InvalidArgumentException::class);

        $authenticator = new SpidAuthenticator();
        $wrongProvider = $mockLogger = $this->getMockBuilder(UserProviderInterface::class)->getMock();
        $authenticator->getUser([], $wrongProvider);
    }

    /**
     * @test
     */
    public function testOnAuthenticationFailureReturnsResponse()
    {
        $authenticator = new SpidAuthenticator();
        $response = $authenticator->onAuthenticationFailure(new Request(), new AuthenticationException('some'));
        $this->assertTrue($response instanceof Response);
        $this->assertEquals(Response::HTTP_FORBIDDEN, $response->getStatusCode());
    }
}
