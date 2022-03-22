<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangLokasi extends Model
{
    protected $table = 'barang_lokasi';
    protected $primaryKey = 'lokasi_id';
    public $guarded = [];
    public $timestamps = false;
}
