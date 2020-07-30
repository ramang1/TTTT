<?php

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
        // $this->call(UsersTableSeeder::class);
        $user = factory(App\User::class, 5)->create();
        $contact = factory(App\Contact::class, 10)->create();
        //$phones = factory(App\Phone::class, 20)->create();
    }
}
