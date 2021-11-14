<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTanahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tanahs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('kode_barang');
            $table->integer('register');
            $table->char('tahun_perolehan');
            $table->integer('harga');
            $table->string('luas');
            $table->string('alamat');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('no_sertifikat');
            $table->string('no_pbb');
            $table->string('kondisi');
            $table->date('tgl_surat');
            $table->string('asal_usul');
            $table->string('status');
            $table->string('user_id');
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
        Schema::dropIfExists('tanahs');
    }
}
