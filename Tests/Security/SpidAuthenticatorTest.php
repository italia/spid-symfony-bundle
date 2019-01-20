<?php

namespace Italia\SpidSymfonyBundle\Tests\Security;

use Italia\SpidSymfonyBundle\Security\SpidAuthenticator;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
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

    private $mockRouter;

    public function setUp()
{
        $this->mockRouter = $this->getMockBuilder('\Symfony\Bundle\FrameworkBundle\Routing\Router')
        ->disableOriginalConstructor()
        ->getMock();
        $this->mockRouter->expects($this->any())->method('generate')->willReturn('/');


  echo 'setUp';
}

    /**
     * @test
     */
    public function testSpidAuthenticatorExtendsAbstractGuardAuthenticator()
    {
        $authenticator = new SpidAuthenticator($this->mockRouter);
        $this->assertTrue($authenticator instanceof AbstractGuardAuthenticator);
    }

    /**
     * @test
     */
    public function testOnAuthenticationFailureReturnsResponse()
    {
        $authenticator = new SpidAuthenticator($this->mockRouter);
        $response = $authenticator->onAuthenticationFailure(new Request(), new AuthenticationException('some'));
        $this->assertTrue($response instanceof Response);
        $this->assertEquals(Response::HTTP_FORBIDDEN, $response->getStatusCode());
    }
}
