<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKendaraanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kendaraan', function (Blueprint $table) {
            $table->id();
             $table->string('kode_barang');
            $table->string('register');
            $table->char('tahun_perolehan');
            $table->integer('harga');
            $table->string('merk');
            $table->string('type');
            $table->string('no_polisi');
            $table->string('no_rangka');
            $table->string('no_mesin');
            $table->string('no_bpkb');
            $table->date('masa_berlaku_stnk');
            $table->string('user_id');
            $table->string('type_roda');
            $table->text('keterangan');
            $table->string('status');
            $table->text('foto');
            $table->string('file');
            $table->softDeletes();
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
        Schema::dropIfExists('kendaraan');
    }
}
