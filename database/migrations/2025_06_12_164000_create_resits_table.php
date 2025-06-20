<?php

use App\Models\KawasanLori;
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
        Schema::create('resits', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Pembeli::class);
            $table->date('tarikh');
            $table->integer('jumlah_balak');
            $table->foreignIdFor(KawasanLori::class)->nullable()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resits');
    }
};
