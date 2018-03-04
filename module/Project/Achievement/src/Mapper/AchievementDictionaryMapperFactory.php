<?php

namespace Project\Achievement\Mapper;

use App\Mapper\MappingFactoryInterface;
use AutoMapperPlus\Configuration\AutoMapperConfig;
use AutoMapperPlus\MappingOperation\Operation;
use Project\Achievement\Dto\AchievementEntityTo;
use Project\Achievement\Entity\Achievement;

/**
 * Class AchievementDictionaryMapperFactory
 *
 * @package Project\Achievement\Mapper
 */
class AchievementDictionaryMapperFactory implements MappingFactoryInterface
{

    public function registerMapping(AutoMapperConfig $config)
    {
        $config
            ->registerMapping(Achievement::class, AchievementEntityTo::class)
            ->forMember(
                'originalModel', function (Achievement $model) {
                return $model;
            })
            ->forMember('enabled', Operation::fromProperty('is_enabled'))
            ->forMember(
                'employeesTotal', function (Achievement $model) {
                return $model->employees_count;
            });
    }
}
