<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    public function getpelanggan()
    {
        $dt_pelanggan = Pelanggan::get();
        return response()->json($dt_pelanggan);
    }
    public function getid_pelanggan($id)
    {
        $dt_pelanggan = Pelanggan::where('id_pelanggan', '=', $id)->get();
        return response()->json($dt_pelanggan);
    }
    public function createpelanggan(Request $req)
    {
        $validate = Validator::make($req->all(), [
            'nama' => 'required',
            'alamat' => 'required',
            'no_tlp' => 'required'
        ]);
        if ($validate->fails()){
            return response()->json($validate->errors()->toJson());
        }
        $create = Pelanggan::create([
            'nama' => $req->nama,
            'alamat' => $req->alamat,
            'no_tlp' => $req->no_tlp
        ]);
        if ($create) {
            return response()->json(['status' => true, 'message' => 'Sukses menambah data pelanggan.']);
        } else {
            return response()->json(['status' => false, 'message' => 'Gagal menambah data pelanggan']);
        }
    }
    public function updatepelanggan(Request $req, $id)
    {
        $validate = Validator::make($req->all(), [
            'nama' => 'required',
            'alamat' => 'required',
            'no_tlp' => 'required'

        ]);
        if ($validate->fails()){
            return response()->json($validate->errors()->toJson());
        }
        $update = Pelanggan::where('id_pelanggan', $id)->update([
            'nama' => $req->nama,
            'alamat' => $req->alamat,
            'no_tlp' => $req->no_tlp
        ]);
        if ($update) {
            return response()->json(['status' => true, 'message' => 'Sukses Merubah data pelanggan.']);
        }else {
            return response()->json(['status' => false, 'message' => 'Gagal Merubah data pelanggan.']);
        }
    }
    public function deletepelanggan($id)
    {
        $delete = Pelanggan::where('id_pelanggan', $id)->delete();
        if ($delete) {
            return response()->json(['status' => true, 'message' => 'Sukses Menghapus data pelanggan.']);
        }else {
            return response()->json(['status' => false, 'message' => 'Gagal Menghapus data pelanggan.']);
        }
    }
}

