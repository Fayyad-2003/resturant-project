<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\CheckoutRequest;
use App\Models\Advertisement;
use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Chef;
use App\Models\Counter;
use App\Models\Product;
use App\Models\SectionTitle;
use App\Models\Slider;
use App\Models\Testimonial;
use App\Models\WhyChooseUs;
use App\Models\Wishlist;
use App\Services\PaymentService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FrontnendController extends Controller
{
    public function index(): View
    {
        $userId = Auth::id();
        $sliders = Slider::where('status', 1)->get();
        $sectionsTitles = $this->getSectionsTitles();
        $whyChooseUs = WhyChooseUs::where('status', 1)->get();
        $categories = Category::where('status', 1)->where('show_at_home', 1)->get();
        $products = Product::where('status', 1)->with(['category', 'sizes', 'options'])->latest()->take(12)->get();

        $wishlists = Wishlist::with('model')->where('user_id', $userId)->latest()->get();
        $latestBlogs = BlogPost::with(['category', 'user'])->where('status', 1)->latest()->take(3)->get();
        $chefs = Chef::where('status', 1)->where('show_at_home', 1)->get();
        $dailyOffers = Product::with(['category', 'sizes', 'options'])
            ->where('status', 1)
            ->whereNotNull('offer_price')
            ->where('offer_price', '>', 0)
            ->latest()
            ->take(10)
            ->get();
        $advertisements = Advertisement::where('status', 1)->latest()->get();
        $counters = Counter::where('status', 1)->take(4)->get();
        $testimonials = Testimonial::where('status', 1)->latest()->get();

        return view('frontend.pages.home.index', compact(
            'sliders',
            'sectionsTitles',
            'whyChooseUs',
            'categories',
            'products',
            'wishlists',
            'latestBlogs',
            'chefs',
            'dailyOffers',
            'advertisements',
            'counters',
            'testimonials'
        ));
    }

    /**
     * Display about us page.
     */
    public function about(): View
    {
        $whyChooseUs = WhyChooseUs::where('status', 1)->get();
        $chefs = Chef::where('status', 1)->where('show_at_home', 1)->get();
        $counters = Counter::where('status', 1)->take(4)->get();
        $testimonials = Testimonial::where('status', 1)->latest()->get();

        return view('frontend.pages.about.index', compact(
            'whyChooseUs',
            'chefs',
            'counters',
            'testimonials'
        ));
    }

    /**
     * Display listing of chefs page.
     */
    public function chefs(): View
    {
        $chefs = Chef::where('status', 1)->paginate(12);
        return view('frontend.pages.chefs.index', compact('chefs'));
    }

    /**
     * Load product quick view modal via AJAX.
     */

    public function productQuickView(?string $id = null)
    {
        $productId = $id ?? request('id');
        $product = Product::with(['sizes', 'options'])->findOrFail($productId);
        return view('frontend.layouts.product-quick-view', compact('product'))->render();
    }

    public function checkout()
    {
        if (Cart::content()->count() > 0 || (float) str_replace(',', '', Cart::total()) > 0) {
            $alldivisions = DB::table('divisions')->where('status', '1')->orderBy('name', 'asc')->get();
            return view('frontend.pages.checkout.index', compact('alldivisions'));
        } else {
            toastr()->warning('Your cart is empty!');
            return to_route('home');
        }
    }

    public function checkoutContent()
    {
        return view('frontend.layouts.partials.checkout-content')->render();
    }

    public function selectDistrict(Request $request)
    {
        $districts = DB::table('districts')->where('division_id', $request->division_id)->where('status', '1')->get();
        return response()->json($districts);
    }

    public function selectState(Request $request)
    {
        $states = DB::table('upazilas')->where('district_id', $request->district_id)->where('status', '1')->get();
        return response()->json($states);
    }

    public function getDeliveryCharge(Request $request)
    {
        $division = DB::table('divisions')->where('id', $request->division_id)->first();
        $charge = $division ? (float) $division->delivery_fee : 0;

        if (Session::has('coupon')) {
            $totalPrice = (float) session()->get('coupon')['coupon_discount_amount'];
        } else {
            $totalPrice = (float) Cart::total();
        }

        return response()->json([
            'delivery_charge' => $charge,
            'totalprice' => $totalPrice,
            'finaltotalprice' => round($totalPrice + $charge, 2),
            'finalTotalPrice' => round($totalPrice + $charge, 2)
        ]);
    }

    public function checkoutStore(CheckoutRequest $request, PaymentService $paymentService)
    {
        $type = $request->payment_method == 'cash on delivery' ? 'offline' : 'online';

        Session::put('billing_data', [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_id' => $request->state_id,
            'address' => $request->address,
            'post_code' => $request->post_code,
            'notes' => $request->notes,
            'payment_method' => $request->payment_method,
            'payment_type' => $type,
            'delivery_charge' => $request->delivery_charge_input ?? 0,
            'total_amount' => $request->final_total_input ?? Cart::total(),
        ]);

        if ($request->payment_method == 'cash on delivery') {
            $paymentService->orderStore();
            toastr()->success('Order Completed successfully!');
            return redirect()->route('home');
        } elseif ($request->payment_method == 'paypal') {
            return redirect()->route('paypal.payment');
        } elseif ($request->payment_method == 'stripe') {
            return redirect()->route('stripe.payment');
        }
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

    /**
     * Show product details and its reviews
     */

    public function productDetails(string $slug)
    {
        $product = Product::with(['category', 'sizes', 'options', 'gallery', 'reviews.user'])
            ->withCount([
                'reviews as active_reviews_count' => function ($q) {
                    $q->where('status', 'active');
                }
            ])->withAvg([
                    'reviews as active_reviews_avg' => function ($q) {
                        $q->where('status', 'active');
                    }
                ], 'rating')->where('slug', $slug)->where('status', 1)->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->where('status', 1)->take(4)->get();
        $reviews = $product->reviews()->where('status', 'active')->with('user')->latest()->get();

        return view('frontend.pages.product-details.index', compact('product', 'relatedProducts', 'reviews'));
    }

    /**
     * Display shop / food menu catalog page.
     */

    public function shop(Request $request)
    {
        $query = Product::with(['category', 'sizes', 'options', 'reviews'])->where('status', 1);
        // Filter by Category slug

        if ($request->filled('category')) {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Search by product name or description
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('short_description', 'like', '%' . $request->search . '%');
            });
        }

        // Sort order
        if ($request->input('sort') === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->input('sort') === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::where('status', 1)->get();

        return view('frontend.pages.shop.index', compact('products', 'categories'));
    }
}
