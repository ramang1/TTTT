<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
          //  Schema::dropIfExists('contacts');
            $table->increments('id');
            $table->mediumText('code')->unique();
            $table->text('name')->unique();
            $table->mediumText('phone')->nullable();
            $table->mediumText('fax')->nullable();
            $table->mediumText('mobile')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
           // $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
}
