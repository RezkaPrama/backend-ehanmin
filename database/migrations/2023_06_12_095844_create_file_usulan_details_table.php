<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileUsulanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_usulan_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('file_usulan_id')->unsigned();
            $table->bigInteger('trans_usulans_id')->unsigned();
            $table->string('nama');
            $table->string('nama_file');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_usulan_details');
    }
}
