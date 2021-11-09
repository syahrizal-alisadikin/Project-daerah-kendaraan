@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>History</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-chart-line"></i>History</h4>
                </div>

                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table table-hover scroll-horizontal-vertical w-100" id="historyTable">
                            <thead>
                            <tr class="text-center">
                                <th scope="col" style="width: 6%">NO.</th>
                                <th scope="col">Admin</th>
                                <th scope="col">Aksi</th>
                                <th scope="col">Waktu</th>
                            </tr>
                            </thead>
                            
                        </table>
                        
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>


@endsection

@push('addon-script')

    <script>
    $('#historyTable').DataTable({
      proccesing:true,
      serverSide:true,
      ajax:{
        url: '{!! route('admin.history.index') !!}',
      },
      columns:[
        { data: 'DT_RowIndex', name:'DT_RowIndex'},
        { data:'user.name', name:'user.name'},
        { data:'aksi', name:'aksi'},
        { data:'waktu', name:'waktu'},
    
      ],
       columnDefs: [
            {
                "targets": 0, // your case first column
                "className": "text-center",
                
            }, 
             {
                "targets": 1, // your case first column
                "className": "text-center",
            },
             {
                "targets": 2, // your case first column
                "className": "text-center",
            },
             {
                "targets": 3, // your case first column
                "className": "text-center",
            }
           
            ]
        
        
  })
</script>
@endpush