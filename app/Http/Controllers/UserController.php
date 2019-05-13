<?php

namespace App\Http\Controllers;

use Storage;
use App\User;
use App\Http\Requests;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function editProfile()
    {
        return view('user.edit');
    }

    public function updateProfile(Request $request)
    {
        if($request->user()->avatar) {
            Storage::delete($request->user()->avatar);
        }

        $avatar = $request->file('avatar')->store('avatars');

        $request->user()->update([
            'avatar' => $avatar
        ]);

        return redirect()->back();
    }

    public function destroyProfile(Request $request)
    {
        if($request->user()->avatar) {
            Storage::delete($request->user()->avatar);
        }
        
        $request->user()->update([
            'avatar' => null
        ]);

        return redirect()->back();
    }
}
