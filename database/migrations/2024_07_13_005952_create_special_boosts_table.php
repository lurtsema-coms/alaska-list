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
        Schema::create('special_boosts', function (Blueprint $table) {
            $table->id();
            $table->date('from_date')->nullable();
            $table->date('to_date')->nullable();
            $table->string('image_name')->nullable();
            $table->string('file_path')->nullable();
            $table->text('link')->nullable();
            $table->smallInteger('created_by')->unsigned()->nullable();
            $table->smallInteger('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_boosts');
    }
};
