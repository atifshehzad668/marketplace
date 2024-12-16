<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller // implements HasMiddleware
{
    // public static function middleware(): array
    // {
    //     return [


    //         new Middleware('permission: user-list', only: ['index']),
    //         new Middleware('permission: user-create', only: ['create']),
    //         new Middleware('permission: user-edit', only: ['edit']),
    //         new Middleware('permission: user-delete', only: ['delete']),

    //     ];
    // }
    public function index()
    {

        $users = User::paginate(10);


        return view('user.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);


        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        $user->assignRole('Salesman');
        /*
        if ($request->has('role')) {
            $roles = $request->input('role'); // Array of role names
            $user->syncRoles($roles); // Assign roles using Spatie Permission
        }
        */


        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $roles = Role::orderBy('name', 'ASC')->get();
        $hasroles = $user->roles->pluck('name')->toArray();
        return view('user.edit', get_defined_vars());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id . ',id'
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.edit', $id)->withInput()->withErrors($validator);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $user->syncRoles($request->role);

        return redirect()->route('user.index')->with('success', 'User Updated Successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully');
    }
}