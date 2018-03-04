<?php

namespace Project\Achievement\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Project\Achievement\Dto\Attributes\AchievementsAttributesVo;

/**
 * Class AchievementEnableRequest
 *
 * @package Project\Achievement\Http\Request
 */
class AchievementEnableRequest extends FormRequest
{
    public function rules()
    {
        return [
            'enabled' => 'required',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function getAttributes(): AchievementsAttributesVo
    {
        return AchievementsAttributesVo::fromArray($this->all('enabled'));
    }
}
