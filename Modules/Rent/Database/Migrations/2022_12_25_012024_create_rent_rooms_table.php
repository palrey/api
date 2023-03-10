<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Rent\Entities\Rent;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_rooms', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->unsignedDecimal('price')->default(0);
            $table->string('image')->nullable();
            $table->json('features')->nullable();
            $table->unsignedTinyInteger('capacity')->default(0);
            $table->boolean('open')->default(true);
            $table->foreignIdFor(Rent::class)->constrained('rent_rents');
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
        Schema::dropIfExists('rent_rooms');
    }
};
