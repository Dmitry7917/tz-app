<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\User;
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
         User::factory(10)
             ->create()
             ->each(function (User $user) {
                 $user->contacts()->saveMany(
                     Contact::factory(20)->create()
                 );
             });
    }
}
