<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Beverage;
use App\Models\Message;
use App\Models\Taq;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Taq::factory(3)->create();
        Beverage::factory(12)->create();
        Message::factory(6)->create();

        User::factory()->create([
            'name' => 'Test User',
            'userName' => 'testuser',
            'active' => true,
            'email' => 'test@example.com',
            'password' =>'123456789',
        ]);
    }
}
