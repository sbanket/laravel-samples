<?php

namespace App\Twig\Extension\Filter;

use Carbon\Carbon;
use TwigBridge\Extension\Loader\Loader;

use Illuminate\Contracts\Config\Repository as Config;

/**
 * Class DateFormat
 *
 * @package App\Twig\Extension\Filter
 */
class DateFormat extends Loader
{
    /**
     * @var Config
     */
    protected $config;

    /**
     * @return array
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('date_format', [$this, 'format']),
            new \Twig_SimpleFilter('date_format_local', [$this, 'formatLocalized']),
        ];
    }

    /**
     * @param \DateTime $date
     * @param string    $mode
     *
     * @return string
     */
    public function format(\DateTime $date, $mode = 'date')
    {
        $modes = $this->config->get('date.format.render');
        $this->guardForMode($mode, $modes);

        return $date->format($modes[$mode]);
    }

    /**
     * @param \DateTime $date
     * @param string    $mode
     *
     * @return string
     */
    public function formatLocalized(\DateTime $date, $mode = 'date')
    {
        if (!$date instanceof Carbon) {
            return $this->format($date, $mode);
        }
        $modes = $this->config->get('date.format.localized');
        $this->guardForMode($mode, $modes);

        return $date->formatLocalized($modes[$mode]);
    }

    /**
     * @param string $mode
     * @param array  $modes
     */
    protected function guardForMode(string $mode, array $modes)
    {
        if (!array_key_exists($mode, $modes)) {
            throw new \InvalidArgumentException(
                sprintf('Mode %s is not supported, use one of [%s]', $mode, implode(', ', array_keys($modes)))
            );
        }
    }
}
