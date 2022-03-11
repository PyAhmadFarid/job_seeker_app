<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminsController extends Controller
{
    function index()
    {
        $users = User::where('id', '!=', auth()->user()->id)->get();
        return view('admin.admins', ['users' => $users]);
    }

    function show_new_admin()
    {
        return view('admin.new_admin');
    }
    function save_new_admin(Request $request)
    {


        $cre = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);



        if ($request->hasFile('profile_picture')) {

            $filenameWithExt = $request->file('profile_picture')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('profile_picture')->storeAs('public/profile_picture', $fileNameToStore);

            $cre['profile_picture'] = $path;
        }
        // dd($cre);
        $cre['password'] = Hash::make($cre['password']);
        $cre['role'] = $request->role ? 0 : 1;

        User::Create($cre);
        return redirect()->route('admins')->with('message', 'Admin has been created');
    }

    function show_edit_admin($userid)
    {
        if (auth()->user()->id == $userid || auth()->user()->role == 0) {
            $user = User::find($userid);
            return view('admin.new_admin', ['user' => $user]);
        }
        return redirect()->back();
    }

    function save_edit_admin(Request $request, $userid)
    {
        if (auth()->user()->id == $userid || auth()->user()->role == 0) {
            $user = User::find($userid);

            $cre = $request->validate([
                'name' => 'required',
                'email' => 'required',
            ]);

            if ($r = $request->password) {
                $cre['password'] = Hash::make($r);
            }

            if ($request->hasFile('profile_picture')) {

                if ($user->profile_picture) {
                    Storage::delete($user->profile_picture);
                }

                $filenameWithExt = $request->file('profile_picture')->getClientOriginalName();
                //Get just filename
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                // Get just ext
                $extension = $request->file('profile_picture')->getClientOriginalExtension();
                // Filename to store
                $fileNameToStore = $filename . '_' . time() . '.' . $extension;
                // Upload Image
                $path = $request->file('profile_picture')->storeAs('public/profile_picture', $fileNameToStore);

                $cre['profile_picture'] = $path;
            }
            $cre['role'] = $request->role ? 0 : 1;
            $user->fill($cre)->save();

            return redirect()->route('admins')->with('message', 'Admin has been saved');
        }
        return redirect()->back();
    }

    function delete_admin($userid)
    {
        if (auth()->user()->id != $userid) {
            $user = User::find($userid);
            if ($user->profile_picture) {
                Storage::delete($user->profile_picture);
            }
            $user->delete();
            return redirect()->back()->with('message', 'Admin has been deleted ');
        }

        return redirect()->back();
    }
}
