<?php

namespace Modules\Rent\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rent extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'rent_rents';
    protected $casts = ['address', 'array', 'open' => 'boolean'];
}
