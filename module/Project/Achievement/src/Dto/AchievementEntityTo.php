<?php

namespace Project\Achievement\Dto;

use App\Dto\StoresOriginalModel;
use Carbon\Carbon;

/**
 * Class AchievementEntityTo
 *
 * @package Project\Achievement\Dto
 */
class AchievementEntityTo
{
    use StoresOriginalModel;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var string
     */
    protected $icon;

    /**
     * @var bool
     */
    protected $enabled = true;

    /**
     * @var int
     */
    protected $employeesTotal = 0;

    /**
     * @var Carbon
     */
    protected $createdAt;

    /**
     * @return string
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     */
    public function setIcon(string $icon): void
    {
        $this->icon = $icon;
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @param bool $isEnabled
     */
    public function setIsEnabled(bool $isEnabled = true): void
    {
        $this->enabled = $isEnabled;
    }

    /**
     * @return int
     */
    public function getEmployeesTotal(): ? int
    {
        return $this->employeesTotal;
    }

    /**
     * @param int $employeesTotal
     */
    public function setEmployeesTotal($employeesTotal): void
    {
        $this->employeesTotal = (int)$employeesTotal;
    }

    /**
     * @return Carbon
     */
    public function getCreatedAt(): Carbon
    {
        return $this->createdAt ?: Carbon::now();
    }

    /**
     * @param Carbon $createdAt
     */
    public function setCreatedAt(Carbon $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

}
