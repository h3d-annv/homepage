<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscribtionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribtion', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('feature_vi');
            $table->string('feature_en');
            $table->string('unit_vi');
            $table->string('unit_en');
            $table->string('price_vi');
            $table->string('price_en');
            $table->text('description_vi')->nullable();
            $table->text('description_en')->nullable();
            $table->tinyInteger('is_active')->default(0);
            $table->tinyInteger('is_deleted')->default(0);
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
        Schema::dropIfExists('subscribtion');
    }
}
