<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table="karyawan";

    protected $primaryKey = "nik";

    public $incrementing = false;
}
