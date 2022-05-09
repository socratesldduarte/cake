<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cake extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cakes';

    protected $fillable = ['name', 'weight', 'price', 'available', 'orders'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $casts = [
        'orders' => 'array'
    ];

}
