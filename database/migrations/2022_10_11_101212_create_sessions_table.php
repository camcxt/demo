<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            // $table->id();
            // $table->integer('product_id');
            // $table->string('product_name');
            // $table->string('image');
            // $table->float('price', 10, 2);
            // $table->float('old_price', 10, 2);

            $table->string('id')->unique();
            $table->unsignedInteger('user_id')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->text('payload');
            $table->integer('last_activity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
};


// $table->foreignId('user_id')->nullable()->index();
// $table->string('ip_address', 45)->nullable();
// $table->text('user_agent')->nullable();
// $table->longText('payload');
// $table->integer('last_activity')->index();
// $table->integer('product_id')->index();
