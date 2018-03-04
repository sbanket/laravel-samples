<?php

namespace App\Service;

/**
 * Class PasswordGenerator
 *
 * @package App\Service
 */
class PasswordGenerator
{
    /**
     * @param int $length
     *
     * @return string
     */
    public function generate(int $length): string
    {
        return bin2hex(random_bytes($length));
    }
}
