<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);

        \App\Models\User::factory(10)
            ->hasAttached(
                Role::factory()->count(1),
                ['created_at' => now(), 'updated_at' => now()]
            )
            ->create();
    }
}
