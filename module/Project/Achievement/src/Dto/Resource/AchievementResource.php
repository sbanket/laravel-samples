<?php

namespace Project\Achievement\Dto\Resource;

use App\Http\Resource\AbstractExtractableResource;
use App\Http\Resource\Extractor\DefaultResourceExtractor;
use App\Http\Resource\Extractor\ExtractorInterface;
use App\Http\Resource\Extractor\Strategy\CallbackStrategy;

/**
 * Class AchievementResource
 *
 * @package Project\Achievement\Dto\Resource
 */
class AchievementResource extends AbstractExtractableResource
{

    /**
     * @var array
     */
    protected $serializable = [
        'id',
        'label',
        'icon',
        'enabled',
        'employeesTotal',
        'createdAt',
    ];

    /**
     * @param ExtractorInterface $extractor
     * @param object             $resource
     *
     * @return array
     */
    protected function extract(ExtractorInterface $extractor, $resource): array
    {
        if ($extractor instanceof DefaultResourceExtractor) {
            $extractor->properties($this->serializable);
            $extractor->withDates(['createdAt']);
            $extractor->addStrategy(
                'icon',
                new CallbackStrategy(
                    function ($value, $context) {
                        return empty($value) ? null : \Storage::url($value);
                    }
                )
            );
        }

        $extractor->extract($resource);

        return $extractor->toArray();
    }
}
