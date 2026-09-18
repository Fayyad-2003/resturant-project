<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class FrontnendController extends Controller
{
    public function index(): View
    {
        return view('frontend.pages.home.index');
    }
}
