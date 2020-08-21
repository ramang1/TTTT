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
            //Khi có email mới đến.
            //Các thông tin về file đến sẽ được ghi vào bảng này, không có thông tin ngừòi nhận vì có thể mail được nhận tự động
            //unique: trường này là duy nhất, nullable: trường này có thể rỗng, không có giá trị, comment: ghi chú về trường
            $table->id();
            $table->string('hash')->unique()->comment='has của file';
            $table->string('name')->comment ="Tên file đến";
            $table->string('path')->comment = "Thư mục lưu";
            $table->bigInteger('size')->comment = "Kích thước file";
            $table->smallInteger('type')->commment = "Kiểu nhận về: mạng, pstn";
            $table->integer('contact_id')->unsigned()->comment = "Mã nơi gửi";
            $table->unsignedBigInteger('user_id')->comment = "id người nhận";
            
            $table->string('note')->nullable()->comment = "Dự phòng";
            $table->timestamps();//->comment = 'Thời gian created_at and updated_at';
            $table->softDeletes()->comment = 'xoá mềm, deleted_at';

            $table->foreign('contact_id')->references('id')->on('contacts')->comment = 'Khoá ngoại, luôn tham chiếu đến khoá chính của bảng cha';
            $table->foreign('user_id')->references('id')->on('users')->comment = 'Khoá ngoại, luôn tham chiếu đến khoá chính của bảng cha';

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
