<?php

// create_module_field_values_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleFieldValuesTable extends Migration
{
    public function up()
    {
        Schema::create('module_field_values', function (Blueprint $table) {
            $table->id('module_value_id');
            $table->unsignedBigInteger('module_field_id');
            $table->unsignedBigInteger('from_module_id')->nullable();
            $table->string('module_field_value');
            $table->string('value_code');
            $table->timestamps();

            $table->foreign('module_field_id')->references('id')->on('module_fields')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('module_field_values');
    }
}

