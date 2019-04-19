<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KelompokGaji extends Model
{
    protected $table="kelompok_gaji";

    protected $primaryKey = "kode_kelompok_gaji";

    public $incrementing = false;
}
