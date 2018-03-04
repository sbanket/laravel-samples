<?php

namespace Axmit\Notification\Mapper;

use App\Mapper\MappingFactoryInterface;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use Axmit\Notification\Dto\NotificationEntityTo;
use Axmit\Notification\Entity\Notification;

/**
 * Class NotificationMapperFactory
 *
 * @package Axmit\Notification\Mapper
 */
class NotificationMapperFactory implements MappingFactoryInterface
{
    /**
     * @param AutoMapperConfig $config
     */
    public function registerMapping(AutoMapperConfig $config)
    {
        $config->registerMapping(Notification::class, NotificationEntityTo::class)
            ->forMember('originalModel', function (Notification $source) {
                return $source;
            });
    }
}
