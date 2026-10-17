<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabel bikes — tema 6: Rental Sepeda
     * Kolom: id, brand, type, rent_price, gear_count, image, available
     */
    public function up(): void
    {
        Schema::create('bikes', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->string('type');
            $table->unsignedInteger('rent_price');      // tarif sewa per hari (Rupiah)
            $table->unsignedTinyInteger('gear_count');  // jumlah gigi / speed
            $table->string('image');                    // nama file di public/assets/images/
            $table->boolean('available')->default(true);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bikes');
    }
};
