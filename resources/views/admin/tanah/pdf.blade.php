<html>
<head>
    @php
            $user = Auth::user();
        @endphp
    <title>Laporan Pendataan Asset Tanah {{ $user->upb_id != null ? $user->upb->name :  ($user->subunit_id != null ? $user->subunit->name : ($user->unit_id != null ? $user->unit->name : $user->bidang->name))}}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <style type="text/css">
        table tr td,
        table tr th{
            font-size: 9pt;
        }
    </style>
    <center>
        <h4>Laporan Pendataan asset</h4>
        <h4>Tanah</h4>
        
           
        @if(auth()->user()->can('pimpinan'))
          <h4>  Semua</h4>
        @else
        
            <h4>{{ $user->upb_id != null ? $user->upb->name :  ($user->subunit_id != null ? $user->subunit->name : ($user->unit_id != null ? $user->unit->name : $user->bidang->name))}}</h4>
        
                
        @endif
         
        
    </center>
 
    <table class='table table-bordered'>
        <thead>
            <tr class="text-center">
                 <th scope="col" style="width: 6%">NO.</th>
                @if(auth()->user()->can('pimpinan'))
                <th scope="col">Keberadaan</th>

                @endif
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

                                     @if(auth()->user()->can('pimpinan'))
                                        <td scope="col">{{ $item->user->name }}</td>

                                        @endif
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
 
</body>
</html>