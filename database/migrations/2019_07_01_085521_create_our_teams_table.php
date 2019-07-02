<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOurTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('our_teams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',50);
            $table->string('roll_vi');
            $table->string('roll_en');
            $table->tinyInteger('is_active')->default(0);
            $table->tinyInteger('is_deleted')->default(0);
            $table->string('created_by',50);
            $table->string('updated_by',255);
            $table->text('image');
            $table->integer('sort')->default(0);
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
        Schema::dropIfExists('our_teams');
    }
}
