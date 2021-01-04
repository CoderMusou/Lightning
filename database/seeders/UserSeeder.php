<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Lucas Yang',
            'email' => 'yangchenshin77@gmail.com',
            'description' => '夜空中的小星星，也會閃耀著光芒~~',
        ]);

        User::factory()->count(9)->create();
    }
}
