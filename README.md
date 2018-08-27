# spid-php-symfony

# Installazione
## Step 1:

Aggiungere al proprio composer.json i repository necessari (fino alla pubblicazione su packagist)
```json
...
"repositories": [
    ...
    {
      "type": "vcs",
      "url": "https://github.com/italia/spid-symfony-bundle"
    },
    {
      "type": "vcs",
      "url": "https://github.com/italia/spid-php-lib"
    }
  ]
...  
```
## Step 2:
Installare il repository tramite composer usando il branch master finché non sarà fatto un rilascio ufficiale


```
composer require italia/spid-simfony-bundle:dev-master
```

## Step 3:
Abilitare il bundle aggiungendolo all' `AppKernel`

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Italia\SpidSymfonyBundle\SpidSymfonyBundle(),
        );

        // ...
    }

    // ...
}
```


# WIP

Il bundle offre due classi astratte
Nel security.yml mettere
security:
  providers:
  firewalls
    spid:
      pattern: /il/vostro/pattern/
      guard:
        provider: spid
        authenticators:
          - ocsdc.cps.token_authenticator
          
ai servizi aggiungere
  spid.token_authenticator:
    class: \Italia\SpidSymfonyBundle\Security\SpidAuthenticator
                  