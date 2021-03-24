<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechnologicalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technologicals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('des');
            $table->string('image');
            $table->integer('field_id');
            $table->timestamps();
        });

        \App\Models\Technological::create([
            'name' => 'cs' ,
            'des' => 'cs' ,
            'image' => 'not found' ,
            'field_id' => 1
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('technologicals');
    }
}
