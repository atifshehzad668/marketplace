<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Category;
use App\Models\City;
use App\Models\ListingImage;
use Illuminate\Http\Request;
use App\Models\PointTransaction;
use App\Models\Region;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ListingController extends Controller
{



    // public function get_listings(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $query = Listing::query()
    //             ->with(['user', 'category', 'images' => function ($query) {
    //                 $query->where('is_main', true);
    //             }]);

    //         return Datatables::of($query)
    //             ->addIndexColumn()
    //             ->addColumn('images', function ($row) {
    //                 return $row->images->isNotEmpty()
    //                     ? '<img src="' . asset('storage/' . $row->images->first()->image_url) . '" alt="Main Image" style="width: 80px; height: auto;">'
    //                     : 'No image';
    //             })
    //             ->addColumn('action', function ($row) {
    //                 $editUrl = route('listings.edit', $row->id);
    //                 $deleteUrl = route('listings.destroy', $row->id);

    //                 return '<div class="dropdown">
    //                         <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
    //                             <i class="bx bx-dots-vertical-rounded"></i>
    //                         </button>
    //                         <div class="dropdown-menu">
    //                             <a class="dropdown-item" href="' . $editUrl . '">
    //                                 <i class="bx bx-edit-alt me-1"></i> Edit
    //                             </a>
    //                             <form action="' . $deleteUrl . '" method="POST" style="display: inline;">
    //                                 ' . csrf_field() . '
    //                                 ' . method_field('DELETE') . '
    //                                 <button type="submit" class="dropdown-item" onclick="return confirm(\'Are you sure you want to delete this item?\')">
    //                                     <i class="bx bx-trash me-1"></i> Delete
    //                                 </button>
    //                             </form>
    //                         </div>
    //                     </div>';
    //             })
    //             ->rawColumns(['images', 'action'])
    //             ->make(true);
    //     }
    //     return view('listings.index');
    // }











    public function index()
    {
        $listings = Listing::with(['images' => function ($query) {
            $query->where('is_main', true);
        }])
            ->where('user_id', Auth::id())->paginate(10);

        return view('listings.index', compact('listings'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $cities = City::all();
        $regions = Region::all();
        return view('listings.create', get_defined_vars());
    }
    public function getRegionsByCity(Request $request)
    {
        $cityId = $request->get('city_id');
        $regions = Region::where('city_id', $cityId)->get(['id', 'region_name']);

        return response()->json($regions);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input data
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'headline' => 'required|string|max:255',
            'city_id' => 'required|exists:cities,id',
            'region_id' => 'required|exists:regions,id',
            'description' => 'required|string',
            // 'quantity' => 'required|integer|min:1',
            'price' => 'required|integer',
            'expiration_date' => 'required|date',
        ]);


        $listing = Listing::create([
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'city_id' => $request->city_id,
            'region_id' => $request->region_id,
            'headline' => $request->headline,
            'description' => $request->description,
            // 'quantity' => $request->quantity,
            'price' => $request->price,
            'expiration_date' => $request->expiration_date,
        ]);

        // Update user points and create point transaction
        $userId = Auth::id();
        DB::table('users')->where('id', $userId)->increment('points_balance', 1);

        PointTransaction::create([
            'seller_id' => $userId,
            'buyer_id' => null,
            'listing_id' => $listing->id,
            'order_id' => null,
            'description' => 'Listing point',
            'type' => 'bonus',
        ]);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $fileName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('images/listings', $fileName, 'public');

                ListingImage::create([
                    'listing_id' => $listing->id,
                    'image_url' => $imagePath,
                    'is_main' => $index === 0,
                ]);
            }
        }

        return redirect()->route('listings.index')->with('success', 'Listing created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $listing = Listing::findOrFail($id);
        $categories = Category::all(); // Assuming you have a Category model

        return view('listings.edit', compact('listing', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'headline' => 'required|string|max:255',
        ]);


        $listing = Listing::findOrFail($id);
        $listing->update([
            'category_id' => $request->category_id,
            'headline' => $request->headline,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'expiration_date' => $request->expiration_date,
        ]);


        foreach ($listing->images as $image) {
            Storage::disk('public')->delete($image->image_url);
            $image->delete();
        }


        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {

                $fileName = time() . '_' . $image->getClientOriginalName();
                $imagePath = $image->storeAs('images/listings', $fileName, 'public');


                ListingImage::create([
                    'listing_id' => $listing->id,
                    'image_url' => $imagePath,
                    'is_main' => $index === 0,
                ]);
            }
        }

        return redirect()->route('listings.index')->with('success', 'Listing updated successfully!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $listing = Listing::findOrFail($id);

        //
        $images = ListingImage::where('listing_id', $listing->id)->get();


        foreach ($images as $image) {
            Storage::disk('public')->delete($image->image_url);
            $image->delete();
        }


        $listing->delete();

        return redirect()->route('listings.index')->with('success', 'Listing Deleted Successfully');
    }
    public function show($id)
    {
        $listing = Listing::findOrFail($id);
        $images = ListingImage::where('listing_id', $listing->id)->get();
        return view('listings.show', get_defined_vars());
    }
}