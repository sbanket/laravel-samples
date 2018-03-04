<?php

namespace Axmit\Image\Http\Request;

use Axmit\Image\Dto\CropAttributesVo;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class CropImageRequest
 *
 * @package Axmit\Image\Http\Request
 */
class CropImageRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'image'  => array_unique(array_merge(['required', 'image'], $this->imageValidationRules())),
            'x'      => 'required',
            'y'      => 'required',
            'width'  => 'required',
            'height' => 'required',
        ];
    }

    /**
     * @return array
     */
    protected function imageValidationRules(): array
    {
        return [];
    }

    /**
     * @return CropAttributesVo
     */
    public function getAttributes()
    {
        return CropAttributesVo::fromArray($this->all());
    }
}
