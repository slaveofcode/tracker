<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionItem extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_item', function (Blueprint $table) {
            
            $table->increments('id');
            $table->unsignedInteger('tracker_id');
            $table->mediumText('description');
            $table->enum('status', ['PAUSED', 'RUNNING', 'DONE']);
            $table->timestamps();

            $table->index('tracker_id');
            $table->index('status');
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
        Schema::dropIfExists('action_item');
    }
}
