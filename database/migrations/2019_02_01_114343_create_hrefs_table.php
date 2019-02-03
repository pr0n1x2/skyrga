<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHrefsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrefs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('domain_id');
            $table->integer('site_id');
            $table->string('url');
            $table->string('page_title')->nullable();
            $table->string('link_url')->nullable();
            $table->string('link_anchor')->nullable();
            $table->smallInteger('external_links_count');
            $table->integer('hrefs_status_id')->nullable();
            $table->integer('hrefs_type_id')->nullable();
            $table->boolean('is_analized')->default(0);
            $table->date('analized_date')->nullable();
            $table->integer('user_id')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->index('domain_id');
            $table->index('site_id');
            $table->index('hrefs_status_id');
            $table->index('hrefs_type_id');
            $table->index('is_analized');
            $table->index('analized_date');
            $table->index('user_id');
            $table->unique(['domain_id', 'site_id', 'url']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hrefs');
    }
}
