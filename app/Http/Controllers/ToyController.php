<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Toy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Symfony\Component\Console\Input\Input;

class ToyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toys = Toy::latest()->paginate(10);
        return view('admin.toys.index', compact('toys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcategories = Subcategory::orderBy('name','desc')->get();
        return view('admin.toys.create', compact('subcategories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:3|max:350',
            'price' => 'required|numeric',
            'subcategory_id' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|required'
        ], [], ['subcategory_id' => 'subcategory']);

        if ($request['for_sale'] == null) {
            $request['for_sale'] = 0;
        }
        $data = $request->all();
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('/storage/images/'), $imageName);
        $data['image'] = $imageName;

        Toy::create($data);

        return redirect()->route('admin.toys.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Toy  $toy
     * @return \Illuminate\Http\Response
     */
    public function show(Toy $toy)
    {
        $relatedToys = Toy::where('subcategory_id', $toy->subcategory->id)->take(6)->get();
        return view('toys.show', compact('toy', 'relatedToys'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Toy  $toy
     * @return \Illuminate\Http\Response
     */
    public function edit(Toy $toy)
    {
        $subcategories = Subcategory::orderBy('name','desc')->get();
        return view('admin.toys.edit', compact('toy', 'subcategories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Toy  $toy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Toy $toy)
    {
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'required|min:3',
            'price' => 'required|numeric',
            'subcategory_id' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|nullable'
        ], [], ['subcategory_id' => 'subcategory']);
        if ($request['for_sale'] == null) {
            $request['for_sale'] = 0;
        }
        $data = $request->all();
        if ($request->image) {
            File::delete(public_path('/storage/images/' . $toy->image));
            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('/storage/images/'), $imageName);
            $data['image'] = $imageName;
        }
        $toy->update($data);

        return redirect()->route('admin.toys.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Toy  $toy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Toy $toy)
    {
        if ($toy->image) {
            File::delete(public_path('/storage/images/' . $toy->image));
        }
        $toy->delete();
        return redirect()->route('admin.toys.index');
    }

    public function search(Request $request)
    {
        $products = Toy::where('name', 'like', $request->get('search') . '%')->paginate(20)->withQueryString();
        return view('search', compact('products', 'request'));
    }
    public function searchByCategoryandSubcategory(Request $request)
    {
        if ($request['subcategory']) {
            $products = Toy::leftjoin('categories', 'products.category_id', '=', 'categories.id')
                ->where('categories.name', '=', $request->get('search'));
            $products = $products->join('sub_categories', 'products.subcategory_id', '=', 'sub_categories.id')
                ->where('sub_categories.name', '=', $request->get('subcategory'))->select('products.*')->paginate(20)->withQueryString();
        } else {
            $products = Toy::join('categories', 'products.category_id', '=', 'categories.id')
                ->where('categories.name', '=', $request->get('search'))
                ->select('products.*')
                ->paginate(20)->withQueryString();
        }
        return view('search', compact('products', 'request'));
    }
}
