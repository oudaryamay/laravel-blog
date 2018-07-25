<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Image;

use Session;

use File;

class MediaController extends Controller
{

	public function __construct() {
        $this->middleware('auth');
    }
    
    public function getMedia(){

    	return view ('admin.media.index');

    }
    public function newMedia(){

    	return view ('admin.media.new');

    }

   public function upload(Request $request)
    {
          if ($request->hasFile('featured_img')) {
          $image = $request->file('featured_img');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('uploads/' . $filename);
          Image::make($image)->save($location);

          Session::flash('success', 'The media was successfully uploaded.');

          return view ('admin.media.new');
        }
    }

    public function destroy(Request $request) {

      $filename = $request->file_name;
      File::delete('uploads/' . $filename);

         Session::flash('success', 'The media was successfully deleted.');

         //redirect
          return redirect()->route('media.index'); 
    }

}
