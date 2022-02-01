<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJailUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jail_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jail_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('jail_id')
            ->references('id')
            ->on('jails')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->boolean('state')->default(true);
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
        Schema::dropIfExists('jail_user');
    }
}
