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
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\State;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    protected $solarService;

    public function __construct(SolarCalculationService $solarService)
    {
        // $this->middleware('auth');
        $this->solarService = $solarService;
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


    public function shopDetails()
    {
        return view('front.shop-details');
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


    public function calculate(Request $request)
    {
        $validated = $request->validate([
            'category' => 'required|in:residential,commercial,industrial',
            'monthly_bill' => 'nullable|numeric|min:0',
            'monthly_consumption' => 'nullable|numeric|min:0',
            'rooftop_area' => 'nullable|numeric|min:0',
            'desired_capacity' => 'nullable|numeric|min:0',
            'state' => 'required|exists:states,id',
            'panel_wattage' => 'required|in:330,550,600',
            'consumer_type' => 'nullable|in:commercial,industrial',
        ]);

        $state = State::find($validated['state']);

        $result = match ($validated['category']) {
            'residential' => $this->solarService->calculateResidential($validated, $state),
            'commercial' => $this->solarService->calculateCommercial($validated, $state),
            'industrial' => $this->solarService->calculateIndustrial($validated, $state),
        };

        return response()->json($result);
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
