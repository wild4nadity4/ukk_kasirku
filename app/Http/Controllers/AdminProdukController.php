<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Http\Request;
use App\Models\Produk;
use RealRashid\SweetAlert\Facades\Alert;

class AdminProdukController extends Controller
{
    public function index()
    {
        //
        //die('masuk');

        $data = [
            'title'   => 'Manajemen Produk',
            'produk'   => Produk::paginate(10),
            'content' => 'admin/produk/index',
            'kategori_id' => Kategori::all(),
        ];
        // dd($data);
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data = [
            'title'   => ' Tambah Produk',
            'kategori' => kategori::get(),
            'content' => 'admin/produk/create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'name' => 'required',
            'kategori_id' => 'required',
            'harga' => 'required',
            'stok' => 'required',

        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $file_name = time() . "_" . $gambar->getClientOriginalName();

            $storage = 'uploads/images/';
            $gambar->move($storage, $file_name);
            $data['gambar'] = $storage . $file_name;
        } else {
            $data['gambar'] = null;
        }

        Produk::create($data);
        Alert::success('suskses', 'Data Berhasil Ditambahkan');
        return redirect('admin/produk');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = [
            'title'   => ' Tambah Produk',
            'produk' => Produk::find($id),
            'kategori' => kategori::get(),
            'content' => 'admin/produk/create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $produk = Produk::find($id);
        $data = $request->validate([
            'name' => 'required',
            'kategori_id' => 'required',
            'harga' => 'required',
            'stok' => 'required',

        ]);
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $file_name = time() . "_" . $gambar->getClientOriginalName();

            $storage = 'uploads/images/';
            $gambar->move($storage, $file_name);
            $data['gambar'] = $storage . $file_name;
        } else {
            $data['gambar'] = $produk->gambar;
        }

        $produk->update($data);
        Alert::success('suskses', 'Data Berhasil DiEdit');
        return redirect('admin/produk');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $produk = Produk::find($id);

        if ($produk->gambar != null) {
            unlink($produk->gambar);
        }
        $produk->delete();
        Alert::success('suskses', 'Data Berhasil DiHapus ');
        return redirect()->back();
    }
}
