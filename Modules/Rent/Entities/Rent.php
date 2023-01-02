<?php

namespace Modules\Rent\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rent extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'rent_rents';
    protected $casts = ['address', 'array', 'open' => 'boolean'];

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
