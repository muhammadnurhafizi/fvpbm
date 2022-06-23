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
        Schema::create('item_packages', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity')->default(0);
            $table->foreignId('item_id')->constrained();
            $table->foreignId('external_uom_id')->constrained('uoms');
            $table->foreignId('internal_uom_id')->constrained('uoms');
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
        Schema::dropIfExists('item_packages');
    }
};
