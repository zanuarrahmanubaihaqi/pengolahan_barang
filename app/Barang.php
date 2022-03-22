<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Barang extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'brg_id';
    public $guarded = [];

    public static function getDataBarang() {
        $data = DB::table('barang')
                    ->select('brg_id', 'brg_nama', 'brg_stok', 'a.lokasi_ket', 'b.satuan_ket', 'c.status_ket')
                    ->leftJoin('barang_lokasi as a', 'a.lokasi_id', '=', 'barang.brg_lokasi_id')
                    ->leftJoin('barang_satuan as b', 'b.satuan_id', '=', 'barang.brg_satuan_id')
                    ->leftJoin('barang_status as c', 'c.status_id', '=', 'barang.brg_status_id')
                    ->orderByDesc('brg_id')->get();
        return $data;
    }

    public static function getDataBarangById($id) {
        $data = DB::table('barang')
                    ->select('brg_id', 'brg_nama', 'brg_stok', 'a.lokasi_ket', 'b.satuan_ket', 'c.status_ket')
                    ->leftJoin('barang_lokasi as a', 'a.lokasi_id', '=', 'barang.brg_lokasi_id')
                    ->leftJoin('barang_satuan as b', 'b.satuan_id', '=', 'barang.brg_satuan_id')
                    ->leftJoin('barang_status as c', 'c.status_id', '=', 'barang.brg_status_id')
                    ->where('barang.brg_id', '=', $id)
                    ->orderByDesc('brg_id')->get();
        return $data;
    }

    public static function getBarangId($id) {
        $data = DB::table('barang')
                    ->select('brg_id', 'brg_satuan_id', 'brg_lokasi_id', 'brg_status_id')
                    ->where('brg_id', '=', $id)->get();
        return $data;
    }

    public static function checkForUdateStock($id, $stok) {
        $data = Barang::select('brg_stok')
                    ->where('brg_id', '=', $id)->first();
        if ($data->brg_stok >= $stok) {
            Barang::where('brg_id', '=', $id)
                ->update([
                    'brg_stok' => (int) $data->brg_stok - (int) $stok
                ]);
            return true;
        } else {
            return false;
        }
    }
}
