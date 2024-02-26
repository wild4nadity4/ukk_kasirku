<?php

namespace App\Http\Controllers;
use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Produk;
use Mpdf\Mpdf;
use Dompdf\Dompdf;
use Dompdf\Options;

class AdminTransaksiController extends Controller
{

    public function print_invoice(string $id){
        $transaksi = Transaksi::find($id);
        $transaksiDetails = TransaksiDetail::with('produk')->where('transaksi_id', $id)->get();
        $semuaTransaksi = TransaksiDetail::where('transaksi_id', $id)->get();
       $hasil = TransaksiDetail::find($id);
        
        // Memastikan transaksi ditemukan sebelum mencoba mengakses propertinya
        if($transaksi){
            // Mengambil nama kasir dari objek transaksi
            $namaKasir = $transaksi->kasir_nama;
            // Mengambil total dari objek transaksi
            $total = $transaksi->total;
        
            // Mengambil tanggal transaksi dari objek transaksi
            $tanggalTransaksi = $transaksi->created_at;
    
            // Mengambil subtotal dari detail transaksi berdasarkan ID
            $transaksiDetail = TransaksiDetail::find($id);
    
            // Memastikan detail transaksi ditemukan sebelum mencoba mengakses propertinya
            if($transaksiDetail){
                $subTotal = $transaksiDetail->subtotal;
                    // Mengambil Transaksi ID dari objek transaksiDetail
            $transaksiId = $transaksiDetail->transaksi_id;
    
            
        // Konfigurasi Dompdf
        $options = new Options();
        $options->set('isRemoteEnabled', true);
    
        
        // Inisialisasi Dompdf
        $dompdf = new Dompdf($options);
    
        // Load tampilan blade dan berikan data transaksi detail
        $html = view('invoice.invoice_pdf', compact('namaKasir', 'subTotal', 'tanggalTransaksi','semuaTransaksi','total','transaksiId','hasil'))->render();
    
        // Tambahkan konten ke PDF
        $dompdf->loadHtml($html);
    
        // Render PDF
        $dompdf->render();
    
        // Unduh PDF
        return $dompdf->stream('Invoice.pdf');
    
        }
    }
    
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data =  [
            'title' => 'Manajemen Transaksi',
            'transaksi' => Transaksi::orderBy('created_at', 'DESC')->paginate(10),
            'content' => '/admin/transaksi/index'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $data = [
            'user_id' => auth()->user()->id,
            'kasir_name' => auth()->user()->name,
            'total' => 0,
            'user_id' => 0
        ];

        $transaksi = Transaksi::create($data);
        return redirect('/kasir/transaksi/' . $transaksi->id . '/edit');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $produk = Produk::get();

        $produk_id = request('produk_id');
        $p_detail = Produk::find($produk_id);

        $transaksi_detail = TransaksiDetail::whereTransaksiId($id)->get();

        $act = request('act');
        $qty = request('qty');

        if ($act == 'min') {
            if ($qty <= 1) {
                $qty = 1;
            } else {
                $qty = $qty - 1;
            }
        } else {
            $qty = $qty + 1;
        }

        $subtotal = 0;
        if ($p_detail) {

            $subtotal = $qty * $p_detail->harga;
        }

        $transaksi = Transaksi::find($id);

        $dibayarkan = request('dibayarkan');
        $kembalian = $dibayarkan - $transaksi->total;

        $data =  [
            'title' => 'Tambah Transaksi',
            'produk' => $produk,
            'p_detail' => $p_detail,
            'qty' => $qty,
            'subtotal' => $subtotal,
            'transaksi_detail' => $transaksi_detail,
            'transaksi' => $transaksi,
            'kembalian' => $kembalian,
            'content' => '/admin/transaksi/create'
        ];
        return view('admin.layouts.wrapper', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->delete();

        Alert::success('Sukses', 'Transaksi berhasil dihapus!!');
        return redirect('/kasir/transaksi')->with('success', 'Data berhasil dihapus!!');
    }
}