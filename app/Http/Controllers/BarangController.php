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

class BarangController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $barang = Barang::getDataBarang();
    	
        return view('barang.index', compact('barang'));
    }

    public function getDataBarangById($id)
    {
    	$data = Barang::getDataBarangById($id);
        
        return $data;
    }
}