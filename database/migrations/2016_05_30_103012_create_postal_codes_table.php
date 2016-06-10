<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostalCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postal_codes', function(Blueprint $table) {
            $table->increments('id');
            $table->string('state_code', 3)->references('code')->on('states');
            $table->string('code', 5);
            $table->string('name', 180);
            $table->string('suburb', 180);
            $table->decimal('latitude', 12, 4);
            $table->decimal('longitude', 12, 4);
            $table->tinyInteger('accuracy')->nullable();

            $table->index(['state_code', 'code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('postal_codes');
    }
}
