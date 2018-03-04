<?php

use Project\Achievement\Http\Controller\AchievementDictionaryController;

Route::middleware('auth')->prefix('/company/settings-api')->group(
    function () {
        Route::apiResource('achievements', AchievementDictionaryController::class);
        Route::post(
            'achievements/enable/{id}',
            'Project\Achievement\Http\Controller\AchievementDictionaryController@enable'
        )->name('achievements.enable');
        Route::post(
            'achievements/icon/{id}',
            'Project\Achievement\Http\Controller\AchievementDictionaryController@updateIcon'
        )->name('achievements.icon.update');
    }
);
