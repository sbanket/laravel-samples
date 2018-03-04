<?php

namespace Axmit\Image;

use App\Module\AbstractModule;
use App\Module\Feature;

/**
 * Class Module
 *
 * @package Axmit\Image
 */
class Module extends AbstractModule implements Feature\ConfigProviderInterface
{

    const ALIAS = 'axmit.image';

    /**
     * @return string
     */
    public function getConfigPath()
    {
        return __DIR__ . '/../config/module.config.php';
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        static::ALIAS;
    }
}
