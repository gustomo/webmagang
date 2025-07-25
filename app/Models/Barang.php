<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'tb_barang';
    protected $primaryKey = 'id_brg';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_brg', 'nama_barang', 'satuan', 'isi','stok','gambar'
    ];
}
