@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Kendaraan</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-book"></i> Kendaraan</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.kendaraan.index') }}" method="GET">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('admin')
                                    <div class="input-group-prepend">
                                        <a href="{{ route('admin.kendaraan.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                    </div>
                                @endcan
                                <input type="text" class="form-control" name="q"
                                       placeholder="cari berdasarkan No Polisi">
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
                                @if(auth()->user()->can('pimpinan'))
                                <th scope="col">Keberadaan</th>

                                @endif
                                <th scope="col">No Polisi</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Status</th>
                                <th scope="col">Merk</th>
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($kendaraan as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>

                                     @if(auth()->user()->can('pimpinan'))
                                        <td scope="col">{{ $item->user->name }}</td>

                                        @endif
                                    <td>{{ $item->no_polisi }}</td>
                                    <td>Rp{{ number_format($item->harga,0,",",".") }}</td>
                                    <td>
                                        @if ($item->status == "ada")
                                        <span class="badge badge-primary">Ada</span>
                                        @else
                                        <span class="badge badge-warning">Dipinjam</span>
                                        @endif
                                    </td>
                                    <td>{{ $item->merk }}</td>
                                    
                                    <td class="text-center">
                                            <a href="{{ route('admin.kendaraan.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        
                                    </td>
                                </tr>
                               
                                @empty
                                    <tr class="text-center">
                                        <td colspan="5">Belum ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        
                    </div>
                     <div style="float: right !important">
                        {{$kendaraan->links("vendor.pagination.bootstrap-4")}}
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
@endsection