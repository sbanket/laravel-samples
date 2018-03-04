<?php

namespace Project\Achievement\Http\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Project\Achievement\Dto\Attributes\AchievementsAttributesVo;
use Project\Employee\Service\CurrentEmployeeTrait;

/**
 * Class AchievementCrudRequest
 *
 * @package Project\Achievement\Http\Request
 */
class AchievementCrudRequest extends FormRequest
{
    use CurrentEmployeeTrait;

    public function rules(): array
    {
        return [
            'label' => [
                'required',
                Rule::unique('achievements', 'label')
                    ->where('company_id', $this->getCurrentCompany()->getId())
                    ->ignore('id'),
            ],
        ];
    }

    public function messages()
    {
        return [
            'label.unique' => 'Название должно быть уникальным',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    public function getAttributes(): AchievementsAttributesVo
    {
        return AchievementsAttributesVo::fromArray($this->all());
    }
}
