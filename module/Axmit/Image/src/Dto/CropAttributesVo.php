<?php

namespace Axmit\Image\Dto;

use App\Dto\Attributes\AbstractAttributesObject;
use Illuminate\Http\UploadedFile;

/**
 * Class CropAttributesVo
 *
 * @package Axmit\Image\Dto
 */
class CropAttributesVo extends AbstractAttributesObject
{
    /**
     * @return array
     */
    public static function attributes(): array
    {
        return [
            'image',
            'x',
            'y',
            'width',
            'height',
        ];
    }

    /**
     * @return UploadedFile|null
     */
    public function getImage(): ?UploadedFile
    {
        return $this->get('image');
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return (int)$this->get('x', 0);
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return (int)$this->get('y', 0);
    }

    /**
     * @return int|null
     */
    public function getWidth(): ?int
    {
        return $this->get('width');
    }

    /**
     * @return int|null
     */
    public function getHeight(): ?int
    {
        return $this->get('height');
    }

}
