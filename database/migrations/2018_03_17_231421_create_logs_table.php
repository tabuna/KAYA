<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            env('DB_LOG_TABLE', 'logs'),
            function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('instance')->index();
                $table->string('channel')->index();
                $table->string('level')->index();
                $table->string('level_name');
                $table->text('message');
                $table->jsonb('context');

                $table->integer('remote_address')->nullable()->unsigned();
                $table->string('user_agent')->nullable();
                $table->bigInteger('team_id')->nullable()->index();
                $table->dateTime('created_at');
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(env('DB_LOG_TABLE', 'logs'));
    }
}
