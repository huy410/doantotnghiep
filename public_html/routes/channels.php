<?php

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('statusUser', function ($user) {
    if(Auth::check()) {
        return ['id' => $user->id, 'name' => $user->name];
    }
});

Broadcast::channel('NewCustomerEvent', function () {
    if(Auth::check()) {
        $checkRole = DB::table('model_has_roles')->join('users', 'users.id', '=', 'model_has_roles.model_id')
        ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->select('users.id', 'roles.name')->where('users.id',Auth::user()->id)->where('roles.name','super-admin')->first();
        if(!empty($checkRole)){
            return true;
        }
    }
});