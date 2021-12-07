<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Absensi extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class, 'id_user','id');
    }

    protected $casts = [
    	'tanggal' => 'datetime:d/m/Y', 
	];
}
