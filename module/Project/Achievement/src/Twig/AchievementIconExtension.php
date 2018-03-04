<?php

namespace Project\Achievement\Twig;

use Project\Achievement\Dto\AchievementEntityTo;
use Project\Achievement\Service\IconService;
use Twig_SimpleFunction;

/**
 * Class AchievementIconExtension
 *
 * @package Project\Achievement\Twig
 */
class AchievementIconExtension extends \Twig_Extension
{
    /**
     * @var IconService
     */
    protected $iconService;

    /**
     * AchievementIconExtension constructor.
     *
     * @param IconService $iconService
     */
    public function __construct(IconService $iconService)
    {
        $this->iconService = $iconService;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return static::class;
    }

    /**
     * @return array|Twig_SimpleFunction[]
     */
    public function getFunctions()
    {
        return [
            new Twig_SimpleFunction('achievementIconUrl', [$this, 'getUrl']),
        ];
    }

    /**
     * @param AchievementEntityTo $achievement
     *
     * @return string
     */
    public function getUrl(AchievementEntityTo $achievement)
    {
        return $this->iconService->url($achievement);
    }
}
