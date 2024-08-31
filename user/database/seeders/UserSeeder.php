<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example user data with visible passwords
        $users = [
            [
                'prefixname' => 'Mr',
                'firstname' => 'John',
                'middlename' => 'Doe',
                'lastname' => 'Smith',
                'suffixname' => '',
                'username' => 'johnsmith',
                'email' => 'john@example.com',
                'password' => 'password123', 
                'photo' => null,
            ],
            [
                'prefixname' => 'Ms',
                'firstname' => 'Jane',
                'middlename' => 'Anne',
                'lastname' => 'Doe',
                'suffixname' => '',
                'username' => 'janedoe',
                'email' => 'jane@example.com',
                'password' => 'secret456',
                'photo' => null,
            ],
        ];

        // Loop through each user and create them in the database
        foreach ($users as $user) {
            User::create([
                'prefixname' => $user['prefixname'],
                'firstname' => $user['firstname'],
                'middlename' => $user['middlename'],
                'lastname' => $user['lastname'],
                'suffixname' => $user['suffixname'],
                'username' => $user['username'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']), // Hashing the password for security
                'photo' => $user['photo'],
            ]);

            // You can log the plain text password if needed, but generally it's not advisable for security reasons
            $this->command->info("User {$user['username']} with password '{$user['password']}' created.");
        }
    }
}
