<?php

namespace App\Http\Controllers;

use App\Services\SolarCalculationService;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use App\Models\StaticContent;
use App\Models\ContactUs;
use App\Models\Blog;
use App\Models\Citie;
use App\Models\Countrie;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\State;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $states = [];
        $categories = ProductCategory::get();
        $blogs = Blog::with('category')
            ->where(function ($query) {
                $query->where('status', 'publish')
                    ->orWhere(function ($q) {
                        $q->where('status', 'schedule')
                            ->where('publish_datetime', '<=', now());
                    });
            })
            ->latest()
            ->limit(3)
            ->get();
        $products = Product::with('category')->latest()->limit(4)->get();
        return view('front.index', compact('states', 'categories', 'blogs', 'products'));
    }
    public function aboutUs()
    {
        return view('front.about-us');
    }
    public function serviceDetails()
    {
        return view('front.service-details');
    }
    public function shop(Request $request)
    {
        $categories = ProductCategory::get();

        $productsQuery = Product::with('category');

        if ($request->filled('search')) {
            $productsQuery->where('name', 'LIKE', '%' . $request->search . '%');
        }
        if ($request->filled('category')) {
            $category = ProductCategory::where('slug', $request->category)->first();

            if ($category) {
                $productsQuery->where('category_id', $category->id);
            }
        }
        $products = $productsQuery->paginate(6)->withQueryString();

        return view('front.shop', compact('categories', 'products'));
    }


    // public function shopDetails()
    // {
    //     return view('front.shop-details');
    // }
    public function shopDetails($slug,)
    {

        if (!Auth::check()) {
            return redirect('/login');
        }
        $parent = Product::with([
            'variations.variationType',
            'variations.variationValue',
        ])->where('slug', $slug)->firstOrFail();

        $parentVariations = $parent->variations;

        if ($parent->children->count() > 0) {
            $product = $parent->children;
        } else {
            $product = collect([$parent]);
        }

        $countrie = Countrie::orderBy('name', 'asc')->get();
        $country_id = 101;

        $states = State::where('country_id', $country_id)->orderBy('name', 'asc')->get();
    $cities = Citie::whereIn('state_id', $states->pluck('id'))->orderBy('name', 'asc')->get();

        return view('front.shop-details', compact(
            'product',
            'parentVariations',
            'countrie',
            'country_id',
            'states',
            'cities'
        ));
    }
    public function static_content()
    {
        $routeName = Route::currentRouteName();

        $data = StaticContent::where('type', $routeName)->first();
        if (!$data) {
            return back();
        } else {
            return view('front.static_content', compact('data'));
        }
    }


    public function blogs(Request $request)
    {
        $data = Blog::with('category')
            ->where(function ($query) {
                $query->where('status', 'publish')
                    ->orWhere(function ($q) {
                        $q->where('status', 'schedule')
                            ->where('publish_datetime', '<=', now());
                    });
            })
            ->latest()
            ->paginate(6);

        return view('front.blog-list', compact('data'));
    }
    public function blogDetail()
    {
        return view('front.blog-details');
    }


    public function blogDetails($slug)
    {
        $blog = Blog::with('category')
            ->where(function ($query) {
                $query->where('status', 'publish')
                    ->orWhere(function ($q) {
                        $q->where('status', 'schedule')
                            ->where('publish_datetime', '<=', now());
                    });
            })->where('slug', $slug)->first();

        $data = Blog::with('category')
            ->where(function ($query) {
                $query->where('status', 'publish')
                    ->orWhere(function ($q) {
                        $q->where('status', 'schedule')
                            ->where('publish_datetime', '<=', now());
                    });
            })->where('category_id', $blog->category_id)
            ->latest()
            ->paginate(6);
        $category = DB::table('categories')->get();

        return view('front.blog-details', compact('blog', 'data', 'category'));
    }

    public function ourServices()
    {
        $data = ProductCategory::get();
        return view('front.services', compact('data'));
    }


    public function ourProjects()
    {
        return view('front.projects');
    }


    public function faq()
    {
        return view('front.contact-us');
    }

    public function contactUs()
    {
        return view('front.contact-us');
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:100',
            'phone'         => 'required',
            'email'         => 'required|email',
            'subject'       => 'required|string|max:191',
            'message'       => 'required|string|max:10000'
        ]);


        ContactUs::create([
            'name'    => $request->name,
            'phone'   => $request->phone,
            'email'   => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        return back()->with('success', 'Your message has been submitted successfully!');
    }


    // public function saveCalculation(Request $request)
    // {
    //     $calculation = Calculation::create([
    //         'category' => $request->category,
    //         'monthly_consumption' => $request->monthly_consumption,
    //         'system_capacity' => $request->system_capacity,
    //         'installation_cost' => $request->installation_cost,
    //         'monthly_savings' => $request->monthly_savings,
    //         'payback_period' => $request->payback_period,
    //         'state_id' => $request->state_id,
    //         'ip_address' => $request->ip(),
    //     ]);

    //     return response()->json(['success' => true, 'id' => $calculation->id]);
    // }
}