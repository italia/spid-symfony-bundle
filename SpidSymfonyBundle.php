<?php
namespace Italia\SpidSymfonyBundle;

use Italia\SpidSymfonyBundle\DependencyInjection\SpidSymfonyExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class SpidSymfonyBundle
 */
class SpidSymfonyBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new SpidSymfonyExtension();
    }
}
