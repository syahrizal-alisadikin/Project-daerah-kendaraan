@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah User</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-unlock"></i> Tambah User</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            
                            <label>Foto</label>
                            <input type="file" name="foto" 
                                class="form-control @error('foto') is-invalid @enderror" required>

                            @error('foto')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
 <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                                placeholder="Masukkan Nama Lengkap"
                                class="form-control @error('nama_lengkap') is-invalid @enderror">

                            @error('nama_lengkap')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>NAMA USER</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan Nama User"
                                class="form-control @error('name') is-invalid @enderror">

                            @error('name')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>EMAIL</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="Masukkan Email"
                                class="form-control @error('email') is-invalid @enderror">

                            @error('email')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Bidang</label>
                                    <select name="bidang_id" id="bidang_id" class="form-control">
                                            <option value="">Pilih Bidang</option>

                                        @forelse ($bidang as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @empty
                                            <option value="">Belum ada bidang</option>
                                            
                                        @endforelse
                                    </select>
        
                                   
                                </div>
                            </div>
                           
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Unit</label>
                                    <select name="unit_id" id="unit_id" class="form-control" >
                                        
                                            <option value="">Pilih Unit</option>
                                            
                                    </select>
        
                                   
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Sub unit</label>
                                    <select name="subunit_id" id="subunit_id" class="form-control">
                                            <option value="">Pilih Sub unit</option>

                                        
                                    </select>
        
                                   
                                </div>
                            </div>
                           
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nama Upb</label>
                                    <select name="upb_id" id="upb_id" class="form-control" >
                                        
                                            <option value="">Pilih Upb</option>
                                            
                                    </select>
        
                                   
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>PASSWORD</label>
                                    <input type="password" name="password" value="{{ old('password') }}" placeholder="Masukkan Password"
                                        class="form-control @error('password') is-invalid @enderror">
        
                                    @error('password')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>PASSWORD</label>
                                    <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Masukkan Konfirmasi Password"
                                        class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">ROLE</label> <br>
                            
                            @foreach ($roles as $role)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="role[]" value="{{ $role->name }}" id="check-{{ $role->id }}">
                                <label class="form-check-label" for="check-{{ $role->id }}">
                                    {{ $role->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                            SIMPAN</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@stop
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
              $(document).ready(function(){
                $("#subunit_id").on("change",function(){
                    const unit = $(this).val();
                    if (unit) {
                        jQuery.ajax({
                            url: '/api/upb/'+unit,
                            type: "GET",
                            dataType: "json",
                            success: function (response) {
                               if(response.length > 0){
                                    $('select[name="upb_id"]').empty();
                                    $('select[name="upb_id"]').append('<option value="">Pilih Upb</option>');
                                    $.each(response, function (key, value) {
                                        $('select[name="upb_id"]').append('<option value="' + value.id + '">' + value.name + '</option>');
                                    });
                               }else{
                                        $('select[name="upb_id"]').empty();
                                    $('select[name="upb_id"]').append('<option value="">Upb Unit Belum di buat</option>');

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