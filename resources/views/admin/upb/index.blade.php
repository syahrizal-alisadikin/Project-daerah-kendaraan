@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>UPB</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-book"></i>UPB</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.upb.index') }}" method="GET">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('admin')
                                    <div class="input-group-prepend">
                                        <a href="{{ route('admin.upb.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                    </div>
                                @endcan
                                <input type="text" class="form-control" name="q"
                                       placeholder="cari berdasarkan nama upb">
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
                                {{-- <th scope="col" style="width: 6%">NO.</th> --}}
                                <th scope="col"> Bidang</th>
                                <th scope="col"> Unit</th>
                                <th scope="col"> Sub Unit</th>
                                <th scope="col">Kode Upb</th>
                                <th scope="col">Nama Upb</th>
                                <th scope="col">Lokasi</th>
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($upb as $no => $item)
                                <tr class="text-center">
                                    <td>{{ $item->subUnit->unit->bidang->name }}</td>
                                    <td>{{ $item->subUnit->unit->name }}</td>
                                    <td>{{ $item->subUnit->name }}</td>
                                    <td>{{ $item->kode_upb }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->lokasi }}</td>
                                    
                                    <td class="text-center">
                                            <a href="{{ route('admin.upb.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="7">Belum ada data UPB</td>
                                </tr>
                            @endforelse
                            
                            </tbody>
                        </table>
                    </div>
                    <div style="float: right !important">
                        {{$upb->links("vendor.pagination.bootstrap-4")}}
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
@endsection