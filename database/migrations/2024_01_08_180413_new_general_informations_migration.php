<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NewGeneralInformationsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('general_informations', function (Blueprint $table) {
            $table->string('background_image_en')->nullable();
            $table->string('background_image_ar')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('general_informations', function (Blueprint $table) {
            $table->dropColumn('background_image_en');
            $table->dropColumn('background_image_ar');
        });
    }
}
