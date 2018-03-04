<?php

namespace Project\Achievement\Service;

use Project\Achievement\Dto\AchievementEntityTo;

/**
 * Class IconService
 *
 * @package Project\EmployeeAchievement\Service
 */
class IconService
{
    /**
     * @var string
     */
    protected $default = '/img/default-achievement.png';

    /**
     * IconService constructor.
     *
     * @param string $default
     */
    public function __construct(string $default = null)
    {
        if ($default) {
            $this->default = $default;
        }
    }

    /**
     * @param AchievementEntityTo $achievement
     *
     * @return string
     */
    public function url(AchievementEntityTo $achievement): string
    {
        return $achievement->getIcon()
            ? \Storage::url($achievement->getIcon())
            : sprintf('%s/%s', rtrim(\Config::get('app.url'), '/'), ltrim($this->default, '/'));

    }
}
