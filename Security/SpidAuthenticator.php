<?php

namespace Italia\SpidSymfonyBundle\Security;
use Italia\SpidSymfonyBundle\Entity\SpidUserProvider;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

/**
 * Class SpidAuthenticator
 */
class SpidAuthenticator extends AbstractGuardAuthenticator
{

    /**
     * SpidAuthenticator constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param Request                      $request
     * @param AuthenticationException|null $authException
     * @return Response
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new Response('Authentication Required', 401);
    }

    /**
     * @param Request $request
     * @return array|null
     */
    public function getCredentials(Request $request)
    {
        $data = self::createUserDataFromRequest($request);
        if ($data["codiceFiscale"] === null) {
            return null;
        }

        return $data;
    }

    /**
     * @param mixed                 $credentials
     * @param UserProviderInterface $userProvider
     *
     * @return CPSUser
     * @throws \InvalidArgumentException
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        if ($userProvider instanceof SpidUserProvider) {
            return $userProvider->provideUser($credentials);
        }
        throw new \InvalidArgumentException(
            sprintf("UserProvider for SpidAuthenticator must be a %s instance", SpidUserProvider::class)
        );
    }

    /**
     * @param mixed         $credentials
     * @param UserInterface $user
     * @return bool
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    /**
     * @param Request                 $request
     * @param AuthenticationException $exception
     * @return Response
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $message = strtr($exception->getMessageKey(), $exception->getMessageData());

        return new Response($message, 403);
    }

    /**
     * @param Request        $request
     * @param TokenInterface $token
     * @param string         $providerKey
     * @return null
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return null;
    }

    /**
     * @inheritdoc
     * @return bool
     */
    public function supportsRememberMe()
    {
        return false;
    }
}
