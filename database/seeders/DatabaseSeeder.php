<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use FmTod\Quotes\Models\Quote;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $admistratorRole = Role::factory()->create([
            'role_name' => 'admin'
        ]);

        $customerRole = Role::factory()->create([
            'role_name' => 'customer'
        ]);

        $administratorUser = User::factory()->create(['email' => 'administrator@admin.com']);
        $customerUser = User::factory()->create(['email' => 'customer@customer.com']);
        
        $administratorUser->roles()->attach($admistratorRole);
        $customerUser->roles()->attach($customerRole);

        // $favoritesQuotes = Quote::factory(10)->create();

        // foreach($favoritesQuotes as $favorite) {
        //     $customerUser->quotes()->attach($favorite);
        // }

        // $NotFavoritesQuotes = Quote::factory(20)->create();
    }
}
