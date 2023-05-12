<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Barang;

class BarangController extends Controller
{
    public function getbarang()
    {
        $dt_barang = Barang::get();
        return response()->json($dt_barang);
    }
    public function getid($id)
    {
        $dt_barang = Barang::where('id', '=', $id)->get();
        return response()->json($dt_barang);
    }
    public function createbarang(Request $req)
    {
        $validate = Validator::make($req->all(), [
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'merk' => 'required',
            'harga' => 'required',
            'stok' => 'required'
        ]);
        if ($validate->fails()){
            return response()->json($validate->errors()->toJson());
        }
        $create = Barang::create([
            'kode_barang' => $req->kode_barang,
            'nama_barang' => $req->nama_barang,
            'merk' => $req->merk,
            'harga' => $req->harga,
            'stok' => $req->stok,
        ]);
        if ($create) {
            return response()->json(['status' => true, 'message' => 'Sukses menambah data barang.']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal menambah data barang']);
        }
    }
    public function updatebarang(Request $req, $id)
    {
        $validate = Validator::make($req->all(), [
            'kode_barang' => 'required',
            'nama_barang' => 'required',
            'merk' => 'required',
            'harga' => 'required',
            'stok' => 'required'

        ]);
        if ($validate->fails()){
            return response()->json($validate->errors()->toJson());
        }
        $update = Barang::where('id', $id)->update([
            'kode_barang' => $req->kode_barang,
            'nama_barang' => $req->nama_barang,
            'merk' => $req->merk,
            'harga' => $req->harga,
            'stok' => $req->stok,
        ]);
        if ($update) {
            return response()->json(['status' => true, 'message' => 'Sukses Merubah data barang.']);
        }else {
            return response()->json(['status' => false, 'message' => 'Gagal Merubah data barang.']);
        }
    }
    public function deletebarang($id)
    {
        $delete = Barang::where('id', $id)->delete();
        if ($delete) {
            return response()->json(['status' => true, 'message' => 'Sukses Menghapus data barang.']);
        }else {
            return response()->json(['status' => false, 'message' => 'Gagal Menghapus data barang.']);
        }
    }
}
