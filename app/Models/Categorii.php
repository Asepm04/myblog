<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorii extends Model
{
    protected $table = 'categoriess'; //nama tablenya
    protected $primarykey  ='Nik';  //unique id
    protected $keytype = 'string'; //tipe dari primarykey
    public $incrementing = false; //false karena tipe string tidak autoincrement
    public $timestamps = false; //false jika tidak digunakan
}
