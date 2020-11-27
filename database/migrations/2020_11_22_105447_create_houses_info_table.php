<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousesInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses_info', function (Blueprint $table) {
            $table->id();
            $table->foreignId('house_id')->constrained('houses')->unique()->onDelete('cascade');
            $table->string('title', 100)->unique();
            $table->tinyInteger('rooms')->unsigned();
            $table->tinyInteger('beds')->unsigned();
            $table->tinyInteger('bathrooms')->unsigned();
            $table->smallInteger('mq')->unsigned();
            $table->text('description')->nullable();
            $table->string('address', 100);
            $table->string('region', 80);
            $table->mediumInteger('zipcode')->unsigned();
            $table->string('city', 60);
            $table->string('country', 60);
            $table->double('lat');
            $table->double('lon');
            $table->smallInteger('price')->unsigned();
            $table->string('cover_image');
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
        Schema::dropIfExists('houses_info');
    }
}