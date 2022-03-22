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

class LokasiController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $lokasi = BarangLokasi::all();
    	return view('lokasi.index', compact('lokasi'));
    }

    public function tambah(Request $request)
    {
    	dd($request);
    }
}