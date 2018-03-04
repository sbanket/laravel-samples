<?php

namespace App\Mapper;

use App\Dto\UserEntityTo;
use App\Entity\User;
use AutoMapperPlus\Configuration\AutoMapperConfig;

/**
 * Class UserMappingFactory
 *
 * @package App\Mapper
 */
class UserMappingFactory implements MappingFactoryInterface
{

    /**
     * @param AutoMapperConfig $config
     */
    public function registerMapping(AutoMapperConfig $config)
    {
        $config->registerMapping(User::class, UserEntityTo::class)
            ->forMember('originalModel', function(User $user) {
                return $user;
            });
    }
}
