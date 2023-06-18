<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('constructions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('pref_id');
            $table->foreign('pref_id')->references('id')->on('prefectures');
            $table->string('place');
            $table->string('matter', 100);
            $table->date('long');
            $table->boolean('completed');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('constructions', function (Blueprint $table) {
          $table->dropForeign('constructions_user_id_foreign');
          $table->dropForeign('constructions_pref_id_foreign');
        });
        Schema::dropIfExists('constructions');
    }
};
