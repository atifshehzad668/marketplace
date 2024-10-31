<?php

namespace App\Http\Controllers;

use App\Models\Practice;
use Illuminate\Http\Request;

class PracticeController extends Controller
{
    public function create()
    {

        return view('practice.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',

            'email' => 'required|email',
            'password' => 'required',
        ]);

        $data = $request->all();

        $practice = Practice::create($data);
        return redirect()->route('practice.create')->with('success', 'Data stored successfully!');
    }
}
