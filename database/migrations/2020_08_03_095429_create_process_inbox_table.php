<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessInboxTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process_inbox', function (Blueprint $table) {
            $table->id();
            $table->enum('action', ['giai_nen_zip','nhan_mai','giai_nen_rar'])->comment = 'Giải nén hay nhận mail';
            $table->unsignedBigInteger('inboxes_id');
            $table->unsignedBigInteger('user_id');
            $table->string('note')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('inboxes_id')
            ->references('id')->on('inboxes')
            ->onUpdate('CASCADE')
            ->onDelete('CASCADE');

            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onUpdate('CASCADE')
            ->onDelete('CASCADE');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('process_inbox');
    }
}
