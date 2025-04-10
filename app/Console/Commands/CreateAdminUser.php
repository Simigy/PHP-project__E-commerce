<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create';
    protected $description = 'Create or update the admin user';

    public function handle()
    {
        $user = User::where('email', 'admin@admin.com')->first();

        if (!$user) {
            $user = new User();
            $user->email = 'admin@admin.com';
            $this->info('Creating new admin user...');
        } else {
            $this->info('Updating existing admin user...');
        }

        $user->name = 'Admin';
        $user->password = Hash::make('admin123');
        $user->role = 'admin';
        $user->save();

        $this->info('Admin user has been created/updated successfully!');
        $this->info('Email: admin@admin.com');
        $this->info('Password: admin123');
    }
}