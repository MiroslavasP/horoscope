<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZodiacCalendarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zodiac_calendars', function (Blueprint $table) {
            $table->id();
            $table->string('year', 10);
            $table->unsignedBigInteger('zodiacs_id');
            $table->foreign('zodiacs_id')->references('id')->on('zodiacs');
            $table->unsignedTinyInteger('month');
            $table->string('scores', 250);
            $table->decimal('average', 4, 2)->unsigned();
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
        Schema::dropIfExists('zodiac_calendars');
    }
}
