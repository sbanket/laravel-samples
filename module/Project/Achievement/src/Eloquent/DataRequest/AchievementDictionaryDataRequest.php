<?php

namespace Project\Achievement\Eloquent\DataRequest;

use App\Eloquent\AbstractDataRequest;
use Project\Company\Entity\Company;

/**
 * Class AchievementDictionaryDataRequest
 *
 * @package Project\Achievement\Eloquent\DataRequest
 */
class AchievementDictionaryDataRequest extends AbstractDataRequest
{
    /**
     * @return AchievementDictionaryDataRequest
     */
    public function enabledOnly(): AchievementDictionaryDataRequest
    {
        $this->qb->where('is_enabled', true);

        return $this;
    }

    /**
     * @param string $order
     *
     * @return AchievementDictionaryDataRequest
     */
    public function orderByCreated($order = 'ASC'): AchievementDictionaryDataRequest
    {
        $this->qb->orderBy('created_at', $this->normalizeOrderDirection($order));

        return $this;
    }

    /**
     * @param string $order
     *
     * @return AchievementDictionaryDataRequest
     */
    public function orderByLabel($order = 'ASC'): AchievementDictionaryDataRequest
    {
        $this->qb->orderBy('label', $this->normalizeOrderDirection($order));

        return $this;
    }

}
