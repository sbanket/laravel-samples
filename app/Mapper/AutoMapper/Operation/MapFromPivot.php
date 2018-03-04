<?php

namespace App\Mapper\AutoMapper\Operation;

use AutoMapperPlus\MappingOperation\DefaultMappingOperation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Class MapFromPivot
 *
 * @package App\Mapper\AutoMapper\Operation
 */
class MapFromPivot extends DefaultMappingOperation
{
    /**
     * @param string $propertyName
     * @param object $source
     *
     * @return bool
     */
    public function canMapProperty(string $propertyName, $source): bool
    {
        if (!$source instanceof Model) {
            return false;
        }
        $propertyName = $this->formatPropertyName($propertyName);

        return isset($source->pivot->{$propertyName});
    }

    /**
     * @param object $source
     * @param string $propertyName
     *
     * @return mixed
     */
    protected function getSourceValue($source, string $propertyName)
    {
        $propertyName = $this->formatPropertyName($propertyName);
        return $source->pivot->{$propertyName};
    }

    /**
     * @param string $propertyName
     *
     * @return string
     */
    protected function formatPropertyName(string $propertyName): string
    {
        return Str::snake($propertyName);
    }
}
