<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Hash;

use App\Models\User;

#[Signature('app:generate-user {email} {password} {role}')]
#[Description('Command description')]
class GenerateUser extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');
        $role = $this->argument('role');

        if(User::where('email', $email)->exists()) {

            $user = User::where('email', $email)->first();
            $user->password = Hash::make($password);
            $user->role = $role;
            $user->save();

            $this->error('User edited successfully');
            return;
        }

        $user = User::create([
            'name' => $email,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => $role,
        ]);

        $this->info('User created successfully.');
    }
}
