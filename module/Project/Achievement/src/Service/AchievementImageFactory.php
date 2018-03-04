<?php

namespace Project\Achievement\Service;

use Axmit\Image\Dto\CropAttributesVo;
use Axmit\Image\Service\ImageFactory;
use Axmit\Image\Service\Thumbnail;
use Config;
use Intervention\Image\Constraint;
use Project\Achievement\Entity\Achievement;
use Project\Achievement\Module;

/**
 * Class AchievementImageFactory
 *
 * @package Project\Achievement\Service
 */
class AchievementImageFactory extends ImageFactory
{

    /**
     * @return string
     */
    protected function getPath(): string
    {
        return Config::get(sprintf('%s.%s', Module::ALIAS, 'storage.icon-path'));
    }

    /**
     * @param Achievement $entity
     * @param Thumbnail   $image
     *
     * @return mixed|string
     */
    public function updateIcon(Achievement $entity, Thumbnail $image)
    {
        $image->resize(
            256, 256,
            function (Constraint $constraint) {
                $constraint->upsize();
            }
        );

        $old = $entity->icon;

        $entity->icon = $image->save();
        $entity->save();

        if ($old) {
            $this->filesystem->delete($old);
        }

        return $entity->icon;
    }

    public function crop(CropAttributesVo $attributes): Thumbnail
    {
        $image = $this->makeThumbnail($attributes->getImage());
        $image->crop(
            $attributes->getWidth(),
            $attributes->getHeight(),
            $attributes->getX(),
            $attributes->getY()
        );

        return $image;
    }
}
