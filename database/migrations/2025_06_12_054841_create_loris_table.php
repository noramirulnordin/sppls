<?php

use App\Models\Pembeli;
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
        Schema::create('loris', function (Blueprint $table) {
            $table->id();
            $table->string('no_pendaftaran')->unique()->comment('No Pendaftaran Lori');
            $table->string('jenis')->comment('Jenis Lori')->nullable();
            $table->string('kapasiti')->comment('Kapasiti Lori')->nullable();
            $table->foreignIdFor(Pembeli::class)->nullable()->onDelete('set null')->comment('Pembeli yang memiliki lori ini');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loris');
    }
};
