<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    protected $table="departemen";

    protected $primaryKey = "kode_departemen";

    public $incrementing = false;
}
