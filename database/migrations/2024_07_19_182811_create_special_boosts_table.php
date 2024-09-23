<?php

use App\Models\AdvertisingPlan;
use App\Models\Product;
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
            $table->text('uuid');
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('advertising_plan_id')->constrained('advertising_plans');
            $table->datetime('from_date');
            $table->datetime('to_date');
            $table->text('file_name')->nullable();
            $table->text('file_path')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
