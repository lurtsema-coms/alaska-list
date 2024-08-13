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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable();
            $table->string('status');
            $table->text('name');
            $table->string('sub_category_id');
            $table->text('price')->nullable();
            $table->text('qty');
            $table->text('location');
            $table->text('description');
            $table->text('additional_information')->nullable();
            $table->text('file_name')->nullable();
            $table->text('file_path')->nullable();
            $table->unsignedBigInteger('created_by')->length(10)->nullable();
            $table->unsignedBigInteger('updated_by')->length(10)->nullable();
            $table->unsignedBigInteger('approved_by')->length(10)->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
