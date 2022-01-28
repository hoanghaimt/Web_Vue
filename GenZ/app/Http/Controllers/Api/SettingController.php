<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;
use DB;

class SettingController extends Controller
{
    public function api_get_setting()
    {
    	$setting = Setting::find(1);
    	return response()->json($setting);
    }
    public function post_info_setting(Request $request){

		$this->validate($request,[
			'nameco' =>'required',
			'phone' =>'required',
		],[
			'nameco.required'=>'Tên không được để trống',
			'phone.required'=>'Vui lòng nhập số điện thoại',			
		]);

		if($request->get('logo')){
			// xoa logo cu 
			$listproduct = Setting::find(1);
			if($listproduct->list_icon !="/images/noimg.jpg"){
	            while(file_exists(public_path($listproduct->logo)))
	            {
	                unlink(public_path($listproduct->logo));
	            }
	        }
			$image = $request->get('logo');
        	$logo = upload_image_vue($image,'logos');
        	$config = [
	            'map' => $request->map,
	            'nameco' => $request->nameco,
	            'address' => $request->address,
	            'phone' => $request->phone,
	            'mail' => $request->mail,
	            'logo' => $logo,
	            'slogan' => $request->slogan,
	            'fanpage' => $request->fanpage,
	            'seo_title' => $request->seo_title,
	            'seo_keyword' => $request->seo_keyword,
	            'seo_description' => $request->seo_description,
	            'fb_app_id' => $request->fb_app_id,
	            'google_analyst' => $request->google_analyst,
	        ];
	    } else {
	    	$config = [
	            'map' => $request->map,
	            'nameco' => $request->nameco,
	            'address' => $request->address,
	            'phone' => $request->phone,
	            'mail' => $request->mail,
	            'slogan' => $request->slogan,
	            'fanpage' => $request->fanpage,
	            'seo_title' => $request->seo_title,
	            'seo_keyword' => $request->seo_keyword,
	            'seo_description' => $request->seo_description,
	            'fb_app_id' => $request->fb_app_id,
	            'google_analyst' => $request->google_analyst,
	        ];
	    }
        DB::table('settings')->where('id', 1)->update($config);
	}
}
