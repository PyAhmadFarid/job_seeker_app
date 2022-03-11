<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\job;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use function PHPSTORM_META\map;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $user = User::create([
            'name' => 'jon',
            'email' => 'jon@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('qwe'),
            'remember_token' => Str::random(10),
            'role' => 0
        ]);

        User::create([
            'name' => 'dave',
            'email' => 'dave@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('qwe'),
            'remember_token' => Str::random(10),
            'role' => 1
        ]);

        for ($i = 0; $i < 100; $i++) {
            job::create([
                'title' => 'job'.$i+1,
                'desc' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                        Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, 
                        when an unknown printer took a galley of type and scrambled it to make a type
                        specimen book. It has survived not only five centuries, 
                        but also the leap into ',
                'salary' => 300000,
                'end_date' => now(),
                'status' => true,
                'create_by' => $user->id,
            ]);
        }
    }
}
