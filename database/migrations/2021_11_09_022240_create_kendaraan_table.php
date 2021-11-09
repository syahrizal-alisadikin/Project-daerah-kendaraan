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
            $table->string('jenis_kendaraan');
            $table->string('no_polisi');
            $table->string('merk_type');
            $table->string('warna');
            $table->string('bpkb');
            $table->string('no_chasis');
            $table->string('no_mesin');
            $table->string('bahan_bakar');
            $table->string('asal_usul');
            $table->date('tahun_beli');
            $table->string('kapasitas_cc');
            $table->date('tgl_bayar_pajak');
            $table->string('keadaan');
            $table->string('type_roda');
            $table->integer('harga');
            $table->text('keterangan');
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
