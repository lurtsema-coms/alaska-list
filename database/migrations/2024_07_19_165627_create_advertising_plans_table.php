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
        Schema::create('advertising_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('duration_days')->nullable();
            $table->decimal('cost', 8, 2)->nullable();
            $table->text('price_id')->nullable();
            $table->unsignedInteger('created_by')->length(10)->nullable();
            $table->unsignedInteger('updated_by')->length(10)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertising_plans');
    }
};
