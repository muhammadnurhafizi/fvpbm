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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('stock_level')->default(0);
            $table->integer('store')->default(0);
            $table->integer('available_counter')->default(0);
            $table->integer('reserved_counter')->default(0);
            $table->integer('available_courier')->default(0);
            $table->integer('reserved_courier')->default(0);
            $table->foreignId('item_id')->constrained();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
};
