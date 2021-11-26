<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Excel Pendataan Asset Tanah </title>
</head>
<body>
    <div class="card-body">
                    <div class="table-responsive">
                        Laporan Excel Pendataan Asset Tanah
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                           
                            <thead>
                                <tr class="text-center">
                                   <th scope="col" style="width: 6%">NO.</th>
                                
                                <th scope="col">Tanah</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Status</th>
                                <th scope="col">Alamat</th>
                                   
                                </tr>
                            </thead>
                           
                            <tbody>
                                @forelse ($tanah as $item)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>

                                     
                                    <td>{{ $item->name }}</td>
                                    <td>Rp{{ number_format($item->harga,0,",",".") }}</td>

                                    <td>@if ($item->status == "ada")
                                        <span class="badge badge-primary">Ada</span>
                                        @else
                                        <span class="badge badge-warning">Dipinjam</span>
                                        @endif</td>
                                    <td>{{ $item->alamat }}</td>
                                    
                                   
                                </tr>
                               
                                @empty
                                    <tr class="text-center">
                                        <td colspan="5">Belum ada data</td>
                                    </tr>
                                @endforelse
                                
                            </tbody>
                        </table>
                    </div>
                </div>
</body>
</html>