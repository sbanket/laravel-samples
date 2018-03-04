# Laravel code samples
These repository contains some code samples to build simple application using Laravel framework

## Samples include:

**Common features reusable in any application:**

- Support for modulear architecture - simple module manager (`App\Module\ModuleManager`)
- Abstraction lawyer for Eloquent models attributes (`App\Dto\Attributes\AbstractAttributesObject`)
- Abstraction lawyer for Laravel query builder (`App\Eloquent\AbstractDataRequest`)
- Resource map - mapping domain objects to API resources with supporting of extraction strategies (`App\Http\Resource\ResourcesMap`) 
- Integration of `mark-gerarts/auto-mapper-plus` library for converting Eloquent models to DTOs (`App\Mapper`)
- Permission management using Laratrust library (`App\Service\RoutePermissionCheck`)
- Feature toggling module (`Axmit\FeatureToggle`)
- Working with images (`Axmit\Image`)

**Several examples of implemented functionality:**

- Module for scheduling notifications (`Axmit\Notificaton`)
- Simple Achievement module demonstrating some features listed above (`Project\Company`)



