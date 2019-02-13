<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPendingToHtefs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hrefs', function (Blueprint $table) {
            $table->timestamp('pending_date')->nullable()->after('comment');
            $table->text('pending_comment')->nullable()->after('pending_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hrefs', function (Blueprint $table) {
            $table->dropColumn('pending_date');
            $table->dropColumn('pending_comment');
        });
    }
}
