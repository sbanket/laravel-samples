<?php

use Carbon\Carbon;

return [
    'format' => [
        'db'     => [
            'date'     => 'Y-m-d',
            'datetime' => Carbon::DEFAULT_TO_STRING_FORMAT,
        ],
        'render' => [
            'time'           => 'H:i',
            'date'           => 'd.m.Y',
            'datetime'       => 'd.m.Y, H:i',
            'full'           => 'd.m.Y, H:i:s',
            'month_day'      => 'd M',
            'full_month_day' => 'd F',
        ],
        'localized' => [
            'time'           => '%H:%M',
            'date'           => '%d %B %Y',
            'datetime'       => '%H:%M %d %B %Y',
            'full_month_day' => '%e %b',
        ],
    ],
];
