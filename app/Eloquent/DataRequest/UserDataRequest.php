<?php

namespace App\Eloquent\DataRequest;

use App\Eloquent\AbstractDataRequest;

/**
 * Class UserDataRequest
 *
 * @package App\Eloquent\DataRequest
 */
class UserDataRequest extends AbstractDataRequest
{

    /**
     * @param string $username
     *
     * @return $this
     */
    public function withUsername(string $username)
    {
        $this->qb->where('username', $username);

        return $this;
    }

    /**
     * @param string $username
     *
     * @return $this
     */
    public function withUsernameLike(string $username)
    {
        $this->qb->where('username', 'LIKE', $username . '%');

        return $this;
    }

    /**
     * @param array $emails
     *
     * @return $this
     */
    public function withEmails(array $emails)
    {
        $this->qb->whereIn('email', $emails);

        return $this;
    }
}
