<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

trait FileUploadTrait
{
    function uploadImage(Request $request, string $input = '', $oldPath = null, $path = '/uploads')
    {
        try {
            if ($request->hasFile($input)) {
                $image = $request->file($input);

                // Check if file is valid
                if (!$image->isValid()) {
                    Log::error("Invalid file upload for input: $input");
                    return null;
                }

                $ext = $image->getClientOriginalExtension();
                $imageName = 'media_' . uniqid() . '.' . $ext;

                // Ensure upload directory exists
                $uploadPath = public_path($path);
                if (!File::isDirectory($uploadPath)) {
                    File::makeDirectory($uploadPath, 0755, true, true);
                }

                // Move the uploaded file
                $image->move($uploadPath, $imageName);

                // Delete previous file if it exists
                if ($oldPath && File::exists(public_path($oldPath))) {
                    File::delete(public_path($oldPath));
                }

                return $path . '/' . $imageName;
            }

            return null;
        } catch (\Exception $e) {
            Log::error("File upload failed for input $input: " . $e->getMessage());
            return null;
        }
    }

    // Remove File 
    function removeImage(string $imagePath): void
    {
        try {
            if ($imagePath && File::exists(public_path($imagePath))) {
                File::delete(public_path($imagePath));
            }
        } catch (\Exception $e) {
            Log::error("File deletion failed for path $imagePath: " . $e->getMessage());
        }
    }
}
