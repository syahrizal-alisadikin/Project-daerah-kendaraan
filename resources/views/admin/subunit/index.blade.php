@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Sub Units</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-book"></i>Sub Units</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.subunit.index') }}" method="GET">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('admin')
                                    <div class="input-group-prepend">
                                        <a href="{{ route('admin.subunit.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                    </div>
                                @endcan
                                <input type="text" class="form-control" name="q"
                                       placeholder="cari berdasarkan nama SubUnit">
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
                                <th scope="col">Nama Bidang</th>
                                <th scope="col">Nama Unit</th>
                                <th scope="col">Kode Sub Unit</th>
                                <th scope="col">Sub Unit</th>
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($subunit as $no => $item)
                                <tr class="text-center">
                                    <td>{{ $item->unit->bidang->name }}</td>
                                    <td>{{ $item->unit->name }}</td>
                                    <td>{{ $item->kode_sub_unit }}</td>
                                    <td>{{ $item->name }}</td>
                                    
                                    <td class="text-center">
                                            <a href="{{ route('admin.subunit.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="5">Belum ada data SubUnit</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div style="float: right !important">
                        {{$subunit->links("vendor.pagination.bootstrap-4")}}
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
@endsection