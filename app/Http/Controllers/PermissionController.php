<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class PermissionController extends Controller  //implements HasMiddleware
{
    // public static function middleware(): array
    // {
    //     return [


    //         new Middleware('permission: permission-list', only: ['index']),
    //         new Middleware('permission: permission-create', only: ['create']),
    //         new Middleware('permission: permission-edit', only: ['edit']),
    //         new Middleware('permission: permission-delete', only: ['delete']),

    //     ];
    // }
    // public function __construct()
    // {
    //     $this->middleware(static::middleware());
    // }

    // public static function middleware(): array
    // {
    //     return [
    //         'permission:permission-list' => ['only' => ['index']],
    //         'permission:permission-create' => ['only' => ['create']],
    //         'permission:permission-edit' => ['only' => ['edit']],
    //         'permission:permission-delete' => ['only' => ['destroy']],
    //     ];
    // }

    public function index()
    {

        $permissions = Permission::orderBy('created_at', 'DESC')->paginate(25);
        return view('permission.index', get_defined_vars());
    }
    public function create()
    {

        return view('permission.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions'
        ]);

        if ($validator->passes()) {
            Permission::create(['name' => $request->name]);

            return redirect()->route('permission.index')->with('success', 'Permission Added Successfully');
        } else {
            return redirect()->route('permission.create')->withinput()->withErrors($validator);
        }
    }
    public function edit(Request $request, $id)
    {
        $permission = Permission::findOrFail($id);
        return view('permission.edit', get_defined_vars());
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:permissions,name,' . $id . ',id'
        ]);
        $permission = Permission::findOrFail($id);

        if ($validator->passes()) {
            $permission->name = $request->name;
            $permission->save();

            return redirect()->route('permission.index')->with('success', 'Permission Updated Successfully');
        } else {
            return redirect()->route('permission.edit', $permission->id)->withinput()->withErrors($validator);
        }
    }
    public function destroy(Request $request, $id)
    {

        $permission = Permission::find($id);
        $permission->delete();
        return redirect()->route('permission.index')->with('success', 'Permission deleted successfully');
    }
}