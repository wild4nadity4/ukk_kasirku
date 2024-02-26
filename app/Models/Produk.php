<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function transaksiDetails()
    {
        return $this->hasMany('App\Models\TransaksiDetail', 'produk_id');
    }
   
    use HasFactory;

    protected $guarded = [];
}
