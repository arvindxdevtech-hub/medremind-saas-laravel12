<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DemoUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(

            [
                'email' => 'arvinddevtech@medremind.com'
            ],

            [
                'name' => 'Arvind Dev Tech',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
            ]
        );
    }
}
