<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInboxesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inboxes', function (Blueprint $table) {
            $table->id();
            $table->string('hash')->unique();
            $table->string('name')->comment ="Tên file đến";
            $table->string('path')->comment = "Thư mục lưu";
            $table->string('size', 10)->comment = "Kích thước file";
            $table->smallInteger('type')->commment = "Kiểu nhận về: mạng, pstn";
            $table->integer('contact_id')->unsigned()->comment = "Mã nơi gửi";
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('contact_id')->references('id')->on('contacts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('inboxes');
    }
}
