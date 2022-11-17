<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SoldToys;
use App\Models\Subcategory;
use App\Models\Toy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $toys = Toy::withCount('solds')->orderBy('solds_count', 'desc')->limit(6)->get();
        $trends = Subcategory::with('toys')->limit(6)->get();
        return view('home', compact('toys', 'trends'));
    }
    public function shop(Subcategory $subcategory = null)
    {
        $toys = $subcategory ? $subcategory->setRelation('toys', $subcategory->toys()->paginate(10))
            : Toy::withCount('solds')->orderBy('solds_count', 'desc')->paginate(10);
        return view('shop', compact('toys'));
    }
    public function search(Request $request)
    {
        $search = $request->get('search');
        $toys = Toy::where('name', 'like', '%' . $search . '%')->orderBy('name', 'desc')->paginate(10);
        return view('shop', compact('toys', 'search'));
    }
    public function dashboard()
    {
        $totalSales = Toy::withCount('solds')->get()->sum('solds_count');
        $totalAmount = SoldToys::sum('total_amount');
        $totalToys = Toy::count();
        $totalCustomers = User::count();
        $recentlyAdded = Toy::latest()->limit(5)->get();
        $bestsellers = Toy::withCount('solds')->orderBy('solds_count', 'desc')->limit(5)->get();
        return view('admin.dashboard', compact('recentlyAdded', 'bestsellers', 'totalSales', 'totalAmount', 'totalToys','totalCustomers'));
    }

    public function about()
    {
        return view('about');
    }
}
