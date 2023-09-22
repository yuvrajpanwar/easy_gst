<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;


class ResetPasswordController extends Controller
{

    public function change_password()
    {
        return view('auth.passwords.change_password');
    }

    public function update_password(Request $request)
    {
        $request->validate([
            'oldpassword'=>'required',
            'newpassword'=>'required|min:5'
        ], [
            'oldpassword.required' => 'This field is required.',
            'newpassword.required' => 'This field is required.',
            'newpassword.min' => 'The new password must be at least 5 characters.'
            
        ]);

        $user = Auth::user();
        $old_password = $user->password;
        $new_password = Hash::make($request->newpassword);

        if (Hash::check($request->oldpassword, $old_password)) {
            $user->password = $new_password;
            $user->save();
            return redirect()->back()->with('success','Password is changed successfully !');
           
        } else {
            return redirect()->back()->with('error','Old password did not match !');
           
        }
        

        
    }

}
