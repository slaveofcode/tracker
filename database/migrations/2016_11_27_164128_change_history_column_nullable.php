<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ChangeHistoryColumnNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE action_history MODIFY finish_time DATETIME NULL');
        DB::statement('ALTER TABLE action_history MODIFY comment_on_start mediumtext COLLATE utf8_unicode_ci NULL');
        DB::statement('ALTER TABLE action_history MODIFY comment_on_finish mediumtext COLLATE utf8_unicode_ci NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
