<?php

namespace App\Http\Controllers;

use App\Models\TransaksiDetail;
use App\Models\Transaksi;
use App\Models\Produk;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class AdminTransaksiDetailController extends Controller
{
  function create(Request $request)
  {
      $produk_id = $request->produk_id;
      $transaksi_id = $request->transaksi_id;
      $qty = $request->qty;
      
      // Dapatkan data produk berdasarkan ID
      $produk = Produk::find($produk_id);
      
      // Periksa apakah stok mencukupi
      if ($produk->stok > 0) {
          // Jika stok masih tersedia
          if ($produk->stok >= $qty) {
              // Hitung subtotal transaksi
              $subtotal = $qty * $produk->harga;
              
              // Buat detail transaksi
              $transaksi_detail = TransaksiDetail::create([
                  'produk_id' => $produk_id,
                  'produk_name' => $produk->name,
                  'transaksi_id' => $transaksi_id,
                  'qty' => $qty,
                  'subtotal' => $subtotal,
              ]);
              
              // Kurangi stok produk
              $produk->stok -= $qty;
              $produk->save();
              
              // Update total transaksi
              $transaksi = Transaksi::find($transaksi_id);
              $transaksi->total += $subtotal;
              $transaksi->save();
              
              // Redirect kembali ke halaman transaksi
              return redirect('/kasir/transaksi/' . $transaksi_id . '/edit');
          } else {
              // Jika stok tidak mencukupi, tampilkan pesan dengan SweetAlert
              Alert::error('Error', 'Stok produk tidak mencukupi untuk jumlah yang diminta.');
              return redirect()->back();
          }
      } else {
          // Jika stok produk habis, tampilkan pesan flash session
          session()->flash('error', 'Produk sudah habis.');
          return redirect()->back();
      }
  }

  function delete()
  {
    $id = request('id');
    $td = TransaksiDetail::find($id);

    $transaksi = Transaksi::find($td->transaksi_id);
    $data = [
      'total' => $transaksi->total - $td->subtotal,
    ];
    $transaksi->update($data);

    $td->delete();
    return redirect()->back();
  }

  function done($id)
  {
    $transaksi = Transaksi::find($id);
    $data = [
      'status' => 'selesai'
    ];
    $transaksi->update($data);
    Alert::success('Sukses', 'Transaksi berhasil dibuat!!');
    return redirect('/kasir/transaksi');
  }
}