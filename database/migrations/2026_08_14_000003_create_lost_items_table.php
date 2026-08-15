<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lost_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('item_name');
            $table->foreignId('category_id')->constrained('categories')->onDelete('restrict');
            $table->string('color')->nullable();
            $table->string('brand_model')->nullable();
            $table->date('date_lost');
            $table->time('time_lost')->nullable();
            $table->string('location');
            $table->text('description')->nullable();
            $table->string('photo')->nullable();
            $table->enum('status', ['pending', 'matched', 'claimed', 'closed'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lost_items');
    }
};
