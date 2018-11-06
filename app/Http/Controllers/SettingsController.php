<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use DB;

use App\Option;

use Session;

class SettingsController extends Controller
{
     public function __construct() {
        $this->middleware('auth');
    }

    public function option() {
    	return view('admin.settings.options');
    }

    public function optionUpdate(Request $request) {

    $site_title       = $request->site_title;
    $site_description = $request->site_description;
    $site_url         = $request->site_url;
    $home_url         = $request->home_url;
    $admin_url        = $request->admin_url;

    $data = array(
    array('option_key'=>'site_title', 'option_value'=> $site_title),
    array('option_key'=>'site_description', 'option_value'=> $site_description),
    array('option_key'=>'site_url', 'option_value'=> $site_url),
    array('option_key'=>'home_url', 'option_value'=> $home_url),
    array('option_key'=>'admin_url', 'option_value'=> $admin_url),
	);

	$site_title_db 		 = DB::table('options')->where('option_key', 'site_title')->get();

    if ($site_title_db != null){

        DB::table('options')
            ->where('option_key', 'site_title')
            ->update(['option_value' =>  $site_title ]);

        DB::table('options')
            ->where('option_key', 'site_description')
            ->update(['option_value' =>  $site_description ]);

        DB::table('options')
            ->where('option_key', 'site_url')
            ->update(['option_value' =>  $site_url ]);

        DB::table('options')
            ->where('option_key', 'home_url')
            ->update(['option_value' =>  $home_url ]);

        DB::table('options')
            ->where('option_key', 'admin_url')
            ->update(['option_value' =>  $admin_url ]);

    } else {

    	DB::table('options')->insert($data); // Query Builder approach
    }

	//Success message

    Session::flash('success', 'The settings was successfully saved.');

	//redirect
    return redirect()->route('ob-admin.settings.option'); 

    }
}
