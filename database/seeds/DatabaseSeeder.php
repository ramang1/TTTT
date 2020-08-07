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
        $user = factory(App\User::class, 5)->create();
        $contact = factory(App\Models\Contact::class, 10)->create();
        $inboxes = factory(App\Models\Inbox::class, 10)->create();
        $outboxes = factory(App\Models\Outbox::class, 10)->create();
        
    }
}
