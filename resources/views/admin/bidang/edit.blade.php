@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Bidang</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-book"></i> Edit Bidang</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.bidang.update',$bidang->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")

                       

                         <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kode Bidang</label>
                                    <input type="number" name="kode_bidang" value="{{ old('kode_bidang',$bidang->kode_bidang) }}" placeholder="Masukkan Kode Bidang "
                                        class="form-control @error('jenis_aset') is-invalid @enderror" required>
        
                                    @error('kode_bidang')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                           
                            
                        </div>
                        <div class="row">
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Bidang</label>
                                    <input type="text" name="name" value="{{ old('name',$bidang->name) }}" placeholder="Masukkan nama bidang"
                                        class="form-control" required>
                                    @error('name')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                            <button class="btn btn-primary mr-1 btn-submit" type="submit" ><i class="fa fa-paper-plane"></i>
                            SIMPAN</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection