<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Talep extends Model
{
    use HasFactory;


    protected $table = 'talep';

    protected $fillable = [
        'name',
        'email',
        'type',
        'title',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
