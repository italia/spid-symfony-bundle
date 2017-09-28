<?php

namespace Italia\SpidSymfonyBundle\Entity;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

/**
 * Class SpidUserProvider
 */
class SpidUserProvider implements UserProviderInterface
{
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * SpidUserProvider constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function loadUserByUsername($username)
    {
        // TODO: Implement loadUserByUsername() method.
    }

    public function refreshUser(UserInterface $user)
    {
        // TODO: Implement refreshUser() method.
    }

    public function supportsClass($class)
    {
        // TODO: Implement supportsClass() method.
    }
}
