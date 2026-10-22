<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('divisions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('bn_name', 50)->nullable();
            $table->string('status')->default('1');
            $table->string('url', 100)->nullable();
            $table->string('delivery_fee', 50)->default('0');
            $table->timestamps();
        });

        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('division_id');
            $table->string('name', 50);
            $table->string('bn_name', 50)->nullable();
            $table->string('lat', 50)->nullable();
            $table->string('lon', 50)->nullable();
            $table->string('url', 100)->nullable();
            $table->string('status')->default('1');
            $table->timestamps();
        });

        Schema::create('upazilas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('district_id');
            $table->string('name', 50);
            $table->string('bn_name', 50)->nullable();
            $table->string('url', 100)->nullable();
            $table->string('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upazilas');
        Schema::dropIfExists('districts');
        Schema::dropIfExists('divisions');
    }
};