<?php

namespace Axmit\Notification\Entity;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class Notification
 *
 * @property Carbon $notify_at
 * @property Carbon $sent_at
 */
class Notification extends Model
{
    /**
     * @var string
     */
    protected $table = 'notifications';

    /**
     * @var array
     */
    protected $fillable = [
        'chanel',
        'content',
        'notify_at',
        'notify_by',
        'contact',
        'subject',
    ];

    /**
     * @var array
     */
    protected $dates = [
        'notify_at',
        'sent_at',
    ];

    /**
     * Marks notification as sent
     *
     * @return $this
     */
    public function sent()
    {
        $this->setAttribute('sent_at', Carbon::now());

        return $this;
    }

    /**
     * @return bool
     */
    public function isSent()
    {
        return isset($this->sent_at);
    }

    /**
     * @return MorphTo
     */
    public function related()
    {
        return $this->morphTo();
    }
}
