<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMutasiTanahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mutasi_tanahs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tanah_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('mutasi_id');
            $table->text('foto');
            $table->text('file');
            $table->string('no_surat');
            $table->date('tgl_surat');
            $table->string('keterangan');
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
        Schema::dropIfExists('mutasi_tanahs');
    }
}
