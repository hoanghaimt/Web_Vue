<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModNews;
use App\ListNews;
use DB;

class ApiModNews extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
	public function GetAllMod(){
	    $modNews = ModNews::orderBy('id','DESC')->paginate(12);
	    return response()->json($modNews);
	}
	public function AddNewMod(Request $request){

		$this->validate($request,[
			'name' =>'required',
			'number' =>'required',
			'type' =>'required',
			'description' =>'required',
		],[
			'name.required'=>'Tên không được để trống',
			'number.required'=>'Thứ tự không được để trống',
			'type.required'=>'Phải chọn một trạng thái.',
			'description.required'=>'Hãy nhập mô tả',
		]);
		if($request->get('image'))
       	{
          $image = $request->get('image');
          $name = upload_image_vue($image,'ModNews');

          $config = [
	            'mod_name' => $request->name,
	            'mod_slug' => str_slug($request->name,'-'),
	            'mod_number' => $request->number,
	            'mod_type' => $request->type,
	            'mod_icon' => $name,
	            'mod_description' => $request->description,
	        ];
        }else {
        	$config = [
	            'mod_name' => $request->name,
	            'mod_slug' => str_slug($request->name,'-'),
	            'mod_number' => $request->number,
	            'mod_type' => $request->type,
	            'mod_description' => $request->description,
	        ];
        }
        
        DB::table('modnews')->insert($config);
	}
	public function getmodbyid($id){
	    $item = ModNews::find($id);
	    return response()->json($item);
	}
	public function UpdateMod($id,Request $request){

		$this->validate($request,[
			'name' =>'required',
			'number' =>'required',
			'type' =>'required',
			'description' =>'required',
		],[
			'name.required'=>'Tên không được để trống',
			'number.required'=>'Thứ tự không được để trống',
			'type.required'=>'Phải chọn một trạng thái.',
			'description.required'=>'Hãy nhập mô tả',
		]);

		if($request->get('image')){

			$mod = ModNews::find($id);
			if($mod->mod_icon !="/images/noimg.jpg"){
	            while(file_exists(public_path($mod->mod_icon)))
	            {
	                unlink(public_path($mod->mod_icon));
	            }
	        }
          	$image = $request->get('image');
          	$name = upload_image_vue($image,'ModNews');
          	$config = [
	            'mod_name' => $request->name,
	            'mod_slug' => str_slug($request->name,'-'),
	            'mod_number' => $request->number,
	            'mod_type' => $request->type,
	            'mod_icon' => $name,
	            'mod_description' => $request->description,
        	];
        } else {
        	$config = [
	            'mod_name' => $request->name,
	            'mod_slug' => str_slug($request->name,'-'),
	            'mod_number' => $request->number,
	            'mod_type' => $request->type,
	            'mod_description' => $request->description,
	        ];
        }
	    
        DB::table('modnews')->where('id', $id)->update($config);
	}
	public function DeleteMod($id){
	    $modNews = ModNews::find($id);

		if($modNews->mod_icon !="/images/noimg.jpg"){
            while(file_exists(public_path($modNews->mod_icon)))
            {
                unlink(public_path($modNews->mod_icon));
            }
        }

	    $modNews->delete();
	    return response()->json($modNews);
	}
}
