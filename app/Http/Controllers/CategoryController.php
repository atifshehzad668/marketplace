<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controller\HasMiddleware;
use Illuminate\Routing\Controller\Middleware;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $categories = Category::orderBy('created_at', 'DESC')->paginate(25);
        return view('category.list', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',


        ]);

        $data = $request->all();

        $category = Category::create($data);
        return redirect()->route('categories.index')->with('success', 'Category Added Successfully!');
    }
    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);
        $category = Category::findOrFail($id);
        if ($validator->passes()) {
            $category->name = $request->name;
            $category->save();

            return redirect()->route('categories.index')->with('success', 'Category Updated Successfully');
        } else {
            return redirect()->route('categories.edit')->withinput()->withErrors($validator);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {

        $category = Category::find($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted Successfully');
    }
}