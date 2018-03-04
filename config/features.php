<?php

return [
    'features'    => [
        \App\Features\FeatureRegistry::F_REVIEW => env('FEATURE_REVIEW_ENABLED', false),
    ],
    'silent_mode' => !env('APP_DEBUG', true),
];
