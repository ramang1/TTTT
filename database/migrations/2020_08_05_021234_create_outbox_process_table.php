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
            
            //Sau khi nén rar hoặc zip xong, người dùng thực hiện truyền mail
            //Các thông tin của việc truyền sẽ được lưu trong bảng này
            $table->id();
            $table->enum('action', ['nen_zip','gui_mai','nen_rar'])->comment = 'nén file hay truyền file';
            $table->unsignedBigInteger('outbox_id')->comment = 'id của outbox, Hash của file';//->unique()->comment = 'id của outbox, Hash của file';
            //Ma nguoi gui
            $table->unsignedBigInteger('user_id')->comment = 'mã người gửi, nén';
            $table->string('note')->nullable()->comment = 'Dự phòng';
            $table->string('description')->nullable()->comment = 'Dự phòng';
            $table->timestamps();//->comment = 'Thời gian created_at and updated_at';
            $table->softDeletes()->comment = 'xoá mềm, deleted_at';
            
            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onUpdate('CASCADE')
            ->onDelete('CASCADE')->comment = 'Khoá ngoại';
            

            $table->foreign('outbox_id')
            ->references('id')->on('outboxes')
            ->onUpdate('CASCADE')
            ->onDelete('CASCADE')->comment = 'Khoá ngoại';
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
