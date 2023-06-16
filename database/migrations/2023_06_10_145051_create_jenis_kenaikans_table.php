<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateJenisKenaikansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_kenaikans', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_kenaikan');
            $table->timestamps();
        });
        DB::table('jenis_kenaikans')->insert(array('jenis_kenaikan'=>'UKP Reguler'));
        DB::table('jenis_kenaikans')->insert(array('jenis_kenaikan'=>'UKP Penghargaan'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jenis_kenaikans');
    }
}
