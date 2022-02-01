<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jails', function (Blueprint $table) {
            $table->id();
            $table->string('name',45);
            $table->string('code',255);
            $table->enum('type',['low','medium','high']);
            $table->unsignedBigInteger('capacity');
            $table->boolean('state')->default(true);
            $table->unsignedBigInteger('ward_id');
            $table->foreign('ward_id')
            ->references('id')
            ->on('wards')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->string('description')->nullable();
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
        Schema::dropIfExists('jails');
    }
}
