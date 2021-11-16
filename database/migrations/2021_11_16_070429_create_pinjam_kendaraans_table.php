<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinjamKendaraansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pinjam_kendaraans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kendaraan_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('pinjam_id');
            $table->text('foto');
            $table->text('file');
            $table->string('no_surat');
            $table->date('tgl_surat');
            $table->date('tgl_pinjam');
            $table->date('tgl_kembali')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('pinjam_kendaraans');
    }
}
