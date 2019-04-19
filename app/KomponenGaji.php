<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KomponenGaji extends Model
{
    protected $table="komponen_gaji";

    protected $primaryKey = "kode_komponen";

    public $incrementing = false;
}
