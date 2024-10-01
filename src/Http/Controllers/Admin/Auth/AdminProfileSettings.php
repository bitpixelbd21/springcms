<?php

namespace BitPixel\SpringCms\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use BitPixel\SpringCms\Constants;
use BitPixel\SpringCms\Models\Admin;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class AdminProfileSettings extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/admin/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('river.guest:'.Constants::AUTH_GUARD_ADMINS)->except('logout');
    // }


    public function index(){

        $data = Auth::guard(Constants::AUTH_GUARD_ADMINS)->user();

        return view('river::admin.auth.profile_settings', compact('data'));

    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'email' =>'required'
        ]);

            $file= Admin::find($id);

            $file->name = $request->name;
            $file->email = $request->email;
            $file->image = $request->image;

            $file->save();

            return redirect()->back()->with('success', 'Updated');
    }

    public function update_password(Request $request, $id) {


        $request->validate([
            'password' => 'required',
            'new_password' => 'required|same:confirm_password',
            'confirm_password' => 'required'
        ]);

        $currentPasswordStatus = Hash::check($request->password, Auth::guard(Constants::AUTH_GUARD_ADMINS)->user()->password);
        if($currentPasswordStatus){

            $admin = Admin::findOrFail(Auth::guard(Constants::AUTH_GUARD_ADMINS)->user()->id);
            $admin->password = Hash::make($request->new_password);
            $admin->save();

            return redirect()->back()->with('success','Password Updated Successfully');

        }else{

            return redirect()->back()->with('error','Current Password does not match with Old Password');
        }

    }
   
}
