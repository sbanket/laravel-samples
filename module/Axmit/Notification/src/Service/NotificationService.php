<?php

namespace Axmit\Notification\Service;

use Axmit\Notification\Dto\NotificationEntityTo;
use Axmit\Notification\Dto\Transformer\NotificationEntityToTransformer;
use Axmit\Notification\Entity\Notification;
use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * Class NotificationService
 *
 * @package Axmit\Notification\Service
 */
class NotificationService
{
    /**
     * @var NotificationEntityToTransformer
     */
    protected $transformer;

    /**
     * NotificationService constructor.
     *
     * @param NotificationEntityToTransformer $transformer
     */
    public function __construct(NotificationEntityToTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * @return Collection|NotificationEntityTo[]
     */
    public function getNotSent(int $limit)
    {
        /** @var Collection $collection */
        $collection = Notification::whereNull('sent_at')
            ->where('notify_at', '<=', Carbon::today())
            ->limit($limit)
            ->get();
        $collection->transform(function(Notification $notification) {
            return $this->transformer->fromEntity($notification);
        });
        return $collection;
    }

    /**
     * @param Notification $notification
     */
    public function markAsSent(Notification $notification)
    {
        $notification->sent();
        $notification->save();
    }

    /**
     * @param Notification $notification
     */
    public function markNotSent(Notification $notification)
    {
        $notification->sent_at = null;
        $notification->save();
    }
}
