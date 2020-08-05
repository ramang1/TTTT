<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutboxesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outboxes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('outbox_process_id');//->commnent = "ID của bảng outbox_process";
            $table->string('name')->comment = "Tên file send";
            $table->string('path')->comment = "Đường dẫn";
            $table->string('size', 10)->comment = "Kích thước";
            $table->smallInteger('type')->comment = "Gửi IP hay PSTN";
            //Ma cua nhom nhan mail
            $table->integer('channel_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('channel_id')->references('id')->on('channels')
            ->onUpdate('CASCADE')
            ->onDelete('CASCADE');

            $table->foreign('outbox_process_id')
            ->references('id')->on('outbox_process')
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
        Schema::drop('outboxes');
    }
}
