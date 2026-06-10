<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

// Models
use App\Models\User;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('generate:user {username} {password} {role}', function (string $username, string $password, string $role) {

    $role_user = $role;

    $user = new User();
    $user->name = $username;
    $user->email = $username;
    $user->password = Hash::make($password);

    if($role != "admin") {
        $role_user = "user";
    }

    $user->role = $role_user;
    $user->save();

    $this->info("Success");
});
