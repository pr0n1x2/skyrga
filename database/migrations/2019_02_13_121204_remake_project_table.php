<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemakeProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->integer('domain_id')->unique()->after('id');
            $table->integer('href_id')->unique()->after('domain_id');
            $table->text('login_instructions')->nullable()->after('login_page');
            $table->string('login_youtube', 15)->nullable()->after('login_instructions');
            $table->boolean('is_login_by_himself')->default(0)->after('login_youtube');
            $table->boolean('is_no_need_login')->default(0)->after('is_login_by_himself');
            $table->text('sing_in_instructions')->nullable()->after('is_no_need_login');
            $table->string('sing_in_youtube', 15)->nullable()->after('sing_in_instructions');
            $table->boolean('is_sing_in_by_himself')->default(0)->after('sing_in_youtube');
            $table->boolean('is_no_need_sing_in')->default(0)->after('is_sing_in_by_himself');
            $table->text('post_instructions')->nullable()->after('is_no_need_sing_in');
            $table->string('post_youtube', 15)->nullable()->after('post_instructions');
            $table->boolean('is_post_by_himself')->default(0)->after('post_youtube');
            $table->boolean('is_no_need_post')->default(0)->after('is_post_by_himself');
            $table->boolean('is_use_single_account')->default(0)->after('is_no_need_post');
            $table->integer('account_id')->nullable()->after('is_use_single_account');
            $table->string('materials')->nullable()->after('state_associations');
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
            $table->dropColumn('domain_id');
            $table->dropColumn('href_id');
            $table->dropColumn('login_instructions');
            $table->dropColumn('login_youtube');
            $table->dropColumn('is_login_by_himself');
            $table->dropColumn('is_no_need_login');
            $table->dropColumn('sing_in_instructions');
            $table->dropColumn('sing_in_youtube');
            $table->dropColumn('is_sing_in_by_himself');
            $table->dropColumn('is_no_need_sing_in');
            $table->dropColumn('post_instructions');
            $table->dropColumn('post_youtube');
            $table->dropColumn('is_post_by_himself');
            $table->dropColumn('is_no_need_post');
            $table->dropColumn('is_use_single_account');
            $table->dropColumn('account_id');
            $table->dropColumn('materials');
        });
    }
}
