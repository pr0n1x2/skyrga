<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('profile_id');
            $table->integer('project_id');
            $table->integer('account_id')->nullable();
            $table->date('register_date');
            $table->date('post_date');
            $table->boolean('is_register')->default(0);
            $table->boolean('is_login')->default(0);
            $table->boolean('is_post')->default(0);
            $table->timestamps();

            $table->index('profile_id');
            $table->index('project_id');
            $table->index('account_id');
            $table->index('register_date');
            $table->index('post_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('targets');
    }
}
