<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AdminKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //die('masuk');
        $data =[
            'title'   => 'Manajemen Kategori',
            'kategori'   => kategori::paginate(10),
            'content' => 'admin/kategori/index'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data =[
            'title'   => ' Tambah Kategori',
            'content' => 'admin/kategori/create'
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
            'name' => 'required|unique:kategoris'

        ]);
        kategori::create($data);
        Alert::success('suskses','Data Berhasil Ditambahkan');
        return redirect('admin/kategori');
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
        $data =[
            'title'   => ' Tambah Kategori',
            'kategori' => kategori::find($id),
            'content' => 'admin/kategori/create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $kategori= kategori::find($id);
        $data = $request->validate([
            'name' => 'required|unique:kategoris,name,' . $kategori->id

        ]);
        $kategori->update($data);
        Alert::success('suskses','Data Berhasil DiEdit');
        return redirect('admin/kategori');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $kategori= kategori::find($id);
        $kategori->delete();
        Alert::success('suskses','Data Berhasil DiHapus ');
        return redirect()->back();

    }
}
