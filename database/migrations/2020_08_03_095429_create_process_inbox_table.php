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
            //Khi người dùng thao tác với file nhận về
            //Các thông tin thao tác sẽ được lưu vào bảng này
            $table->id();
            $table->enum('action_type', ['giai_nen_zip','nhan_mai','giai_nen_rar'])->comment = 'Giải nén zip, rar hay nhận mail';
            $table->unsignedBigInteger('inboxes_id')->comment = 'id của inbox, hash của file';
            $table->unsignedBigInteger('user_id')->comment = 'id của người thực hiện';
            $table->string('note')->nullable()->comment = "Dự phòng";
            $table->string('description')->nullable()->comment = "Dự phòng";
            $table->timestamps();//->comment = 'Thời gian created_at và updated_at';
            $table->softDeletes()->comment = 'xoá mềm, delete_at';

            $table->foreign('inboxes_id')
            ->references('id')->on('inboxes')
            ->onUpdate('CASCADE')
            ->onDelete('CASCADE')->comment = 'khoá ngoại';

            $table->foreign('user_id')
            ->references('id')->on('users')
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
        Schema::drop('process_inbox');
    }
}
