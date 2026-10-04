<?php

use App\Features\FileLinkFeature;
use App\Models\EquipmentWorkbook;
use App\Models\User;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;

/*
|-------------------------------------------------------------------------------
| User Notification Channel
|-------------------------------------------------------------------------------
*/

Broadcast::channel('App.Models.User.{id}', function (User $user, int $id) {
    Log::debug(
        'User '.$user->username.' connecting to Notification Broadcast Channel'
    );

    return (int) $user->user_id === (int) $id;
});
