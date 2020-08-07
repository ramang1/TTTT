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
            //Khi user ở máy Client (Windows hoặc Linux )thực hiện nén (rar hoặc zip) file trước khi gửi mail.
            //Các thông tin về file và user thực hiện sẽ được ghi vào bảng này

            $table->id();
            $table->string('hash')->unique()->comment='has của file';
            
            $table->string('name')->comment = "Tên file send";
            $table->string('path')->comment = "Đường dẫn";
            $table->string('size', 10)->comment = "Kích thước";
            $table->smallInteger('type')->comment = "nén zip hay nén rar";
            //Ma cua nhom nhan mail
            $table->integer('channel_id')->unsigned()->comment = 'id của nhóm nhận mail';
            $table->unsignedBigInteger('user_id')->comment = 'id của user thực hiện';

            $table->timestamps();//->comment = 'Thời gian created_at and updated_at';
            $table->softDeletes()->comment = 'xoá mềm, deleted_at';

            $table->foreign('channel_id')->references('id')->on('channels')
            ->onUpdate('CASCADE')
            ->onDelete('CASCADE')->comment = 'Khoá ngoại';

            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onUpdate('CASCADE')
            ->onDelete('CASCADE')->comment = 'Khoá ngoại';
            // $table->foreign('outbox_process_id')
            // ->references('id')->on('outbox_process')
            // ->onUpdate('CASCADE')
            // ->onDelete('CASCADE');


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
