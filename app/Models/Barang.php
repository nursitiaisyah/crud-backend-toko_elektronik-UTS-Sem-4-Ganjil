<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'data_barang';
    protected $primarykey = 'id';
    public $timestamps = 'false';
    public $fillable = ['kode_barang','nama_barang','merk','harga','stok'];
}
