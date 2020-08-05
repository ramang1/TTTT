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
            $table->string('hash')->unique();
            $table->string('name')->comment = "Tên file send";
            $table->string('path')->comment = "Đường dẫn";
            $table->string('size', 10)->comment = "Kích thước";
            $table->smallInteger('type')->comment = "Gửi IP hay PSTN";
            //Ma cua nhom nhan mail
            $table->integer('channel_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('channel_id')->references('id')->on('channels');
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
