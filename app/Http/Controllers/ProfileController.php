<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use Session;

use Image;

use Auth;

class ProfileController extends Controller
{
     public function __construct() {
        $this->middleware('auth');
    }

    public function getEdit() {

		$user_id = Auth::id();
		$user = User::find($user_id);

    	return view('admin.profile.edit')->withUser($user);
    }

    public function getUpdate(Request $request, $id) {

    	$user_id = User::find($id);

         if ($request->input('email') == $user_id->email) {

    	 $this->validate($request, array(
            'name'         => 'required|max:255'
         ));

        } else {

        $this->validate($request, array(

            'name'         => 'required|max:255',
            'email'          => 'required|unique:users,email'
         ));

        }

         $user_id = User::find($id);

         $user_id->name=$request->input('name');
         $user_id->email=$request->input('email');

        if ($request->hasFile('profile_img')) {
          $image = $request->file('profile_img');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('uploads/' . $filename);
          Image::make($image)->resize(200, 200)->save($location);

          $user_id->profile_image = $filename;
        }

        $user_id->save();

         //Session message

        Session::flash('success','The profile has been successfully updated.');

        //redirect

        return redirect()->route('profile.edit'); 


    }

    public function getPassword() {

        $user_id = Auth::id();
        $user = User::find($user_id);

        return view('admin.profile.pwd')->withUser($user);

    }


}
