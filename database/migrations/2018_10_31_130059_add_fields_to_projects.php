<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('singin_filename', 120)->nullable()->after('login_file');
            $table->string('singin_file', 40)->nullable()->after('singin_filename');
            $table->boolean('is_use_post')->default(0)->after('is_use_main_anchor');
            $table->boolean('is_use_images')->default(0)->after('is_use_post');
            $table->boolean('is_use_videos')->default(0)->after('is_use_images');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('singin_filename');
            $table->dropColumn('singin_file');
            $table->dropColumn('is_use_post');
            $table->dropColumn('is_use_images');
            $table->dropColumn('is_use_videos');
        });
    }
}
