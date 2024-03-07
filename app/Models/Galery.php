<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Galery extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // public function galeries()
    // {
    //     return $this->hasMany(Galery::class, 'id_user', 'id');
    // }
}
