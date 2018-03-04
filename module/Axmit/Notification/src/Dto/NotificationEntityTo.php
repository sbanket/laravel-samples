<?php

namespace Axmit\Notification\Dto;

use App\Dto\StoresOriginalModel;
use DateTime;

/**
 * Class NotificationEntityTo
 *
 * @package Axmit\Notification\Dto
 */
class NotificationEntityTo
{
    use StoresOriginalModel;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var DateTime
     */
    protected $notifyAt;

    /**
     * @var string
     */
    protected $chanel;

    /**
     * @var string
     */
    protected $contact;

    /**
     * @var DateTime
     */
    protected $sentAt;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setContent(string $content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getNotifyAt(): DateTime
    {
        return $this->notifyAt;
    }

    /**
     * @param DateTime $notifyAt
     *
     * @return $this
     */
    public function setNotifyAt(DateTime $notifyAt)
    {
        $this->notifyAt = $notifyAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getChanel(): string
    {
        return $this->chanel;
    }

    /**
     * @param string $chanel
     *
     * @return $this
     */
    public function setChanel(string $chanel)
    {
        $this->chanel = $chanel;
        return $this;
    }

    /**
     * @return string
     */
    public function getContact(): string
    {
        return $this->contact;
    }

    /**
     * @param string $contact
     *
     * @return $this
     */
    public function setContact(string $contact)
    {
        $this->contact = $contact;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getSentAt(): ?DateTime
    {
        return $this->sentAt;
    }

    /**
     * @param DateTime $sentAt
     *
     * @return $this
     */
    public function setSentAt(DateTime $sentAt)
    {
        $this->sentAt = $sentAt;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * @param string $subject
     *
     * @return $this
     */
    public function setSubject(string $subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSent()
    {
        return $this->getSentAt() !== null;
    }
}
