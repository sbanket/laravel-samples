<?php

namespace Project\Achievement\Exception;

use Exception;

/**
 * Class AchievementNotFoundException
 *
 * @package Project\Achievement\Exception
 */
class AchievementNotFoundException extends Exception
{
    const ERROR_BY_ID = 404;

    /**
     * @var int
     */
    protected $id;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param string     $id
     * @param \Throwable $previous
     *
     * @return static
     */
    public static function byId($id, \Throwable $previous = null)
    {
        $message = sprintf('Achievement [%s] does not exist', $id);

        $ex     = new static($message, static::ERROR_BY_ID, $previous);
        $ex->id = $id;

        return $ex;
    }
}
