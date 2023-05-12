<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = 'data_pelanggan';
    protected $primarykey = 'id_pelanggan';
    public $timestamps = 'false';
    public $fillable = ['nama','alamat','no_tlp'];
}
