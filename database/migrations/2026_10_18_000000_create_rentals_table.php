<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->string('rental_code')->unique();
            $table->unsignedBigInteger('bike_id')->index();
            $table->string('renter_name');
            $table->string('renter_phone', 20);
            $table->date('start_date');
            $table->unsignedSmallInteger('days');
            $table->unsignedInteger('total_price');
            $table->string('payment_method');
            $table->string('status')->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};