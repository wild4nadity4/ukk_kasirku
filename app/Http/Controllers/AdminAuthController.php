<?php

namespace App\Http\Controllers;

use App\Models\kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminAuthController extends Controller
{
    //
    function index()
    {
        return view('admin.auth.login');
    }

    function dologin(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required'

        ]);

        if (Auth::attempt($data)) {
            if (Auth::user()->role == 'admin') {
                return redirect('admin/kategori');
            } elseif (Auth::user()->role == 'pengguna') {
                return redirect('kasir/transaksi');
            }
        } else {
            // Jika login gagal, redirect ke halaman login dengan pesan error
            return back()->with('loginError', 'Email atau password salah');
        }
    }

    public function logout()
    {
        Auth::logout();
        Alert::error('Logout', 'Anda Berhasil Log out');
        return redirect()->route('login');
    }

    public function dashboard()
    {
        $totalUsers = User::count();
        $totalProduk = Produk::count();
        $totalKategori = kategori::count();

        $totalPenjualan = Transaksi::sum('total');
        return view('dashboard', compact('totalUsers', 'totalProduk', 'totalPenjualan', 'totalKategori'));
    }

    public function register()
    {
        return view('admin.auth.register');
    }

    public function register_proses(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        $data['name'] = $request->nama;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);

        User::create($data);

        $login = [
            'email' => $request->email,
            'password' =>$request->password
        ];

        if(Auth::attempt($data)) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('login')->with('failed', 'Email atau Password Salah');
        }
    }
    public function showLoginForm()
    {
        
    
     return view('admin.auth.login');
    }
}
