<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use App\Http\Requests\Admin\UpdatePasswordRequest;
use App\Traits\FileUploadTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class ProfileController extends Controller
{
    //

    use FileUploadTrait;

    function index(): View
    {
        return view('admin.profile.index');
    }

    function updateProfile(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();

        // Handle avatar upload
        $imagePath = $this->uploadImage($request, 'avatar');

        $user->name = $request->name;
        $user->email = $request->email;
        $user->avatar = $imagePath;
        $user->save();

        toastr('Profile Updated Successfully', 'success');
        return redirect()->back();
    }

    function updatePassword(UpdatePasswordRequest $request): RedirectResponse
    {
        $user = Auth::user();

        // Verify current password
        if (!Hash::check($request->current_password, $user->password)) {
            toastr()->error('Current password is incorrect');
            return redirect()->back();
        }

        // Update password
        $user->password = Hash::make($request->password);
        $user->save();

        toastr()->success('Password Updated Successfully');
        return redirect()->back();
    }
}
