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
                    <form action="{{ route('admin.kendaraan.update',$kendaraan->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keberadaan</label>
                                    <select name="user_id" id="user_id" class="form-control">
                                        <option value="">Pilih Keberadaan</option>
                                        @foreach ($user as $item)
                                        @if ($item->id == $kendaraan->user_id)
                                        <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                            
                                        @else
                                            
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Bidang</label>
                                    <input type="text" class="form-control" value="{{ $kendaraan->user->upb_id != null ? $kendaraan->user->upb->name : ($kendaraan->user->subunit_id != null ? $kendaraan->user->subunit->name : ($kendaraan->user->unit_id != null ? $kendaraan->user->unit->name : $kendaraan->user->bidang->name )) }}"  readonly id="bidang">
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Foto</label>
                                    <input type="file" name="foto" value="{{ old('foto') }}" 
                                        class="form-control @error('foto') is-invalid @enderror" >
        
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
                                        class="form-control @error('file') is-invalid @enderror" >
                                     @error('file')
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
                                    <label>Type Roda</label>
                                    <select name="type_roda" id="" class="form-control">
                                        <option value="Roda 2" {{ $kendaraan->type_roda == "Roda 2" ? "selected" : '' }}>Roda 2</option>
                                        <option value="Roda 3"  {{ $kendaraan->type_roda == "Roda 3" ? "selected" : '' }}>Roda 3</option>
                                        <option value="Roda 4"  {{ $kendaraan->type_roda == "Roda 4" ? "selected" : '' }}>Roda 4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Kode Barang</label>
                                    <input type="text" name="kode_barang" value="{{ old('kode_barang',$kendaraan->kode_barang) }}" placeholder="Masukkan Kode"
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
                                    <input type="number" name="register" value="{{ old('register',$kendaraan->register) }}" placeholder="Masukkan Register"
                                        class="form-control">
                                </div>
                            </div>
                            
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>kendaraan</label>
                                    <Select name="tahun_perolehan" class="form-control">
                                        <option value="1990" {{ $kendaraan->tahun_perolehan == "1990" ? "selected" : "" }}>1990</option>
                                        <option value="1991" {{ $kendaraan->tahun_perolehan == "1991" ? "selected" : "" }}>1991</option>
                                        <option value="1992" {{ $kendaraan->tahun_perolehan == "1992" ? "selected" : "" }}>1992</option>
                                        <option value="1993" {{ $kendaraan->tahun_perolehan == "1993" ? "selected" : "" }}>1993</option>
                                        <option value="1994" {{ $kendaraan->tahun_perolehan == "1994" ? "selected" : "" }}>1994</option>
                                        <option value="1995" {{ $kendaraan->tahun_perolehan == "1995" ? "selected" : "" }}>1995</option>
                                        <option value="1996" {{ $kendaraan->tahun_perolehan == "1996" ? "selected" : "" }}>1996</option>
                                        <option value="1997" {{ $kendaraan->tahun_perolehan == "1997" ? "selected" : "" }}>1997</option>
                                        <option value="1998" {{ $kendaraan->tahun_perolehan == "1998" ? "selected" : "" }}>1998</option>
                                        <option value="1999" {{ $kendaraan->tahun_perolehan == "1999" ? "selected" : "" }}>1999</option>
                                        <option value="2000" {{ $kendaraan->tahun_perolehan == "2000" ? "selected" : "" }}>2000</option>
                                        <option value="2001" {{ $kendaraan->tahun_perolehan == "2001" ? "selected" : "" }}>2001</option>
                                        <option value="2002" {{ $kendaraan->tahun_perolehan == "2002" ? "selected" : "" }}>2002</option>
                                        <option value="2003" {{ $kendaraan->tahun_perolehan == "2005" ? "selected" : "" }}>2005</option>
                                        <option value="2006" {{ $kendaraan->tahun_perolehan == "2006" ? "selected" : "" }}>2006</option>
                                        <option value="2007" {{ $kendaraan->tahun_perolehan == "2007" ? "selected" : "" }}>2007</option>
                                        <option value="2008" {{ $kendaraan->tahun_perolehan == "2008" ? "selected" : "" }}>2008</option>
                                        <option value="2009" {{ $kendaraan->tahun_perolehan == "2009" ? "selected" : "" }}>2009</option>
                                        <option value="2010" {{ $kendaraan->tahun_perolehan == "2010" ? "selected" : "" }}>2010</option>
                                        <option value="2011" {{ $kendaraan->tahun_perolehan == "2011" ? "selected" : "" }}>2011</option>
                                        <option value="2012" {{ $kendaraan->tahun_perolehan == "2012" ? "selected" : "" }}>2012</option>
                                        <option value="2013" {{ $kendaraan->tahun_perolehan == "2013" ? "selected" : "" }}>2013</option>
                                        <option value="2014" {{ $kendaraan->tahun_perolehan == "2014" ? "selected" : "" }}>2014</option>
                                        <option value="2015" {{ $kendaraan->tahun_perolehan == "2015" ? "selected" : "" }}>2015</option>
                                        <option value="2016" {{ $kendaraan->tahun_perolehan == "2016" ? "selected" : "" }}>2016</option>
                                        <option value="2017" {{ $kendaraan->tahun_perolehan == "2017" ? "selected" : "" }}>2017</option>
                                        <option value="2018" {{ $kendaraan->tahun_perolehan == "2018" ? "selected" : "" }}>2018</option>
                                        <option value="2019" {{ $kendaraan->tahun_perolehan == "2019" ? "selected" : "" }}>2019</option>
                                        <option value="2020" {{ $kendaraan->tahun_perolehan == "2020" ? "selected" : "" }}>2020</option>
                                        <option value="2021" {{ $kendaraan->tahun_perolehan == "2021" ? "selected" : "" }}>2021</option>
                                        <option value="2022" {{ $kendaraan->tahun_perolehan == "2022" ? "selected" : "" }}>2022</option>

                                    </Select>
                                </div>
                            </div>
                        </div>

                      

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Harga</label>
                                    <input type="number" name="harga" value="{{ old('harga',$kendaraan->harga) }}" placeholder="Masukkan Harga "
                                        class="form-control @error('jenis_aset') is-invalid @enderror">
        
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
                                    <input type="text" name="merk" value="{{ old('merk',$kendaraan->merk) }}" placeholder="Masukkan Merk"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Type</label>
                                    <input type="text" name="type" value="{{ old('type',$kendaraan->type) }}" placeholder="Masukkan Type"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>No Polisi</label>
                                    <input type="text" name="no_polisi" value="{{ old('no_polisi',$kendaraan->no_polisi) }}" 
                                        class="form-control" placeholder="Masukan No Polisi">
                                </div>
                            </div>
                             
                        </div>

                        <div class="row"  
                                >
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>No Rangka</label>
                                    <input type="text" name="no_rangka" value="{{ old('no_rangka',$kendaraan->no_rangka) }}" placeholder="Masukkan No Rangka"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>No Mesin</label>
                                    <input type="number" name="no_mesin" value="{{ old('no_mesin',$kendaraan->no_mesin) }}" placeholder="Masukkan No Mesin "
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
                                    <label>No BPKB</label>
                                    <input type="text" name="no_bpkb" value="{{ old('no_bpkb',$kendaraan->no_bpkb) }}" placeholder="Masukkan No Bpkb "
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Masa berlaku STNK</label>
                                    <input type="date" name="masa_berlaku_stnk" value="{{ old('masa_berlaku_stnk',$kendaraan->masa_berlaku_stnk) }}" 
                                        class="form-control" >
                                </div>
                            </div>
                        </div>

                         <div class="row">
                           <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <input type="text" name="status" class="form-control" readonly value="{{ $kendaraan->status }}" id="">
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="keterangan" class="form-control" placeholder="Masukan Keterangan" id="" cols="30" rows="10">{{ old('keterangan',$kendaraan->keterangan) }}</textarea>
                                </div>
                            </div>
                        </div>
                         

                        <div class="text-center" id="button" >
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