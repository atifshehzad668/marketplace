<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegionController extends Controller
{
    public function index()
    {

        $regions = Region::orderBy('created_at', 'DESC')->paginate(25);
        return view('region.list', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::all();
        return view('region.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'region_name' => 'required',
            'city_id' => 'required',


        ]);

        $data = $request->all();

        $Region = Region::create($data);
        return redirect()->route('regions.index')->with('success', 'Region Added Successfully!');
    }
    /**
     * Display the specified resource.
     */
    public function show(Region $Region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {

        $region = Region::findOrFail($id);
        $cities = City::all();
        return view('region.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'region_name' => 'required',
            'city_id' => 'required',
        ]);
        $Region = Region::findOrFail($id);

        $Region->city_id = $request->city_id;
        $Region->region_name = $request->region_name;
        $Region->save();

        return redirect()->route('regions.index')->with('success', 'Region Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {

        $Region = Region::find($id);
        $Region->delete();
        return redirect()->route('regions.index')->with('success', 'Region deleted Successfully');
    }
}