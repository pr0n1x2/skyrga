<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFiedlsFromAccount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->dropColumn('profile_id');
            $table->dropColumn('project_id');
            $table->dropColumn('status');
            $table->dropColumn('link_page');
            $table->dropColumn('complete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('accounts', function (Blueprint $table) {
            $table->integer('profile_id')->after('id');
            $table->integer('project_id')->after('profile_id');
            $table->tinyInteger('status')->default(0)->after('domain_word');
            $table->string('link_page', 40)->nullable()->after('status');
            $table->date('complete')->nullable()->after('link_page');

            $table->index('profile_id');
            $table->index('project_id');
            $table->index('complete');
        });
    }
}
