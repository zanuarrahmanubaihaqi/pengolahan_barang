<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BarangStatus extends Model
{
    protected $table = 'barang_status';
    protected $primaryKey = 'status_id';
    public $guarded = [];
}
