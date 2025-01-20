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
        Schema::create('analyzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('indicator_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('leveling_index_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('detail_leveling_index_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('recomendation_id')->nullable()->constrained()->cascadeOnDelete();
            $table->longText('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analyzes');
    }
};
