<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRevisionToArticles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('file_revision', 40)->nullable()->after('file_result_name');
            $table->string('file_revision_name', 191)->nullable()->after('file_revision');
            $table->date('complete_date')->nullable()->after('revision_date');
            $table->date('revision_complete_date')->nullable()->after('complete_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn('file_revision');
            $table->dropColumn('file_revision_name');
            $table->dropColumn('complete_date');
            $table->dropColumn('revision_complete_date');
        });
    }
}
