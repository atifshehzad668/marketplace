<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserProfileController extends Controller
{
    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);


        return view('user_profile.edit', get_defined_vars());
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);


        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id . ',id',

            'profile_image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',

        ]);

        if ($validator->fails()) {
            return redirect()->route('user.profile.edit', $id)->withInput()->withErrors($validator);
        }


        $user->name = $request->name;
        $user->email = $request->email;



        if ($request->hasFile('profile_image')) {
            if ($user->profile_image && file_exists(public_path($user->profile_image))) {
                unlink(public_path($user->profile_image));
            }
            $file = $request->file('profile_image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = 'uploads/profile_images';


            $file->move(public_path($filePath), $fileName);


            $user->profile_image = $filePath . '/' . $fileName;
        }




        $user->save();

        return redirect()->route('user.profile.edit', $id)->with('success', 'User Updated Successfully');
    }
    public function password_edit(Request $request, $id)
    {
        $user = User::findOrFail($id);


        return view('user_profile.passwrod_edit', get_defined_vars());
    }


    public function password_update(Request $request, $id)
    {

        $user = User::findOrFail($id);


        $validator = Validator::make($request->all(), [
            'password' => 'required|min:8|confirmed',
        ]);


        if ($validator->fails()) {
            return redirect()->route('user.password.edit', $id)->withInput()->withErrors($validator);
        }


        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }


        $user->save();


        return redirect()->route('user.password.edit', $id)->with('success', 'Password Updated Successfully');
    }
}