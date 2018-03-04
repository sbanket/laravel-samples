<?php

namespace Project\Achievement\Service;

use AutoMapperPlus\AutoMapperInterface;
use AutoMapperPlus\Exception\UnregisteredMappingException;
use Axmit\Image\Dto\CropAttributesVo;
use Project\Achievement\Dto\AchievementEntityTo;
use Project\Achievement\Dto\Attributes\AchievementsAttributesVo;
use Project\Achievement\Entity\Achievement;
use Project\Company\Dto\CompanyEntityTo;

/**
 * Class AchievementDictionaryService
 *
 * @package Project\Achievement\Service
 */
class AchievementDictionaryService
{
    /**
     * @var AutoMapperInterface
     */
    protected $mapper;

    /**
     * @var AchievementImageFactory
     */
    protected $imageFactory;

    /**
     * AchievementDictionaryService constructor.
     *
     * @param AutoMapperInterface     $mapper
     * @param AchievementImageFactory $imageFactory
     */
    public function __construct(AutoMapperInterface $mapper, AchievementImageFactory $imageFactory)
    {
        $this->mapper       = $mapper;
        $this->imageFactory = $imageFactory;
    }

    /**
     * @param AchievementsAttributesVo $attributes
     *
     * @param CompanyEntityTo          $company
     *
     * @return AchievementEntityTo
     * @throws UnregisteredMappingException
     */
    public function create(AchievementsAttributesVo $attributes, CompanyEntityTo $company)
    {
        $model             = (new Achievement())->fill($attributes->toArray());
        $model->is_enabled = true;
        $model->company()->associate($company->getOriginal());
        $model->save();

        return $this->mapper->mapToObject($model, new AchievementEntityTo());
    }

    /**
     * @param AchievementEntityTo      $achievement
     * @param AchievementsAttributesVo $attributes
     *
     * @return mixed
     * @throws UnregisteredMappingException
     */
    public function update(AchievementEntityTo $achievement, AchievementsAttributesVo $attributes)
    {
        $model = $achievement->getOriginal();
        $model->fill($attributes->toArray());
        $model->save();

        return $this->mapper->mapToObject($model, $achievement);
    }

    /**
     * @param AchievementEntityTo $achievement
     * @param CropAttributesVo    $attributes
     *
     * @return AchievementEntityTo
     * @throws UnregisteredMappingException
     */
    public function updateImage(AchievementEntityTo $achievement, CropAttributesVo $attributes)
    {
        $image = $this->imageFactory->crop($attributes);

        $this->imageFactory->updateIcon($achievement->getOriginal(), $image);

        return $this->mapper->mapToObject($achievement->getOriginal(), $achievement);
    }

    /**
     * @param AchievementEntityTo $achievement
     *
     * @return AchievementEntityTo
     * @throws UnregisteredMappingException
     */
    public function enable(AchievementEntityTo $achievement)
    {
        /** @var Achievement $model */
        $model             = $achievement->getOriginal();
        $model->is_enabled = true;
        $model->save();

        return $this->mapper->mapToObject($model, $achievement);
    }

    /**
     * @param AchievementEntityTo $achievement
     *
     * @return AchievementEntityTo
     * @throws UnregisteredMappingException
     */
    public function disable(AchievementEntityTo $achievement)
    {
        /** @var Achievement $model */
        $model             = $achievement->getOriginal();
        $model->is_enabled = false;
        $model->save();

        return $this->mapper->mapToObject($model, $achievement);
    }
}
