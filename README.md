DualLoginWPFOS
==============
Con este plugin , cuando hagas login en el form de fosuserbundle automaticamente estaras logeado en el blog de wordpress, 
siempre que tanto usuarios de fos como usuarios de wp tengan las mismas credenciales user/pass

# Installation


## Step 1: Installation

```
php composer.phar require --no-update rc/duallogin-wp-fos-bundle 
php composer.phar update rc/duallogin-wp-fos-bundle 
```


## Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...

        new RC\DualLoginWPFOSBundle\RCDualLoginWPFOSBundle(),
    );
}
```


# Configuration

The default configuration for the bundle looks like this:

``` yaml
#app/config/security.yml
security:
    ...
    firewalls:
        secured_area:
        ...
            duallogin: true
        ...
    
