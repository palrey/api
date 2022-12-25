<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as InterventionImage;

/**
 * HandleImage
 */
trait ImageHandler
{
    static public $image_default = [
        'avatar' => 'images/avatar.jpg',
        'default' => 'images/default.jpg',
        'rent_rooms' => 'images/rent_rooms.png',
        'shop_offers' => 'images/offer.png',
        'transport_car' => 'images/transport_car.png',
    ];

    static public function imageDefault($type = 'default')
    {
        if (!Storage::exists(self::$image_default[$type]))
            Storage::copy(public_path(self::$image_default[$type]), self::$image_default[$type]);
        return self::$image_default[$type];
    }

    /**
     * imageDelete
     * @param string $image
     */
    static public function imageDelete(string $image): bool
    {
        return $image === self::$image_default['default']
            || $image === self::$image_default['rent_rooms']
            || $image === self::$image_default['shop_offers']
            || $image === self::$image_default['transport_car']
            || $image === self::$image_default['avatar']
            ? true
            : Storage::exists($image) && Storage::delete($image);
    }
    /**
     * imageUpload
     * @param string $dir
     * @param Request $request
     * @param string $field
     * @param int $resize
     * @return string|null
     */
    static public function imageUpload(string $dir, Request $request, string $field = 'image', int $resize = 480)
    {
        if ($request->hasFile($field) && $request->file($field)->isValid()) {
            $image = $request->file($field);
            $filename =  sha1($image->getClientOriginalName() . '_' . time()) . '.jpg';

            $storage_path = '/' . $dir;
            $image_storage_path = $storage_path . '/' . $filename;
            if (!Storage::exists($storage_path))
                Storage::makeDirectory($storage_path);
            if (!Storage::exists($image_storage_path))
                Storage::put($image_storage_path, '');
            try {
                InterventionImage::make($image)
                    ->resize($resize, null, function ($constraints) {
                        $constraints->aspectRatio();
                    })->save(storage_path('/app/public' . $image_storage_path));
                return $image_storage_path;
            } catch (\Throwable $th) {
                Log::error($th);
            }
        }
        return self::$image_default[$dir];
    }
}
