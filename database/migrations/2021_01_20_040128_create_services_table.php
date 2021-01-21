<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('services');
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->text('name')->comment = "Tên dịch vụ";            
            $table->text('status')->comment = "Trạng thái dịch vụ";            
            $table->text('note')->nullable()->comment = "Mô tả về dịch vụ";
            $table->text('path')->comment = "Đường dẫn thực thi";           
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
        Schema::dropIfExists('services');
    }
}
