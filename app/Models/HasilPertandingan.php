<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPertandingan extends Model
{
    use HasFactory;

    protected $table = 'hasil_pertandingans';

    protected $fillable = [
        'match_id',
        'arsenal',
        'point_a',
        'chelsea' ,
        'point_c',
    ];
}
