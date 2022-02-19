<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealEstateEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_estate_entities', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128)->comment('Name');
            $table->enum('real_state_type', ['house', 'department', 'land', 'commercial_ground'])->comment('Real Estate Type');
            $table->string('street', 128)->comment('Street');
            $table->string('external_number', 12)->comment('External Number');
            $table->string('internal_number',12)->nullable()->comment('Internal Number');
            $table->string('neighborhood', 128)->comment('Neighborhood');
            $table->string('city', 64)->comment('City');
            $table->string('country', 4)->comment('Country');
            $table->integer('rooms')->comment('Rooms');
            $table->integer('bathrooms')->comment('Bathrooms');
            $table->string('comments', 128)->nullable()->comment('Comments');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('real_estate_entities');
    }
}
