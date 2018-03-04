<?php

use Project\Achievement\Dto\AchievementEntityTo;
use Project\Achievement\Dto\Resource\AchievementResource;

return [
    'map' => [
        AchievementEntityTo::class => AchievementResource::class,
    ],
];
