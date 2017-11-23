<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('seoable.seo_data_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('seoable');
            $table->json('meta');
            $table->json('open_graph')->nullable();
            $table->json('twitter')->nullable();
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
        Schema::dropIfExists(config('seoable.seo_data_table'));
    }
}
