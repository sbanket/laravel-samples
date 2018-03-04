<?php

namespace Axmit\Notification\Dto\Transformer;

use AutoMapperPlus\AutoMapperInterface;
use Axmit\Notification\Dto\NotificationEntityTo;
use Axmit\Notification\Entity\Notification;

/**
 * Class NotificationEntityToTransformer
 *
 * @package Axmit\Notification\Dto\Transformer
 */
class NotificationEntityToTransformer
{
    /**
     * @var AutoMapperInterface
     */
    protected $mapper;

    /**
     * NotificationEntityToTransformer constructor.
     *
     * @param AutoMapperInterface $mapper
     */
    public function __construct(AutoMapperInterface $mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * @param Notification $entity
     *
     * @return NotificationEntityTo
     */
    public function fromEntity(Notification $entity): NotificationEntityTo
    {
        return $this->fromEntityWith($entity, new NotificationEntityTo());
    }

    /**
     * @param Notification         $entity
     * @param NotificationEntityTo $dto
     *
     * @return NotificationEntityTo
     */
    public function fromEntityWith(Notification $entity, NotificationEntityTo $dto): NotificationEntityTo
    {
        return $this->mapper->mapToObject($entity, $dto);
    }
}
