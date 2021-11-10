@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Gedung</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-book"></i> Tambah Gedung</h4>
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
                                    <label>Nama Gedung</label>
                                    <input type="text" name="nama_gedung" value="{{ old('nama_gedung') }}" placeholder="Masukkan Nama"
                                        class="form-control @error('password') is-invalid @enderror">
        
                                    @error('nama_gedung')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>No Sertifikat</label>
                                    <input type="text" name="password" value="{{ old('no_sertifikat') }}" placeholder="Masukkan No"
                                        class="form-control @error('no_sertifikat') is-invalid @enderror">
        
                                    @error('no_sertifikat')
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
                                    <label>Jenis Aset</label>
                                    <input type="text" name="jenis_aset" value="{{ old('jenis_aset') }}" placeholder="Masukkan Jenis "
                                        class="form-control @error('jenis_aset') is-invalid @enderror">
        
                                    @error('jenis_aset')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>No PBB</label>
                                    <input type="number" name="no_ppb" value="{{ old('no_ppb') }}" placeholder="Masukkan No PBB"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tahun</label>
                                    <input type="date" name="tahun_perolehan" value="{{ old('tahun_perolehan') }}" 
                                        class="form-control">
                                </div>
                            </div>
                             <div class="col-md-3">
                                <div class="form-group">
                                    <label>Luas</label>
                                    <input type="number" name="luas" value="{{ old('luas') }}" placeholder="Masukkan Luas"
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Kondisi</label>
                                    <input type="text" name="kondisi" value="{{ old('kondisi') }}" placeholder="Masukkan Kondisi "
                                        class="form-control @error('jenis_aset') is-invalid @enderror">
        
                                    @error('jenis_aset')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Bahan</label>
                                    <input type="text" name="bahan" value="{{ old('bahan') }}" placeholder="Masukkan No Bahan"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Bertingkat</label>
                                    <input type="text" name="bertingkat" value="{{ old('bertingkat') }}" 
                                        class="form-control" placeholder="Masukkan bertingkat">
                                </div>
                            </div>
                             <div class="col-md-3">
                                <div class="form-group">
                                    <label>Asal usul</label>
                                    <input type="text" name="asal_usul" value="{{ old('Asal Usul') }}" placeholder="Masukkan Asal "
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                         <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status Tanah</label>
                                    <input type="text" name="status_tanah" value="{{ old('status_tanah') }}" placeholder="Masukkan Status "
                                        class="form-control @error('jenis_aset') is-invalid @enderror">
        
                                    @error('status_tanah')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="number" name="harga" value="{{ old('harga') }}" placeholder="Masukkan Harga"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea name="alamat" class="form-control" placeholder="Masukan alamat" id="" cols="30" rows="5"></textarea>
                                    
                                </div>
                            </div>
                             <div class="col-md-3">
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="alamat" class="form-control" placeholder="Masukan Keterangan" id="" cols="30" rows="5"></textarea>
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