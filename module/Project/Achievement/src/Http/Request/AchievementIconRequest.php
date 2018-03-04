<?php

namespace Project\Achievement\Http\Request;

use Axmit\Image\Http\Request\CropImageRequest;

/**
 * Class AchievementIconRequest
 *
 * @package Project\Achievement\Http\Request
 */
class AchievementIconRequest extends CropImageRequest
{
    protected function imageValidationRules(): array
    {
        return [
            'max:2048',
        ];
    }

}
