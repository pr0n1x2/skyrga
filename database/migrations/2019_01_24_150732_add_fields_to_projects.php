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
            $table->boolean('is_use_email_as_username')->default(0)->after('is_generate_phone');
            $table->boolean('is_use_domainword_as_username')->default(0)->after('is_use_email_as_username');
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
            $table->dropColumn('is_use_email_as_username');
            $table->dropColumn('is_use_domainword_as_username');
        });
    }
}
