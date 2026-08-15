<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('found_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('logged_by')->constrained('users')->onDelete('cascade');
            $table->string('item_name');
            $table->foreignId('category_id')->constrained('categories')->onDelete('restrict');
            $table->string('color')->nullable();
            $table->string('brand_model')->nullable();
            $table->date('date_found');
            $table->time('time_found')->nullable();
            $table->string('location_found');
            $table->string('storage_location');
            $table->text('description')->nullable();
            $table->enum('status', ['in_storage', 'claimed', 'donated', 'disposed'])->default('in_storage');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('found_items');
    }
};
