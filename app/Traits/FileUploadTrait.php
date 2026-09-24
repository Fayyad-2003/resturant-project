<?php


namespace App\Traits;

use Illuminate\Http\Request;
use File;

trait FileUploadTrait
{
    function uploadImage(Request $request, string $input = '', $oldPath = null, $path = '/uploads')
    {
        if ($request->hasFile($input)) {

            $image = $request->$input;
            $ext = $image->getClientOriginalExtension();
            $imageName = 'media_' . uniqid() . '.' . $ext;
            $image->move(public_path($path), $imageName);

            // delete previous file if exist
            if ($oldPath && File::exists(public_path($oldPath))) {
                File::delete(public_path($oldPath));
            }

            return $path . '/' . $imageName;
        }
    }
}
