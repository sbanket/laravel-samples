<?php

namespace Axmit\Notification\Service;

use Axmit\Notification\Dto\Attributes\NotificationAttributesVo;
use Axmit\Notification\Dto\NotificationEntityTo;
use Axmit\Notification\Dto\Transformer\NotificationEntityToTransformer;
use Axmit\Notification\Entity\Notification;

/**
 * Class ScheduleService
 *
 * @package Axmit\Notification\Service
 */
class ScheduleService
{
    /**
     * @var NotificationEntityToTransformer
     */
    protected $transformer;

    /**
     * ScheduleService constructor.
     *
     * @param NotificationEntityToTransformer $transformer
     */
    public function __construct(NotificationEntityToTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * @param NotificationAttributesVo $attributes
     * @param mixed|object             $related
     *
     * @return NotificationEntityTo
     */
    public function schedule(NotificationAttributesVo $attributes, $related): NotificationEntityTo
    {
        $notification = (new Notification())->fill($attributes->toArray());

        $notification->related()->associate($related);
        $notification->save();

        return $this->transformer->fromEntity($notification);
    }

    /**
     * @param NotificationEntityTo $notification
     */
    public function cancelScheduled(NotificationEntityTo $notification)
    {
        $notification->getOriginal()->delete();
    }
}
