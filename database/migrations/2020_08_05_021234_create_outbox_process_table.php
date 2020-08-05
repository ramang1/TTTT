<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutboxProcessTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outbox_process', function (Blueprint $table) {
            

            $table->id();
            $table->enum('action', ['nen_zip','gui_mai','nen_rar'])->comment = 'nén file hay truyền file';
            //id cua outbox
            //$table->bigInteger('outboxes_id')->unsigned()->comment = 'id hash của file';
            $table->string('hash')->unique()->comment = 'Hash của file';
            //Ma nguoi gui
            $table->unsignedBigInteger('user_id');
            $table->string('note')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

           

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
        Schema::drop('outbox_process');
    }
}
