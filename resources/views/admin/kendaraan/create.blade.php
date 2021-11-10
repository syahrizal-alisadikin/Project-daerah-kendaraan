@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Kendaraan</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-book"></i> Tambah Kendaraan</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Foto</label>
                                    <input type="file" name="foto" value="{{ old('foto') }}" 
                                        class="form-control @error('jenis_aset') is-invalid @enderror">
        
                                    @error('foto')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>File</label>
                                    <input type="file" name="file"
                                        class="form-control">
                                </div>
                            </div>
                         
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Kode Barang</label>
                                    <input type="text" name="kode_barang" value="{{ old('kode_barang') }}" placeholder="Masukkan Kode"
                                        class="form-control @error('kode_barang') is-invalid @enderror">
        
                                    @error('kode_barang')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Register</label>
                                    <input type="number" name="register" value="{{ old('register') }}" placeholder="Masukkan Register"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Jenis</label>
                                    <input type="text" name="jenis_kendaraan" value="{{ old('jenis_kendaraan') }}" placeholder="Masukkan Jenis"
                                        class="form-control @error('password') is-invalid @enderror">
        
                                    @error('jenis_kendaraan')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>No Polisi</label>
                                    <input type="number" name="no_polisi" value="{{ old('no_polisi') }}" placeholder="Masukkan No"
                                        class="form-control @error('no_sertifikat') is-invalid @enderror">
        
                                    @error('no_polisi')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                      

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Type</label>
                                    <input type="text" name="merk_type" value="{{ old('merk_type') }}" placeholder="Masukkan Type "
                                        class="form-control @error('merk_type') is-invalid @enderror">
        
                                    @error('merk_type')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Warna</label>
                                    <input type="number" name="warna" value="{{ old('warna') }}" placeholder="Masukkan Warna"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>BPKB</label>
                                    <input type="number" name="bpkp" value="{{ old('bpkb') }}" 
                                        class="form-control" placeholder="Masukan BPKB">
                                </div>
                            </div>
                             <div class="col-md-3">
                                <div class="form-group">
                                    <label>No Chasis</label>
                                    <input type="number" name="no_chasis" value="{{ old('no_chasis') }}" placeholder="Masukkan No"
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>No Mesin</label>
                                    <input type="number" name="no_mesin" value="{{ old('no_mesin') }}" placeholder="Masukkan No Mesin "
                                        class="form-control @error('jenis_aset') is-invalid @enderror">
        
                                    @error('no_mesin')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Bahan Bakar</label>
                                    <input type="text" name="bahan_bakar" value="{{ old('bahan_bakar') }}" placeholder="Masukkan Bahan"
                                        class="form-control">
                                </div>
                            </div>
                           
                             <div class="col-md-3">
                                <div class="form-group">
                                    <label>Asal usul</label>
                                    <input type="text" name="asal_usul" value="{{ old('Asal Usul') }}" placeholder="Masukkan Asal "
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tahun Beli</label>
                                    <input type="date" name="bertingkat" value="{{ old('tahun_beli') }}" 
                                        class="form-control" placeholder="Masukkan bertingkat">
                                </div>
                            </div>
                        </div>

                         <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Kapasitas CC</label>
                                    <input type="number" name="kapasitas_cc" value="{{ old('kapasitas_cc') }}" placeholder="Masukkan CC "
                                        class="form-control @error('jenis_aset') is-invalid @enderror">
        
                                    @error('kapasitas_cc')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal Pajak</label>
                                    <input type="date" name="tgl_bayar_pajak" value="{{ old('tgl_bayar_pajak') }}" 
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Keadaan</label>
                                    <textarea name="keadaan" class="form-control" placeholder="Masukan Keadaan" id="" cols="30" rows="5"></textarea>
                                    
                                </div>
                            </div>
                             <div class="col-md-3">
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="alamat" class="form-control" placeholder="Masukan Keterangan" id="" cols="30" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                         <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="number" name="harga" value="{{ old('harga') }}" placeholder="Masukkan Harga "
                                        class="form-control @error('jenis_aset') is-invalid @enderror">
        
                                    @error('harga')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Type Roda</label>
                                    <input type="text" name="type_roda" value="{{ old('type_roda') }}" placeholder="Masukkan Type Roda"
                                        class="form-control">
                                </div>
                            </div>
                           
                          
                        </div>

                        <div class="text-center">
                            <button class="btn btn-primary mr-1 btn-submit" type="submit" disabled><i class="fa fa-paper-plane"></i>
                            SIMPAN</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection