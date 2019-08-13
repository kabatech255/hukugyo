<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('job_id');
            $table->string('body');
            $table->integer('score');
            $table->timestamps();
            $table
            ->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
            $table
            ->foreign('job_id')
            ->references('id')
            ->on('jobs')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('comments', function (Blueprint $table) {
        $table->dropForeign('comments_user_id_foreign');
      });
      Schema::table('comments', function (Blueprint $table) {
        $table->dropForeign('comments_job_id_foreign');
      });
      Schema::dropIfExists('comments');
    }
}
