<?php

use App\Http\Resources\User;
use Illuminate\Support\Facades\Broadcast;
use App\Models\UserModel;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.a
|
*/
Broadcast::channel('App.Models.UserModel.{id}', function ($user, $id) {
   return true;
 });
 Broadcast::channel('user-registed', function ($user) {
    return true;
  });