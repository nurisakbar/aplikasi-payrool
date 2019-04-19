<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    protected $table="kehadiran";

    protected $fillable =['nik','tanggal_masuk','tanggal_pulang','kode_status_kehadiran'];
}
