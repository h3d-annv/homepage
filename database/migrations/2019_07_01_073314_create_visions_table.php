<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title_vi',255);
            $table->string('title_en',255);
            $table->text('content_vi');
            $table->text('content_en');
            $table->tinyInteger('is_active')->default(0);
            $table->tinyInteger('is_deleted')->default(0);
            $table->string('created_by',50);
            $table->string('updated_by',255);
            $table->text('icon');
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
        Schema::dropIfExists('visions');
    }
}
