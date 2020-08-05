<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChannelsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channels', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('code')->unique();
            $table->text('name')->comment = "Ten Group";
            // $table->integer('type');
            $table->enum('type', ['de_trung_binh','de_nhat','easy', 'hard', 'hardest'])->comment = "Kiểu tương thích của group";
            $table->text('note')->nullable();
            $table->timestamps();
            //$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('channels');
    }
}
