<?php


namespace App\Traits;

use Illuminate\Http\Request;

trait FileUploadTrait
{
    function uploadImage(Request $request, string $input = '', $path = '/uploads')
    {
        if ($request->hasFile($input)) {
            $image = $request->$input;
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_' . uniqid() . '.' . $ext;
            $image->move(public_path($path), $imageName);

            return $path . '/' . $imageName;
        }
    }
}
