<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Rent\Entities\Booking;
use Modules\Rent\Entities\Room;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedDecimal('total_price')->default(0);
            $table->unsignedTinyInteger('status')->default(0);
            $table->date('date_since')->nullable();
            $table->date('date_to')->nullable();
            $table->json('messages')->nullable();
            $table->json('guests')->nullable();
            $table->foreignIdFor(User::class)->constrained();
            $table->timestamps();
        });

        Schema::create('rent_booking_rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Room::class)->constrained('rent_rooms');
            $table->foreignIdFor(Booking::class)->constrained('rent_bookings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent_bookings');
        Schema::dropIfExists('rent_booking_rooms');
    }
};
