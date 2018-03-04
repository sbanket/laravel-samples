<?php

namespace Project\Achievement\Dto\Attributes;

use App\Dto\Attributes\AbstractAttributesObject;

/**
 * Class AchievementsAttributesVo
 *
 * @package Project\Achievement\Dto\Attributes
 */
class AchievementsAttributesVo extends AbstractAttributesObject
{

    /**
     * Returns available attribute names
     *
     * @return array
     */
    public static function attributes(): array
    {
        return [
            'label',
            'icon',
            'enabled',
        ];
    }

    public function isEnabled(): bool
    {
        return (bool)$this->get('enabled', true);
    }

    protected function filterEnabled($value): bool
    {
        return (bool)$value;
    }
}
