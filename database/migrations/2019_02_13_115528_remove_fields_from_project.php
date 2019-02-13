<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFieldsFromProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('domain');
            $table->dropColumn('login_file');
            $table->dropColumn('singin_file');
            $table->dropColumn('post_file');
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
            $table->string('name', 70)->after('id');
            $table->string('domain', 70)->after('name');
            $table->string('login_file', 40)->nullable()->after('login_page');
            $table->string('singin_file', 40)->nullable()->after('login_file');
            $table->string('post_file', 40)->nullable()->after('singin_file');
        });
    }
}
