# spid-php-symfony

> ⚠️ **WORK IN PROGRESS** ⚠️

Questo bundle permette di integrare facilmente la libreria `italia/spid-php-lib` in un progetto Symfony.

Vengono messe a disposizione delle rotte e dei servizi che possono essere facilmente sovrascritti

Una necessità tipica che non viene implementata da questo bundle è la necessità di salvare i dati dell'utente che arrivano tramite SPID. 

# Installazione
## Step 1: Installazione e configurazione
Installare il repository tramite composer

```bash
composer require italia/spid-simfony-bundle
```

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
Configurare il security.yml per usare l'authenticator e lo user provider

```yaml
security:
  providers:
    spid_user_provider:
      id: id_del_servizio
  firewalls
    spid:
      pattern: /il/vostro/pattern/
      guard:
        provider: spid_user_provider
        authenticators:
          - spid.authenticator
```
Il guardAuthenticator proposto è molto basilare, va esteso secondo le necessità del progetto                  

Includere il routing se si vogliono usare le rotte di default
```yaml
spid_security:
  resource: '@SpidSymfonyBundle/Resources/config/routing/saml_routes.yml'
```
Prestare attenzione alla rotta `acs` che deve ovviamente coincidere con la rotta esposta


Aggiungere la configurazione del bundle:
```yaml
spid_symfony:
  sp_entityid: 'http://some.site.it'
  sp_key_file: '%kernel.root_dir%/../example/sp.key'
  sp_cert_file: '%kernel.root_dir%/../example/sp.crt'
  sp_singlelogoutservice: 
    - [ 'http://some.site.it/slo', '' ]
  sp_org_name: 'dev-system'
  sp_attributeconsumingservice:
    - ["name", "familyName", "fiscalNumber", "email"]
    - ["name", "familyName", "fiscalNumber", "email", "spidCode"]
  sp_assertionconsumerservice:
    - 'http://some.site.it/acs'
  sp_org_display_name: 'Sistema di Sviluppo'
  idp_metadata_folder: '%kernel.root_dir%/../example/idp_metadata'
```

## Step 2: (opzionale) salvataggio dell'utente 
Se necessario è possibile salvare l'utente recuperato tramite SPID. Il punto più logico dove farlo è dentro l'Authenticator fornito, facendo override del metodo `getUser` e sfruttando i dati contenuti in `$credentials` per istanziare un nuovo utente da persistere


## Overrides:
Il template di login può essere sovrascritto mettendo il proprio in `app/Resources/SpidSymfonyBundle/views/security/chooseidp.html.twig`
Per la documentazione relativa al pulsante SPID standard fare riferimento a https://github.com/italia/spid-smart-button
Ce n'è una versione disponibile nel bundle per comodità di test in fase di sviluppo, la versione fornita va sostituita con quella valida al momento della messa in produzione.

Il pulsante fornito con questo bundle non è garantito come valido o funzionante

## IDP
Per configurare l'IDP di test fare riferimento a https://github.com/italia/spid-testenv2  