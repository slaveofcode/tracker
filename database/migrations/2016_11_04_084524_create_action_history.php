<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_history', function (Blueprint $table) {
            
            $table->increments('id');
            $table->unsignedInteger('action_item_id');
            $table->dateTime('start_time');
            $table->dateTime('finish_time');
            $table->mediumText('comment_on_start');
            $table->mediumText('comment_on_finish');
            $table->enum('status', ['STARTED', 'FINISHED']);

            $table->index('action_item_id');
            $table->index('start_time');
            $table->index('finish_time');
            $table->index('status');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_history');
    }
}
