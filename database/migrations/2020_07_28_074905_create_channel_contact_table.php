<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelContactTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channel_contact', function (Blueprint $table) {
            Schema::dropIfExists('channel_contact');
            $table->increments('id');
            $table->integer('channel_id')->unsigned();
            $table->integer('contact_id')->unsigned();
           
            $table->foreign('channel_id')
            ->references('id')->on('channels')
            ->onUpdate('CASCADE')
            ->onDelete('CASCADE');

            $table->foreign('contact_id')
            ->references('id')->on('contacts')
            ->onUpdate('CASCADE')
            ->onDelete('CASCADE');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('channel_contact');
    }
}
