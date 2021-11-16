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
                    <form action="{{ route('admin.kendaraan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keberadaan</label>
                                    <select name="user_id" id="user_id" class="form-control">
                                        <option value="">Pilih Keberadaan</option>
                                        @foreach ($user as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Bidang</label>
                                    <input type="text" class="form-control" disabled id="bidang">
                                </div>
                            </div>
                        </div>
                        <div class="row" @if(!$errors->any())
                                style="display: none"
                                @endif>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Foto</label>
                                    <input type="file" name="foto" value="{{ old('foto') }}" 
                                        class="form-control @error('foto') is-invalid @enderror" required>
        
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
                                        class="form-control @error('file') is-invalid @enderror" required>
                                     @error('file')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                         
                        </div>
                        <div class="row" @if(!$errors->any())
                                style="display: none"
                                @endif>
                             <div class="col-md-3">
                                <div class="form-group">
                                    <label>Type Roda</label>
                                    <select name="type_roda" id="" class="form-control" required>
                                        <option value="Roda 2">Roda 2</option>
                                        <option value="Roda 3">Roda 3</option>
                                        <option value="Roda 4">Roda 4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Kode Barang</label>
                                    <input type="text" name="kode_barang" value="{{ old('kode_barang') }}" placeholder="Masukkan Kode"
                                        class="form-control @error('kode_barang') is-invalid @enderror"  required>
        
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
                                        class="form-control @error('register') is-invalid @enderror" required>
                                        @error('register')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tahun Perolehan</label>
                                    <Select name="tahun_perolehan" class="form-control" required>
                                        <option value="1990">1990</option>
                                        <option value="1991">1991</option>
                                        <option value="1992">1992</option>
                                        <option value="1993">1993</option>
                                        <option value="1994">1994</option>
                                        <option value="1995">1995</option>
                                        <option value="1996">1996</option>
                                        <option value="1997">1997</option>
                                        <option value="1998">1998</option>
                                        <option value="1999">1999</option>
                                        <option value="2000">2000</option>
                                        <option value="2001">2001</option>
                                        <option value="2002">2002</option>
                                        <option value="2003">2003</option>
                                        <option value="2004">2004</option>                                        <option value="2004">2004</option>
                                        <option value="2005">2005</option>
                                        <option value="2006">2006</option>
                                        <option value="2007">2007</option>
                                        <option value="2008">2008</option>
                                        <option value="2009">2009</option>
                                        <option value="2010">2010</option>
                                        <option value="2011">2011</option>
                                        <option value="2012">2012</option>
                                        <option value="2013">2013</option>
                                        <option value="2014">2014</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>

                                    </Select>
                                </div>
                            </div>
                        </div>

                      

                        <div class="row" @if(!$errors->any())
                                style="display: none"
                                @endif>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="number" name="harga" value="{{ old('harga') }}" placeholder="Masukkan Harga "
                                        class="form-control @error('harga') is-invalid @enderror" required>
        
                                    @error('harga')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Merk</label>
                                    <input type="text" name="merk" value="{{ old('merk') }}" placeholder="Masukkan Merk"
                                        class="form-control @error('merk') is-invalid @enderror" required>
                                        @error('merk')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Type</label>
                                    <input type="text" name="type" value="{{ old('type') }}" placeholder="Masukkan Type"
                                        class="form-control @error('type') is-invalid @enderror" required>
                                        @error('type')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>No Polisi</label>
                                    <input type="text" name="no_polisi" value="{{ old('no_polisi') }}" 
                                        class="form-control @error('no_polisi') is-invalid @enderror" placeholder="Masukan No Polisi" required>
                                @error('no_polisi')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    </div>
                            </div>
                             
                        </div>

                        <div class="row"  
                                @if(!$errors->any())
                                style="display: none"
                                @endif >
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>No Rangka</label>
                                    <input type="text" name="no_rangka" value="{{ old('no_rangka') }}" placeholder="Masukkan No Rangka"
                                        class="form-control @error('no_rangka') is-invalid @enderror" required>
                                    @error('no_rangka')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>No Mesin</label>
                                    <input type="number" name="no_mesin" value="{{ old('no_mesin') }}" placeholder="Masukkan No Mesin "
                                        class="form-control @error('no_mesin') is-invalid @enderror" required>
        
                                    @error('no_mesin')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            
                           
                             <div class="col-md-3">
                                <div class="form-group">
                                    <label>No BPKB</label>
                                    <input type="text" name="no_bpkb" value="{{ old('no_bpkb') }}" placeholder="Masukkan No Bpkb "
                                        class="form-control @error('no_bpkb') is-invalid @enderror" required>
                                        @error('no_bpkb')
                                    <div class="invalid-feedback" style="display: block">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Masa berlaku STNK</label>
                                    <input type="date" name="masa_berlaku_stnk" value="{{ old('masa_berlaku_stnk') }}" 
                                        class="form-control" placeholder="Masukkan bertingkat" required>
                                </div>
                            </div>
                        </div>

                         <div class="row" @if(!$errors->any())
                                style="display: none"
                                @endif>
                           <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <input type="text" name="status" class="form-control" readonly value="ada" id="">
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" required class="form-control" placeholder="Masukan Keterangan" id="" cols="30" rows="10">{{ old('keterangan') }}</textarea>
                                </div>
                            </div>
                        </div>
                         

                        <div class="text-center" id="button" @if(!$errors->any())
                                style="display: none"
                                @endif>
                            <button class="btn btn-primary mr-1 btn-submit" type="submit" ><i class="fa fa-paper-plane"></i>
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
        <script>
              $(document).ready(function(){
                $("#user_id").on("change",function(){
                    const user = $(this).val();
                    if (user) {
                        jQuery.ajax({
                            url: '/api/user/'+user,
                            type: "GET",
                            dataType: "json",
                            success: function (response) {
                                // console.log(response)
                                if(response.upb_id){
                                    $("#bidang").val(response.upb.name)

                                }else if(response.subunit_id){
                                    $("#bidang").val(response.subunit.name)


                                }else if(response.unit_id){
                                    $("#bidang").val(response.unit.name)

                                }else{
                                    $("#bidang").val(response.bidang.name)

                                }

                                $(".row").show();
                                $("#button").show();
                           
                            },
                        });
                    }else{
                        $("#bidang").val("Pilih Keberadaan")

                        // $(".row").hide();
                        $("#button").hide();
                    }
                })
              })

             
          </script>

@endpush