@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Unit</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-book"></i> Tambah Unit</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.units.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        

                       

                         <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Bidang</label>
                                    <select name="bidang_id" class="form-control" required>
                                        @forelse ($bidang as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @empty
                                            <option value="">Belum ada bidang</option>
                                            
                                        @endforelse
                                    </select>
        
                                   
                                </div>
                            </div>
                           
                            
                        </div>
                        <div class="row">
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kode Unit</label>
                                    <input type="number" name="kode_unit" value="{{ old('kode_unit') }}" placeholder="Masukkan  kode unit"
                                        class="form-control" required>
                                    @error('kode_unit')
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
                                    <label>Nama Unit</label>
                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama Unit"
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

@push('addon-script')
          <script>
                $(document).ready(function () {
            $('select').select2({
                theme: 'bootstrap4',
                width: 'style',
            });
        });
          </script>
@endpush