<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Hash;

class Application extends Model
{
    use HasFactory;
    protected $table = 'applications';
    protected $guarded = ['id'];
    protected $casts = ['modules' => 'array', 'modules_settings' => 'array', 'active' => 'boolean'];

    public function getPublicKeyAttribute()
    {
        return 'id_' . $this->id . '-version_' . $this->version_name . '-code_' . $this->version_code;
    }

    public function getPublicHashAttribute()
    {
        return $this->id . '|' . Hash::make($this->publicKey);
    }

    public static function getByHash(string $publicHash)
    {
        $explode =  explode('|', $publicHash);
        if (count($explode) !== 2) return;

        $id = $explode[0];
        $hash = $explode[1];
        $app = Application::find($id);
        if (!$app) return;
        if (Hash::check($app->publicKey, $hash)) return $app;
        return;
    }
}
