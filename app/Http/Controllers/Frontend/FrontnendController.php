<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
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
        $categories = Category::where('status', 1)->where('show_at_home', 1)->get();
        $products = Product::where('status', 1)->with(['category', 'sizes', 'options'])->latest()->take(12)->get();

        return view('frontend.pages.home.index', compact('sliders', 'sectionsTitles', 'whyChooseUs', 'categories', 'products'));
    }

    /**
     * Load product quick view modal via AJAX.
    */

    public function productQuickView(string $id = null){
        $productId = $id ?? request('id');
        $product = Product::with(['sizes', 'options'])->findOrFail($productId);
        return view('frontend.layouts.product-quick-view', compact('product'))->render();
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
