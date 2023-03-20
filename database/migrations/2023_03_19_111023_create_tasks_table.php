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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->unsignedSmallInteger('priority');
            $table->text('description')->nullable();
            $table->unsignedSmallInteger('is_done')->default(0);

            $table->dateTime('deadline');
            $table->dateTime('closing_date')->nullable();
            
            $table->unsignedBigInteger('user_id');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
