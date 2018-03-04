<?php

namespace Axmit\Notification\Dto\Attributes;

use App\Dto\Attributes\AbstractAttributesObject;
use DateTime;

/**
 * Class NotificationAttributesVo
 *
 * @package Axmit\Notification\Dto\Attributes
 *
 * @method NotificationAttributesVo withNotifyAt(string $notifyAt)
 * @method NotificationAttributesVo withChanel(string $chanel)
 * @method NotificationAttributesVo withContact(string $contact)
 * @method NotificationAttributesVo withSubject(string $subject)
 * @method NotificationAttributesVo withContent(string $content)
 */
class NotificationAttributesVo extends AbstractAttributesObject
{

    /**
     * Returns available attribute names
     *
     * @return array
     */
    public static function attributes(): array
    {
        return [
            'chanel',
            'content',
            'notify_at',
            'contact',
            'subject',
        ];
    }

    /**
     * @param \DateTime $date
     * @param string    $content
     * @param string    $email
     *
     * @return static
     */
    public static function email(\DateTime $date, $content, $email)
    {
        return static::fromArray(
            [
                'content'   => $content,
                'chanel'    => 'email',
                'notify_at' => $date,
                'contact'   => $email,
            ]
        );
    }

    /**
     * @param string $value
     *
     * @return DateTime
     */
    protected function filterNotifyAt($value)
    {
        return $value instanceof DateTime ? $value : new DateTime($value);
    }
}
