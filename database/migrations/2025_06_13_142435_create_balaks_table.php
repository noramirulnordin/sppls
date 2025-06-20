<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('balaks', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_pokok')->nullable();
            $table->double('panjang')->nullable();
            $table->double('diameter')->nullable();
            $table->string('status')->default('Tersedia');
            $table->string('gambar')->nullable();
            $table->text('keterangan')->nullable()->comment('Keterangan tambahan tentang balak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('balaks');
    }
};
