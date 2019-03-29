<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id');
            $table->integer('profile_id');
            $table->enum('type', ['varchar', 'text']);
            $table->enum('name', [
                'field1',
                'field2',
                'field3',
                'field4',
                'field5',
                'field6',
                'field7',
                'field8',
                'field9',
                'field10',
            ]);
            $table->text('value')->nullable();

            $table->index('project_id');
            $table->index(['project_id', 'profile_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_fields');
    }
}
