## Installation

1. Run `composer require odiseoteam/sylius-easy-post-plugin --no-scripts`

2. Enable the plugin in bundles.php

```php
<?php
// config/bundles.php

return [
    // ...
    Odiseo\SyliusEasyPostPlugin\OdiseoSyliusEasyPostPlugin::class => ['all' => true],
];
```

3. Import the plugin configurations

```yml
# config/packages/_sylius.yaml
imports:
    # ...
    - { resource: "@OdiseoSyliusEasyPostPlugin/Resources/config/config.yaml" }
```

4. Add the admin routes

```yml
# config/routes.yaml
odiseo_sylius_easy_post_plugin_admin:
    resource: "@OdiseoSyliusEasyPostPlugin/Resources/config/routing/admin.yaml"
    prefix: /admin
```

5. Include traits and override the resources

```php
<?php
// src/Entity/Shipping/Shipment.php

// ...
use Doctrine\ORM\Mapping as ORM;
use Odiseo\SyliusEasyPostPlugin\Entity\ShipmentAwareInterface;
use Odiseo\SyliusEasyPostPlugin\Entity\ShipmentTrait;
use Sylius\Component\Core\Model\Shipment as BaseShipment;

/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_shipment")
 */
class Shipment extends BaseShipment implements ShipmentAwareInterface
{
    use ShipmentTrait;

    // ...
}
```

6. Add the environment variables

```yml
ODISEO_EASY_POST_APIKEY=EDITME
```

7. Finish the installation updating the database schema and installing assets

```
php bin/console doctrine:migrations:migrate
php bin/console sylius:theme:assets:install
php bin/console cache:clear
```
