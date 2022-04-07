<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Order extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'order_id';
    public $guarded = [];

    public static function getOrderData() {
        $data = DB::table('order')
                ->select('order_id', 'a.name', 'a.nik', 'e.dept_name', 'b.brg_nama', 'b.brg_stok', 'c.satuan_ket', 'd.lokasi_kode', 'd.lokasi_ket')
                ->leftJoin('users as a', 'a.id', '=', 'order.order_user_id')
                ->leftJoin('barang as b', 'b.brg_id', '=', 'order.order_brg_id')
                ->leftJoin('barang_satuan as c', 'c.satuan_id', '=', 'b.brg_satuan_id')
                ->leftJoin('barang_lokasi as d', 'd.lokasi_id', '=', 'b.brg_lokasi_id')
                ->leftJoin('departemen as e', 'e.dept_id' , '=', 'a.dept_id')
                ->orderByDesc('order_id')->get();
        return $data;
    }

    public static function getOrderDataById() {
        $data = DB::table('order')
                ->select('order_id', 'a.name', 'a.nik', 'e.dept_name', 'b.brg_nama', 'b.brg_stok', 'c.satuan_ket', 'd.lokasi_kode', 'd.lokasi_ket')
                ->leftJoin('users as a', 'a.id', '=', 'order.order_user_id')
                ->leftJoin('barang as b', 'b.brg_id', '=', 'order.order_brg_id')
                ->leftJoin('barang_satuan as c', 'c.satuan_id', '=', 'b.brg_satuan_id')
                ->leftJoin('barang_lokasi as d', 'd.lokasi_id', '=', 'b.brg_lokasi_id')
                ->leftJoin('departemen as e', 'e.dept_id' , '=', 'a.dept_id')
                ->orderByDesc('order_id')
                ->groupBy('order_id', 'a.name', 'a.nik', 'e.dept_name', 'b.brg_nama', 'b.brg_stok', 'c.satuan_ket', 'd.lokasi_kode', 'd.lokasi_ket')->get();
        return $data;
    }

    public static function getLastTransactionId() {
        $data = DB::table('order')
                ->select('order_id')
                ->groupBy('order_id')
                ->orderByDesc('order_id')
                ->first();
        return isset($data) ? $data->order_id : "000";   
    }

    public static function getLength($kode, $str_len) {
        switch ($kode) {
            case 1: // brg_id
                if ($str_len == 7) {
                    return -1;
                } else {
                    return -2;
                }
                break;

            case 2: // qty
                if ($str_len == 4) {
                    return -1;
                } else {
                    return -2;
                }
                break;
            
            default:
                return -1;
                break;
        }
    }

    public static function saveData($data)
    {
        $result = false;
        DB::beginTransaction();
        try {
            if (Order::create($data)) {
                $result = true;
            }
            DB::commit();
            return $result;
        } catch (QueryException $e) {
            DB::rollback();
            $get_last_id = Order::select('order_id')
                            ->orderByDesc('order_id')
                            ->first();
            if ($get_last_id != null) {
                $id = $get_last_id->order_id;
            } else {
                $id = 0;
            }
            $data['order_id'] = $id + 1;
            self::saveData($data);
            $result = false;
        }
    }
}
