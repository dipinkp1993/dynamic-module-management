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
        Schema::create('customers', function (Blueprint $table) {
            $table->id('module_value_id');
            $table->unsignedBigInteger('module_field_id');
            $table->unsignedBigInteger('from_module_id')->nullable();
            $table->string('module_field_value');
            $table->string('value_code');
            $table->timestamps();

            $table->foreign('module_field_id')->references('id')->on('module_fields')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
