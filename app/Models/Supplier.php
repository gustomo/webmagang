<?php

// app/Models/Supplier.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'tb_supplier';
    protected $primaryKey = 'id_sp';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_sp', 'nama_supplier', 'alamat', 'kontak', 'foto'
    ];
}


