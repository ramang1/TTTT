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

        //10 tuyen, 30 contact

        $user = factory(App\User::class, 5)->create();
        $contact = factory(App\Models\Contact::class, 50)->create();
        $channel = factory(App\Models\Channel::class, 10)->create();
        $channelcontact = factory(App\Models\ChannelContact::class, 30)->create();

        $inboxes = factory(App\Models\Inbox::class, 10)->create();
        $outboxes = factory(App\Models\Outbox::class, 10)->create();
        
    }
}
