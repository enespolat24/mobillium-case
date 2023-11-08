<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class MobilliumCredentialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'email' => 'admin@mobillium.com',
            'password' => bcrypt('mobillium'),
            'name' => 'Mobillium Admin',
        ])->assignRole('admin');
    }
}
