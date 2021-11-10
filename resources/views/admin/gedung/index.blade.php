@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Gedung</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-book"></i> Gedung</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.gedung.index') }}" method="GET">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                @can('admin.create')
                                    <div class="input-group-prepend">
                                        <a href="{{ route('admin.gedung.create') }}" class="btn btn-primary" style="padding-top: 10px;"><i class="fa fa-plus-circle"></i> TAMBAH</a>
                                    </div>
                                @endcan
                                <input type="text" class="form-control" name="q"
                                       placeholder="cari berdasarkan nama gedung">
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
                                <th scope="col">Nama Gedung</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Alamat</th>
                                <th scope="col" style="width: 15%;text-align: center">AKSI</th>
                            </tr>
                            </thead>
                            <tbody>
                          
                            </tbody>
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
@endsection