<?php

namespace App\Http\Resource\Extractor\Strategy;

/**
 * Class CallbackStrategy
 *
 * @package App\Http\Resource\Extractor\Strategy
 */
class CallbackStrategy implements StrategyInterface
{

    /**
     * @var callable
     */
    protected $callback;

    /**
     * CallbackStrategy constructor.
     *
     * @param callable $callback
     */
    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    /**
     * @param mixed  $value
     * @param object $context OPTIONAL
     *
     * @return mixed
     */
    public function extract($value, $context = null)
    {
        return call_user_func_array($this->callback, [$value, $context]);
    }
}
