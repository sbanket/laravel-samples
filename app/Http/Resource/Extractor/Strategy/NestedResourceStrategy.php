<?php
namespace App\Http\Resource\Extractor\Strategy;

use App\Http\Resource\ResourcesMap;
use Illuminate\Http\Resources\Json\ResourceCollection;

/**
 * Class NestedRelationStrategy
 *
 * @package App\Http\Resource\Extractor\Strategy
 */
class NestedResourceStrategy implements StrategyInterface
{
    /**
     * @var ResourcesMap
     */
    protected $resourcesMap;

    /**
     * NestedRelationStrategy constructor.
     *
     * @param ResourcesMap $resourcesMap
     */
    public function __construct(ResourcesMap $resourcesMap)
    {
        $this->resourcesMap = $resourcesMap;
    }

    /**
     * @param mixed $value
     * @param null  $context
     *
     * @return ResourceCollection|Resource
     */
    public function extract($value, $context = null)
    {
        if (is_array($value) || $value instanceof \Traversable) {
            return $this->resourcesMap->collection($value);
        }
        return $this->resourcesMap->resource($value);
    }
}
