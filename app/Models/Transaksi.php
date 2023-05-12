<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'data_transaksi';
    protected $primarykey = 'id_transaksi';
    public $timestamps = 'false';
    public $fillable = ['id_pelanggan','id','tgl_transaksi','jumlah','total'];
}
