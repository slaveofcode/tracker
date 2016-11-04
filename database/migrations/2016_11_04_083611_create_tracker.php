<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTracker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tracker', function (Blueprint $table) {
            $table->increments('id');
            
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('owner_id');
            $table->string('owner_email')->nullable();
            $table->string('owner_nickname')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('owner_avatar')->nullable();
            $table->timestamps();

            $table->index('name');
            $table->index('owner_id');
            $table->index('owner_email');
            $table->index('owner_name');
            $table->index('owner_avatar');
            $table->index(['created_at', 'updated_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tracker');
    }
}
