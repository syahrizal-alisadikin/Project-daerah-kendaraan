@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Mutasi Tanah</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-book"></i>Mutasi Tanah</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.mutasi-tanah.index') }}" method="GET">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <a href="{{ route('admin.mutasi-tanah.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                    </div>
                                <input type="text" class="form-control" name="q"
                                       placeholder="cari berdasarkan nama No surat">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> CARI
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr class="text-center">
                                <th scope="col" style="width: 6%">NO.</th>
                                
                                <th scope="col">No Surat</th>
                                <th scope="col">Pemilik Lama</th>
                                <th scope="col">Pemilik Baru</th>
                                <th scope="col">Status</th>
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                            </tr>
                            </thead>
                            <tbody>
                                
                                @forelse ($mutasi as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>

                                     
                                    <td>{{ $item->no_surat }}</td>

                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->mutasi->name }}</td>
                                    <td>@if ($item->status == "success")
                                        <span class="badge badge-primary">Success</span>
                                        @else
                                        <span class="badge badge-warning">Pending</span>
                                        @endif</td>
                                    
                                    <td class="text-center">
                                            @if ($item->user_id == Auth::user()->id)

                                            <a href="{{ route('admin.pinjam-tanah.edit',$item->id) }}"  class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                            @endif

                                            @if ($item->mutasi_id == Auth::user()->id)
                                                @if ($item->status == "pending")
                                                    
                                                <a href="javascript:void(0)" onClick="Kembali(this.id)" id="{{ $item->id }}" class="btn btn-sm btn-success">
                                                <i class="fas fa-share"></i>
                                            </a>
                                                @endif
                                            @endif
                                        
                                    </td>
                                </tr>
                               
                                @empty
                                    <tr class="text-center">
                                        <td colspan="6">Belum ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        
                    </div>
                     <div style="float: right !important">
                        {{$mutasi->links("vendor.pagination.bootstrap-4")}}
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
@endsection
{{-- @push('addon-script')
    <script>
    //ajax delete
    function Kembali(id)
        {
            var id = id;
            var token = $("meta[name='csrf-token']").attr("content");

            swal({
                title: "APAKAH KAMU YAKIN ?",
                text: "INGIN MENGEMBALIKAN TANAH INI!",
                icon: "warning",
                buttons: [
                    'TIDAK',
                    'YA'
                ],
                dangerMode: true,
            }).then(function(isConfirm) {
                if (isConfirm) {

                    //ajax delete
                    jQuery.ajax({
                        url: "{{ url("admin/pinjam-tanah/kembali-tanah") }}/"+id,
                        data:   {
                            "id": id,
                            "_token": token
                        },
                        type: 'POST',
                        success: function (response) {
                            if (response.status == "success") {
                                swal({
                                    title: 'BERHASIL!',
                                    text: 'DATA BERHASIL DIKEMBALIKAN!',
                                    icon: 'success',
                                    timer: 2000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            }else{
                                swal({
                                    title: 'GAGAL!',
                                    text: 'DATA GAGAL DIEKMBALIKAN!',
                                    icon: 'error',
                                    timer: 2000,
                                    showConfirmButton: false,
                                    showCancelButton: false,
                                    buttons: false,
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        }
                    });

                } else {
                    return true;
                }
            })
        }
</script>
@endpush --}}