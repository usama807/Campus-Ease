<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('found_item_photos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('found_item_id')->constrained('found_items')->onDelete('cascade');
            $table->string('photo_path');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('found_item_photos');
    }
};
