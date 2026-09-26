<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SectionTitle;
use App\Models\Slider;
use App\Models\WhyChooseUs;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class FrontnendController extends Controller
{
    public function index(): View
    {
        $sliders = Slider::where('status', 1)->get();
        $sectionsTitles = $this->getSectionsTitles();
        $whyChooseUs = WhyChooseUs::where('status', 1)->get();
        return view('frontend.pages.home.index', compact('sliders', 'sectionsTitles', 'whyChooseUs'));
    }

    private function getSectionsTitles(): Collection
    {
        $keys = [
            'why_choose_us_top_title',
            'why_choose_us_main_title',
            'why_choose_us_sub_title'
        ];

        return SectionTitle::whereIn('key', $keys)->pluck('value', 'key');
    }
}
