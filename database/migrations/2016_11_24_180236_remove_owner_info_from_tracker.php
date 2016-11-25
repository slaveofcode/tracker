<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveOwnerInfoFromTracker extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tracker', function (Blueprint $table) {
            $table->dropColumn(['owner_email', 'owner_nickname', 'owner_name', 'owner_avatar']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tracker', function (Blueprint $table) {
            $table->string('owner_email')->nullable();
            $table->string('owner_nickname')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('owner_avatar')->nullable();

            $table->index('owner_email');
            $table->index('owner_name');
            $table->index('owner_avatar');
        });
    }
}
