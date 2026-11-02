<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    protected $signature = 'bems:create-admin';

    protected $description = 'Create the first Bravado super administrator account';

    public function handle(): int
    {
        if (User::whereHas('roles', fn ($query) => $query->where('name', 'super-administrator'))->exists()) {
            $this->error('A super administrator already exists. Ask an existing administrator to grant access.');

            return self::FAILURE;
        }

        $name = trim((string) $this->ask('Administrator name'));
        $email = strtolower(trim((string) $this->ask('Work email')));
        $password = (string) $this->secret('Password (minimum 12 characters)');

        if ($name === '' || ! filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 12) {
            $this->error('Enter a name, a valid email, and a password of at least 12 characters.');

            return self::FAILURE;
        }

        if (User::where('email', $email)->exists()) {
            $this->error('That email already belongs to an account.');

            return self::FAILURE;
        }

        $user = User::create(['name' => $name, 'email' => $email, 'password' => Hash::make($password)]);
        $role = Role::where('name', 'super-administrator')->firstOrFail();
        $user->roles()->attach($role, ['assigned_by' => $user->id]);

        $this->info('Administrator account created. Sign in with the supplied email and password.');

        return self::SUCCESS;
    }
}
