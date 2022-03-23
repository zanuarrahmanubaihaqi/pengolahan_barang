<?php

namespace App\Http\Controllers;

use App\User;
use App\Loging;
use App\Order;
use App\Barang;
use App\BarangLokasi;
use App\BarangSatuan;
use App\BarangStatus;
use App\Level;
use Illuminate\Http\Request;

class OrderController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = User::all();
        $order = Order::getOrderData();
        $barang = Barang::getDataBarang();
        $status = "";
    	return view('order.index', compact('order', 'barang', 'user'));
    }

    public function tambah(Request $request)
    {
        $initial_id = "O" . date('Ymd');
        $temp_id = (substr(Order::getLastTransactionId(), -3) * 1) + 1;
        $order_id = $initial_id . sprintf("%03s", $temp_id);
        $data = [[]];
        foreach ($request as $key => $value) {
            if ($key == "request") {
                foreach ($value as $keyv => $valuev) {
                    if (preg_match("/brg_id/", $keyv)) {
                        $data[substr($keyv, Order::getLength(1, strlen($keyv)))]['brg_id'] = $valuev;
                    }
                    if (preg_match("/qty/", $keyv)) {
                        $data[substr($keyv, Order::getLength(2, strlen($keyv)))]['qty'] = $valuev;
                    }
                }
            }
        }
        unset($data[0]);
        $data = array_values($data);
        $for_insert = [
            'order_id' => $order_id,
            'created_at' => $request->tgl_order,
            'order_user_id' => $request->user_id
        ];

        foreach ($data as $key => $value) {
            $for_insert['order_brg_id'] = $value['brg_id'];
            $for_insert['order_brg_satuan_id'] = Barang::getBarangId($value['brg_id'])[0]->brg_satuan_id;
            $for_insert['order_brg_lokasi_id'] = Barang::getBarangId($value['brg_id'])[0]->brg_lokasi_id;
            $for_insert['order_brg_jml'] = $value['qty'];

            /* chcek and or update stock */
            $status = "[FAILED]";
            if (Barang::checkForUdateStock($value['brg_id'], $value['qty'])) {
                if (Order::saveData($for_insert)) {
                    $status = "[SUCCESS]";
                }
            }
            /* eof chcek and or update stock */

            Loging::insert([
                'action' => $status . ' add data for order : ' . $order_id . ", by : " . $request->user_id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        return redirect()->route('order.index')->with('message', $status . ' add data for order : ' . $order_id);
    }
}