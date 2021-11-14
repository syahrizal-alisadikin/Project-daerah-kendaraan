@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Unit</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-book"></i> Edit Unit</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.subunit.update',$unit->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")

                       <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Bidang</label>
                                    <select name="bidang_id" id="bidang_id" class="form-control" required>
                                        @forelse ($bidang as $item)
                                            @if ($item->id == $unit->bidang_id)
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
                                        
                                            <option value="{{ $subunit->unit_id }}">{{ $subunit->unit->name }}</option>
                                            
                                    </select>
        
                                   
                                </div>
                            </div>
                           
                            
                        </div>
                         <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kode Sub Unit</label>
                                    <input type="number" name="kode_sub_unit" value="{{ old('kode_bidang',$subunit->kode_sub_unit) }}" placeholder="Masukkan Kode Unit "
                                        class="form-control @error('jenis_aset') is-invalid @enderror" required>
        
                                    @error('kode_sub_unit')
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
                                    <label>Nama Sub Unit</label>
                                    <input type="text" name="name" value="{{ old('name',$subunit->name) }}" placeholder="Masukkan nama Unit"
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
                        <a href="{{ route('admin.subunit.index') }}" class="btn btn-warning " ><i class="fa fa-redo"></i> Kembali</a>

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
          </script>
@endpush