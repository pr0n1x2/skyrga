<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFilenamesFromProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('login_filename');
            $table->dropColumn('singin_filename');
            $table->dropColumn('post_filename');
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
            $table->string('login_filename', 120)->nullable()->after('login_page');
            $table->string('singin_filename', 120)->nullable()->after('login_file');
            $table->string('post_filename', 120)->nullable()->after('singin_file');
        });
    }
}
