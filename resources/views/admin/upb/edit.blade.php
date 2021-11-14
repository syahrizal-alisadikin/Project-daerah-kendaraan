@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Upb</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-book"></i> Edit Upb</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.upb.update',$upb->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")

                       <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Bidang</label>
                                    <select name="bidang_id" id="bidang_id" class="form-control" required>
                                        @forelse ($bidang as $item)
                                            @if ($item->id == $upb->subUnit->unit->bidang->id)
                                            <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                                
                                            @endif
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
                                    <label>Nama Unit</label>
                                    <select name="unit_id" id="unit_id" class="form-control" required>
                                        
                                            <option value="{{  $upb->subUnit->unit->id }}">{{ $upb->subUnit->unit->name }}</option>
                                            
                                    </select>
        
                                   
                                </div>
                            </div>
                           
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Sub Unit</label>
                                    <select name="subunit_id" id="subunit_id" class="form-control" required>
                                        
                                            <option value="{{ $upb->subUnit->id }}">{{ $upb->subUnit->name }}</option>
                                            
                                    </select>
        
                                   
                                </div>
                            </div>
                           
                            
                        </div>
                         <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kode Upb</label>
                                    <input type="number" name="kode_upb" value="{{ old('kode_bidang',$upb->kode_upb) }}" placeholder="Masukkan Kode Upb "
                                        class="form-control @error('jenis_aset') is-invalid @enderror" required>
        
                                    @error('kode_upb')
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
                                    <label>Nama Upb</label>
                                    <input type="text" name="name" value="{{ old('name',$upb->name) }}" placeholder="Masukkan nama Upb"
                                        class="form-control" required>
                                    @error('name')
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
                                    <label>Lokasi</label>
                                    <input type="text" name="lokasi" value="{{ old('name',$upb->lokasi) }}" placeholder="Masukkan Lokasi"
                                        class="form-control" required>
                                    @error('lokasi')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                            <button class="btn btn-primary mr-1 btn-submit" type="submit" ><i class="fa fa-paper-plane"></i>
                            SIMPAN</button>
                        <a href="{{ route('admin.upb.index') }}" class="btn btn-warning" ><i class="fa fa-redo"></i> Kembali</a>

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
           <script>
              $(document).ready(function(){
                $("#bidang_id").on("change",function(){
                    const bidang = $(this).val();
                    if (bidang) {
                        jQuery.ajax({
                            url: '/api/unit/'+bidang,
                            type: "GET",
                            dataType: "json",
                            success: function (response) {
                               if(response.length > 0){
                                    $('select[name="unit_id"]').empty();
                                    $('select[name="unit_id"]').append('<option value="">Pilih Unit</option>');
                                    $.each(response, function (key, value) {
                                        $('select[name="unit_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                                    });
                               }else{
                                        $('select[name="unit_id"]').empty();
                                    $('select[name="unit_id"]').append('<option value="">Unit Belum di buat</option>');

                               }
                            },
                        });
                    } else {
                        $('select[name="unit_id"]').append('<option value="">Pilih Unit</option>');
                    }
                })
              })
              $(document).ready(function(){
                $("#unit_id").on("change",function(){
                    const unit = $(this).val();
                    if (unit) {
                        jQuery.ajax({
                            url: '/api/subunit/'+unit,
                            type: "GET",
                            dataType: "json",
                            success: function (response) {
                               if(response.length > 0){
                                    $('select[name="subunit_id"]').empty();
                                    $('select[name="subunit_id"]').append('<option value="">Pilih Sub Unit</option>');
                                    $.each(response, function (key, value) {
                                        $('select[name="subunit_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                                    });
                               }else{
                                        $('select[name="subunit_id"]').empty();
                                    $('select[name="subunit_id"]').append('<option value="">Sub Unit Belum di buat</option>');

                               }
                            },
                        });
                    } else {
                        $('select[name="subunit_id"]').append('<option value="">Pilih Sub Unit</option>');
                    }
                })
              })
          </script>
@endpush