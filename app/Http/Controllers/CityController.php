<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    public function index()
    {

        $cities = City::orderBy('created_at', 'DESC')->paginate(25);
        return view('city.list', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('city.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'city_name' => 'required',


        ]);

        $data = $request->all();

        $City = City::create($data);
        return redirect()->route('cities.index')->with('success', 'City Added Successfully!');
    }
    /**
     * Display the specified resource.
     */
    public function show(City $City)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $city = City::findOrFail($id);
        return view('city.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'city_name' => 'required'
        ]);
        $City = City::findOrFail($id);

        $City->city_name = $request->name;
        $City->save();

        return redirect()->route('cities.index')->with('success', 'City Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {

        $City = City::find($id);
        $City->delete();
        return redirect()->route('cities.index')->with('success', 'City deleted Successfully');
    }
}