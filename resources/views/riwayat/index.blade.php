<div class="page-content">

    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <form id="printForm" action="{{ route('riwayat.print') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-info">
                    <i class="fas fa-print"></i>
                </button>
            </form>

        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Histori Transaksi</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal Transaksi</th>
                                
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayat as $ryt)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$ryt->created_at->format('d F Y')}}</td>
                                  
                                    <td>{{format_rupiah($ryt->total)}}</td>
                                    <td>@if($ryt->status == 'selesai')
                                        <span>Selesai</span>
                                        @else
                                        <span>Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if(auth()->user()->role!="pengguna")
                                        <form action="{{ route('riwayat.destroy', ['id' => $ryt->id]) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-icon" onclick="return confirm('Apakah Anda yakin ingin menghapus?');">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>