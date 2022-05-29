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
        Schema::create('army_cards', function (Blueprint $table) {
            $table->id();
            $table->string('pension_no');
            $table->foreignId('veteran_status_id')->constrained();
            $table->foreignId('agency_id')->constrained();
            $table->foreignId('army_type_id')->constrained();
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
        Schema::dropIfExists('army_cards');
    }
};
