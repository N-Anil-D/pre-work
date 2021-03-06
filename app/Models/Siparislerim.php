<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siparislerim extends Model
{
    use HasFactory;

    protected $table = 'siparislerim';


    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function urun()
    {
        return $this->belongsTo(Urunler::class,'product_id','id');
    }
}
