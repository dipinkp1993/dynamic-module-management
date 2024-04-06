<?php

// create_module_fields_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModuleFieldsTable extends Migration
{
    public function up()
    {
        Schema::create('module_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('module_id');
            $table->unsignedBigInteger('field_id');
            $table->string('label');
            $table->string('name');
            $table->boolean('is_in_form')->default(1);
            $table->integer('form_priority');
            $table->boolean('is_in_table')->default(1);
            $table->integer('table_priority');
            $table->timestamps();

            $table->foreign('module_id')->references('module_id')->on('modules')->onDelete('cascade');
            $table->foreign('field_id')->references('field_id')->on('fields')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('module_fields');
    }
}
