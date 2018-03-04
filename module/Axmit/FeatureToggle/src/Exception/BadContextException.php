<?php

namespace Axmit\FeatureToggle\Exception;

use Axmit\FeatureToggle\Condition\Context;
use Exception;

/**
 * Class BadContextException
 *
 * @package Epos\FeatureToggle\Exception
 */
class BadContextException extends Exception
{

    /**
     * @var Context
     */
    protected $context;

    /**
     * @return Context
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param Context $context
     * @param string  $expected
     *
     * @return BadContextException
     */
    public static function wrongContext(Context $context, string $expected): BadContextException
    {
        $data       = $context->getDatum();
        $dataString = '';

        if (is_object($data)) {
            $dataString = get_class($data);
        } else {
            $dataString = gettype($data);

            if (is_scalar($data)) {
                $dataString .= sprintf('%s :: %s', $dataString, $data);
            }
        }

        $feature = $context->getFeature();
        $message = sprintf(
            'Got wrong context `%s`, instead of `%s` for feature `%s`',
            $dataString,
            $expected,
            $feature
        );

        $exception          = new static($message);
        $exception->context = $context;

        return $exception;
    }
}
