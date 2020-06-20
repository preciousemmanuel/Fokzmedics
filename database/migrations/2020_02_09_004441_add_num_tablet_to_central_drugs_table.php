<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNumTabletToCentralDrugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('central_drugs', function (Blueprint $table) {
            $table->integer('num_tablet')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('central_drugs', function (Blueprint $table) {
            $table->dropColumn('num_tablet');
        });
    }
}
