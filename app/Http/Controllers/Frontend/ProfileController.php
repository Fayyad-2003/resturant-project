<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ProfileUpdatePasswordRequest;
use App\Http\Requests\Frontend\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    function updateProfile(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        toastr('Profile updated successfully!', 'success');

        return redirect()->back();
    }

    public function updatePassword(ProfileUpdatePasswordRequest $request): RedirectResponse
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
