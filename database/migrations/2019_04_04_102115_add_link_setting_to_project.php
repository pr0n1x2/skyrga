<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLinkSettingToProject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->boolean('is_use_link_from_article')->default(0)->after('is_use_videos');
            $table->boolean('is_use_general_anchors')->default(0)->after('is_use_link_from_article');
            $table->boolean('is_use_main_anchors')->default(0)->after('is_use_general_anchors');
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
            $table->dropColumn('is_use_link_from_article');
            $table->dropColumn('is_use_general_anchors');
            $table->dropColumn('is_use_main_anchors');
        });
    }
}
