<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    /**
     * Store customer submitted testimonial
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'details' => ['required', 'string', 'max:1000'],
            'designation' => ['nullable', 'string', 'max:100'],
        ]);

        $user = Auth::user();

        Testimonial::create([
            'user_id' => $user->id,
            'name' => $user->name,
            'image' => $user->avatar ?: 'frontend/images/client_img_1.jpg',
            'designation' => $request->filled('designation') ? $request->designation : 'Valued Customer',
            'details' => $request->details,
            'rating' => $request->rating,
            'show_at_home' => 1,
            'status' => 1,
        ]);

        toastr()->success('Thank you for your feedback! Your testimonial has been posted successfully.');
        return redirect()->back();
    }
}

