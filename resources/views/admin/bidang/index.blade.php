@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Bidang</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-book"></i> Bidang</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.bidang.index') }}" method="GET">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('admin')
                                    <div class="input-group-prepend">
                                        <a href="{{ route('admin.bidang.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                    </div>
                                @endcan
                                <input type="text" class="form-control" value="{{ request()->q }}" name="q"
                                       placeholder="cari berdasarkan nama Bidang">
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
                                <th scope="col">Kode Bidang</th>
                                <th scope="col">Nama Bidang</th>
                                <th scope="col">Kode Unit</th>
                                <th scope="col">Unit</th>
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($bidang as $no => $item)
                                <tr class="text-center">
                                    {{-- <th scope="row" style="text-align: center">{{ ++$no + ($bidang->currentPage()-1) * $bidang->perPage() }}</th> --}}
                                    <td>{{ $item->kode_bidang }}</td>
                                    <td>{{ $item->name }}</td>
                                    
                                    <td>
                                        @if ($item->unit->count() > 0)
                                            
                                            @foreach ($item->unit as $u)
                                        
                                                {{ $u->kode_unit  }} <br>
    
                                            
                                            @endforeach
                                        @else
                                        -
                                        @endif
                                    </td>
                                      <td>
                                        @if ($item->unit->count() > 0)
                                            
                                            @foreach ($item->unit as $u)
                                        
                                                {{ $u->name }} <br>
    
                                            
                                            @endforeach
                                         @else
                                        -
                                        @endif
                                    </td>
                                    
                                    <td class="text-center">
                                            <a href="{{ route('admin.bidang.edit', $item->id) }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        
                                            {{-- <button onClick="Delete(this.id)" class="btn btn-sm btn-danger" id="{{ $item->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button> --}}
                                    </td>
                                </tr>
                            @empty
                                <tr class="text-center">
                                    <td colspan="5">Belum ada data Bidang</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div style="float: right !important">
                        {{$bidang->links("vendor.pagination.bootstrap-4")}}
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
@endsection