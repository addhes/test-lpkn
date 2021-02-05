<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertandingan extends Model
{
    use HasFactory;

    protected $table = 'pertandingans';

    protected $fillable = [
        'arsenal',
        'score_a',
        'chelsea' ,
        'score_c',
    ];

    public function hasil() {
        return $this->hasOne('App\Models\HasilPertandaingan','match_id','id');
    }
}
