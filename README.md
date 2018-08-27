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
      "url": "git@github.com:italia/spid-symfony-bundle.git"
    },
    {
      "type": "vcs",
      "url": "git@github.com:italia/spid-php-lib.git"
    }
  ]
...  
```
## Step 2:
Installare il repository tramite composer usando il branch master finché non sarà fatto un rilascio ufficiale


```
composer require italia/spid-simfony-bundle 
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
