<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangSatuan extends Model
{
    protected $table = 'barang_satuan';
    protected $primaryKey = 'satuan_id';
    public $guarded = [];
    public $timestamps = false;
}
