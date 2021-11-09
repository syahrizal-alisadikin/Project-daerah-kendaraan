<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGedungTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gedung', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang');
            $table->integer('register');
            $table->string('nama_gedung');
            $table->string('no_sertifikat');
            $table->string('jenis_aset');
            $table->string('no_pbb');
            $table->date('tahun_perolehan');
            $table->string('luas');
            $table->string('kondisi');
            $table->string('bahan');
            $table->string('bertingkat');
            $table->string('asal_usul');
            $table->string('status_tanah');
            $table->integer('harga');
            $table->string('alamat');
            $table->text('keterangan');
            $table->text('foto');
            $table->text('file');
            $table->double('lat')->nullable();
            $table->double('lon')->nullable();
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
        Schema::dropIfExists('gedung');
    }
}
