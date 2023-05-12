<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\Barang;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function gettransaksi(Request $req)
    {
        $data_transaksi=Transaksi::
            join('data_pelanggan','data_pelanggan.id_pelanggan','=','data_transaksi.id_pelanggan')
        ->join('data_barang','data_barang.id','=','data_transaksi.id')
        ->orderBy('id_transaksi','desc')
        ->get();

        

        return Response()->json($data_transaksi);
    }
    public function getid_transaksi($id)
    {
        $dt_transaksi = Transaksi::where('id_transaksi', '=', $id)->get();
        return response()->json($dt_transaksi);
    }
    public function createtransaksi(Request $req) {
        $validate = Validator::make($req->all(), [
            'id_pelanggan' => 'required',
            'id' => 'required',
            'jumlah' => 'required',
            
        ]);
        if ($validate->fails()){
            return response()->json($validate->errors()->toJson());
        }
        $barang = Barang::findOrFail($req->get('id'));
        $barang->stok -= $req->get('jumlah'); // kurangi stok barang
        $barang->save(); // simpan perubahan stok barang ke database
        $save= Transaksi::create([
            'id_pelanggan' => $req->get('id_pelanggan'),
            'id' => $req->get('id'),
            'tgl_transaksi' => Carbon::now()->format('Y-m-d H:i:s'),
            'jumlah' => $req->get('jumlah'),
            'total' => $barang->harga * $req->get('jumlah'),


        ]);
        if ($save) {
            return Response()->json(['status' => true, 'message' => 'Sukses menambah data transaksi.']);
        }else {
            return Response()->json(['status' => false, 'message' => 'Gagal menambah data transaksi']);
        }
    }
    public function updatetransaksi(Request $req, $id)
{
    $validator = Validator::make($req->all(), [
        'id_pelanggan' => 'required',
        'id' => 'required',
        'jumlah' => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return Response()->json($validator->errors()->toJson());
    }
    
    $barang = Barang::find($req->get('id'));
    $barang->save(); // simpan perubahan stok barang ke database

    $total = $barang->harga * $req->get('jumlah');
    $ubah = Transaksi::where('id_transaksi', $id)->update([
        'id_pelanggan' => $req->get('id_pelanggan'),
        'id' => $req->get('id'),
        'jumlah' => $req->get('jumlah'),
        'total' => $total,
    ]);

    if ($ubah) {
        return Response()->json(['status' => true, 'message' => 'Sukses mengupdate data transaksi.']);
    } else {
        return Response()->json(['status' => false, 'message' => 'Gagal mengupdate data transaksi']);
    }
}

    public function deletetransaksi($id){
        $hapus= Transaksi::where('id_transaksi',$id)->delete();
        if($hapus){
            return Response()->json(['status' => true, 'message' => 'Sukses delete data transaksi.']);
        }else{
            return Response()->json(['status' => false, 'message' => 'Gagal delete data transaksi']);
        }
    }

}
