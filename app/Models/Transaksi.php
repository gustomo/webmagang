<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'tb_transaksi';
    protected $primaryKey = 'id_transaksi';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_transaksi',
        'id_sp', // foreign key ke supplier
        'tanggal_transaksi',
        'total_harga'
    ];

    /**
     * Relasi ke Supplier
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_sp', 'id_sp');
    }

    /**
     * Relasi ke Barang (many-to-many melalui tabel pivot transaksi_barang)
     */
    public function barang()
    {
        return $this->belongsToMany(Barang::class, 'transaksi_barang', 'id_transaksi', 'id_brg')
                    ->withPivot('jumlah', 'satuan', 'harga', 'subtotal');
    }
}