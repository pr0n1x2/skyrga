<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 70);
            $table->string('domain', 70);
            $table->string('register_page');
            $table->string('login_page');
            $table->string('login_filename', 120)->nullable();
            $table->string('login_file', 40)->nullable();
            $table->string('post_filename', 120)->nullable();
            $table->string('post_file', 40)->nullable();
            $table->boolean('is_generate_address')->default(0);
            $table->boolean('is_easy_password')->default(0);
            $table->boolean('is_generate_phone')->default(0);
            $table->boolean('is_use_main_anchor')->default(0);
            $table->string('paragraph_frame')->nullable();
            $table->string('link_frame')->nullable();
            $table->string('image_frame')->nullable();
            $table->string('video_frame')->nullable();
            $table->tinyInteger('paragraph_link')->nullable();
            $table->text('state_associations')->nullable();
            $table->boolean('is_archive')->default(0);
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
        Schema::dropIfExists('projects');
    }
}
