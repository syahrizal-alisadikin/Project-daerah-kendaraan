@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Pinjam Tanah</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-book"></i> Tambah Pinjam Tanah</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.pinjam-tanah.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tanah</label>
                                    <select name="tanah_id" id="tanah_id" class="form-control" required>
                                        <option value="">Pilih Tanah</option>
                                        @foreach ($tanah as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" class="form-control" readonly id="nameTanah">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Bidang</label>
                                    <input type="text" class="form-control" readonly id="bidangTanah">
                                    <input type="hidden" name="user_id" id="user_id" class="form-control" readonly id="bidang">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pinjamkan kepada</label>
                                    <select name="pinjam_id" id="pinjam_id" class="form-control">
                                        <option value="">Pilih Tujuan</option>
                                        @foreach ($user as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Bidang</label>
                                    <input type="text" class="form-control" readonly id="bidangPinjam">
                                </div>
                            </div>
                        </div>
                        <div class="row" style="display: none">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Foto</label>
                                    <input type="file" name="foto" value="{{ old('foto') }}" 
                                        class="form-control  @error('foto') is-invalid @enderror" required>
        
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
                                        class="form-control  @error('file') is-invalid @enderror" required>
                                        @error('file')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                         
                        </div>
                        <div class="row" style="display: none">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>No Surat</label>
                                    <input type="text" name="no_surat" value="{{ old('no_surat') }}" placeholder="Masukkan No Surat"
                                        class="form-control @error('no_surat') is-invalid @enderror" required>
        
                                    @error('no_surat')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal Surat</label>
                                    <input type="date" name="tgl_surat" value="{{ old('tgl_surat') }}"
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal Pinjam</label>
                                    <input type="date" name="tgl_pinjam" value="{{ old('tgl_pinjam') }}" 
                                        class="form-control @error('tgl_pinjam') is-invalid @enderror" required>
        
                                    @error('tgl_pinjam')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status</label>
                                    <input type="text" name="stsatus" value="dipinjam" readonly 
                                        class="form-control @error('status') is-invalid @enderror" required>
        
                                    @error('status')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                      

                        

                        <div class="text-center" id="button" style="display: none">
                            <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
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
@push('addon-script')
          <script>
                $(document).ready(function () {
                    $('select').select2({
                        theme: 'bootstrap4',
                        width: 'style',
                    });
                });
          </script>
          {{-- Change Tanah --}}
        <script>
              $(document).ready(function(){
                $("#tanah_id").on("change",function(){
                    const tanah = $(this).val();
                    if (tanah) {
                        jQuery.ajax({
                            url: '/api/tanah/'+tanah,
                            type: "GET",
                            dataType: "json",
                            success: function (response) {
                                if(response.user.upb_id){
                                    $("#bidangTanah").val(response.user.upb.name)

                                }else if(response.user.subunit_id){
                                    $("#bidangTanah").val(response.user.subunit.name)


                                }else if(response.user.unit_id){
                                    $("#bidangTanah").val(response.user.unit.name)

                                }else{
                                    $("#bidangTanah").val(response.user.bidang.name)

                                }
                                $("#nameTanah").val(response.user.name)
                                $("#user_id").val(response.user.id)

                                // $(".row").show();
                                // $("#button").show();
                           
                            },
                        });
                    }else{
                        
                        $("#button").hide();
                    }
                })
              })

             
          </script>
          {{-- Change Tujuan pinjam --}}
          <script>
              $(document).ready(function(){
                $("#pinjam_id").on("change",function(){
                    const user = $(this).val();
                    if (user) {
                        jQuery.ajax({
                            url: '/api/user/'+user,
                            type: "GET",
                            dataType: "json",
                            success: function (response) {
                                // console.log(response)
                                if(response.upb_id){
                                    $("#bidangPinjam").val(response.upb.name)

                                }else if(response.subunit_id){
                                    $("#bidangPinjam").val(response.subunit.name)


                                }else if(response.unit_id){
                                    $("#bidangPinjam").val(response.unit.name)

                                }else{
                                    $("#bidangPinjam").val(response.bidang.name)

                                }

                                $(".row").show();
                                $("#button").show();
                           
                            },
                        });
                    }else{
                        $("#bidangPinjam").val("Pilih Keberadaan")

                        // $(".row").hide();
                        $("#button").hide();
                    }
                })
              })

             
          </script>

@endpush