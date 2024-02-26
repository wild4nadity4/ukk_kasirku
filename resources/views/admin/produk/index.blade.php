<div class="row p-2">
  <div class="col-md-12">
    <div class="card">

      <div class="card-title p-2">

      </div>
      <div class="card-body">

        <h5><b>{{ $title }}</b></h5>

        <a href="/admin/produk/create" class="btn btn-primary mb-2"><i class="fas fa-plus"></i> Tambah</a>

        <table class="table">
    <tr>
        <th>NO</th>
        <th>Name</th>
        <th>gambar produk</th>
        <th>stok produk</th>
        <th>Harga produk</th>
        <th>Kategori produk</th>
        <th>Action</th>
    </tr>

    @foreach($produk as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->name }}</td>
            <td>
                <img src="{{ asset($item->gambar) }}" alt="" style="max-width: 100px; max-height: 100px;">
            </td>
            <td>
                @if ($item->stok > 0)
                    {{ $item->stok }}
                @else
                    <span class="text-danger">Produk Habis</span>
                @endif
            </td>
            <td>{{ $item->harga }}</td>
            @if($item->kategori)
                <td>{{ $item->kategori->name }}</td>
            @else
                <td>Kategori tidak tersedia</td>
            @endif
            <td>
                <div class="d-flex">
                    <a href="/admin/produk/{{ $item->id }}/edit" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                    @if ($item->stok > 0)
                        <form action="/admin/produk/{{ $item->id }}" method="POST">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm ml-1"><i class="fas fa-trash"></i></button>
                        </form>
                    @endif
                </div>
            </td>
        </tr>
    @endforeach

</table>

{{ $produk->links() }}
      </div>
    </div>
  </div>
</div>