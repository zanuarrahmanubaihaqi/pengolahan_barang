<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Departemen extends Model
{
    protected $table = 'departemen';
    protected $primaryKey = 'dept_id';
    public $guarded = [];
    public $timestamps = false;
}
